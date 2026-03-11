#!/usr/bin/env python3
"""
Frozen pizza brand discovery: crawl seed URLs and extract official U.S. frozen
pizza brand/product sites using the user's prompt and LLM extraction.

Gameplan & CSV design: see scripts/GAMEPLAN_FROZEN_PIZZA_CRAWL.md

Usage:
  .venv/bin/python scripts/extract_frozen_pizza_brands.py [--output CSV_PATH] [--seeds SEED_FILE] [--append]
  Set OPENAI_API_KEY (or other provider key) for LLM extraction.

Output: CSV with columns brand_name, website_url, parent_company, page_title,
  evidence_this_is_frozen_pizza, evidence_this_is_official, us_market_evidence,
  product_types_mentioned (pipe-separated), contact_or_about_page_url, confidence_score.
"""
import argparse
import asyncio
import csv
import json
import os
import re
import sys
from pathlib import Path

# Project root for imports and default paths
PROJECT_ROOT = Path(__file__).resolve().parent.parent
sys.path.insert(0, str(PROJECT_ROOT))

from pydantic import BaseModel, Field

from crawl4ai import (
    AsyncWebCrawler,
    BrowserConfig,
    CrawlerRunConfig,
    LLMConfig,
    LLMExtractionStrategy,
)

# --- Pydantic schema for extraction (matches your desired JSON shape) ---


class FrozenPizzaBrandResult(BaseModel):
    brand_name: str = Field(description="Official frozen pizza brand name")
    website_url: str = Field(description="Canonical URL for the brand or product page")
    parent_company: str = Field(description="Parent company name if applicable, else empty string")
    page_title: str = Field(description="Title of the page")
    evidence_this_is_frozen_pizza: str = Field(
        description="Short quote or description proving the page is about frozen pizza"
    )
    evidence_this_is_official: str = Field(
        description="Short quote or description proving this is an official brand/parent site"
    )
    us_market_evidence: str = Field(
        description="Evidence the brand sells in the U.S., or note uncertainty"
    )
    product_types_mentioned: list[str] = Field(
        default_factory=list,
        description="List of product types mentioned (e.g. Frozen Cheese, Frozen Pepperoni)",
    )
    contact_or_about_page_url: str = Field(
        description="URL to contact or about page if found, else empty string"
    )
    confidence_score: int = Field(
        ge=1,
        le=10,
        description="Confidence that this is a valid U.S. official frozen pizza brand page, 1-10",
    )


# Wrapper so the LLM returns a JSON array (schema: array of FrozenPizzaBrandResult)
class FrozenPizzaBrandList(BaseModel):
    brands: list[FrozenPizzaBrandResult] = Field(
        default_factory=list,
        description="Array of frozen pizza brand results; empty if page is not valid",
    )


EXTRACTION_INSTRUCTION = """Your task is to discover and identify official frozen pizza brand and product websites in the United States.

Goal:
Find websites that belong to frozen pizza brands, frozen pizza manufacturers, or brand-owned frozen pizza product lines sold in the U.S.

Include:
- Official brand websites
- Official product pages on a parent company site
- Dedicated frozen pizza brand pages
- U.S.-focused manufacturer pages for frozen pizza lines

Exclude:
- Grocery store category pages
- Instacart, Walmart, Target, Amazon, and other marketplace listings
- Review sites, blogs, news articles, Reddit, Wikipedia, and social media pages
- Restaurant delivery pages unless the brand clearly sells retail frozen pizza
- Non-U.S. brands unless they actively sell frozen pizza in the United States

For each valid result, extract: brand_name, website_url, parent_company, page_title, evidence_this_is_frozen_pizza, evidence_this_is_official, us_market_evidence, product_types_mentioned (array of strings), contact_or_about_page_url, confidence_score from 1 to 10.

Rules:
- Prefer official domains and pages controlled by the brand or parent company.
- If a page is ambiguous, explain why in the evidence fields.
- Do not invent facts; only use information present on the page.
- If multiple pages belong to the same brand, return the single best canonical result for this page.
- If the site appears to be a local pizzeria or restaurant and not a retail frozen pizza brand, do not include it (return empty brands array).
- If the page only mentions pizza generally and not frozen pizza, do not include it (return empty brands array).
- If the brand appears to be sold in the U.S. but the page does not clearly prove it, note that uncertainty in us_market_evidence.

Output:
Return a JSON object with one key "brands" that is an array of objects. Each object must have exactly these fields (use empty string or empty array where not found):
- brand_name (string)
- website_url (string)
- parent_company (string)
- page_title (string)
- evidence_this_is_frozen_pizza (string)
- evidence_this_is_official (string)
- us_market_evidence (string)
- product_types_mentioned (array of strings)
- contact_or_about_page_url (string)
- confidence_score (integer 1-10)

If this page does not represent a valid official U.S. frozen pizza brand/product site, set "brands" to an empty array []."""


def load_seed_urls(path: Path) -> list[str]:
    """Load URLs from file (one per line; skip empty and # comments)."""
    urls = []
    if not path.exists():
        return urls
    with open(path, encoding="utf-8") as f:
        for line in f:
            line = line.strip()
            if not line or line.startswith("#"):
                continue
            urls.append(line)
    return urls


def parse_extracted_content(raw: str, page_url: str) -> list[dict]:
    """
    Parse LLM extracted_content into a list of brand dicts.
    Handles both {"brands": [...]} and raw array [...].
    """
    if not raw or not raw.strip():
        return []
    raw = raw.strip()
    # Try to fix common LLM wrapping (e.g. markdown code block)
    if raw.startswith("```"):
        raw = re.sub(r"^```(?:json)?\s*", "", raw)
        raw = re.sub(r"\s*```\s*$", "", raw)
    try:
        data = json.loads(raw)
    except json.JSONDecodeError:
        return []
    if isinstance(data, list):
        return data
    if isinstance(data, dict) and "brands" in data:
        return data["brands"] if isinstance(data["brands"], list) else []
    return []


def dedupe_by_brand(results: list[dict]) -> list[dict]:
    """Keep one row per brand_name: the one with highest confidence_score."""
    by_brand: dict[str, dict] = {}
    for r in results:
        name = (r.get("brand_name") or "").strip()
        if not name:
            continue
        score = int(r.get("confidence_score") or 0)
        if name not in by_brand or score > int(by_brand[name].get("confidence_score") or 0):
            by_brand[name] = r
    return list(by_brand.values())


def row_for_csv(item: dict) -> dict:
    """Convert one result item to CSV row: product_types_mentioned as pipe-separated."""
    types = item.get("product_types_mentioned") or []
    if isinstance(types, list):
        types_str = "|".join(str(t) for t in types if t)
    else:
        types_str = str(types)
    return {
        "brand_name": str(item.get("brand_name") or ""),
        "website_url": str(item.get("website_url") or ""),
        "parent_company": str(item.get("parent_company") or ""),
        "page_title": str(item.get("page_title") or ""),
        "evidence_this_is_frozen_pizza": str(item.get("evidence_this_is_frozen_pizza") or ""),
        "evidence_this_is_official": str(item.get("evidence_this_is_official") or ""),
        "us_market_evidence": str(item.get("us_market_evidence") or ""),
        "product_types_mentioned": types_str,
        "contact_or_about_page_url": str(item.get("contact_or_about_page_url") or ""),
        "confidence_score": str(item.get("confidence_score") or ""),
    }


CSV_COLUMNS = [
    "brand_name",
    "website_url",
    "parent_company",
    "page_title",
    "evidence_this_is_frozen_pizza",
    "evidence_this_is_official",
    "us_market_evidence",
    "product_types_mentioned",
    "contact_or_about_page_url",
    "confidence_score",
]


def write_csv(path: Path, rows: list[dict], append: bool = False) -> None:
    path.parent.mkdir(parents=True, exist_ok=True)
    file_exists = path.exists() and append
    with open(path, "a" if append else "w", newline="", encoding="utf-8") as f:
        w = csv.DictWriter(f, fieldnames=CSV_COLUMNS, quoting=csv.QUOTE_MINIMAL)
        if not file_exists:
            w.writeheader()
        for r in rows:
            w.writerow(row_for_csv(r))


async def run_extraction(
    seed_file: Path,
    output_path: Path,
    append: bool,
    llm_provider: str,
    llm_api_token: str,
) -> None:
    urls = load_seed_urls(seed_file)
    if not urls:
        print("No seed URLs found. Add URLs to", seed_file, "(one per line).")
        return

    schema = FrozenPizzaBrandList.model_json_schema()
    llm_config = LLMConfig(provider=llm_provider, api_token=llm_api_token)
    extraction_strategy = LLMExtractionStrategy(
        llm_config=llm_config,
        schema=schema,
        extraction_type="schema",
        instruction=EXTRACTION_INSTRUCTION,
        chunk_token_threshold=4000,
        overlap_rate=0.1,
        apply_chunking=True,
        input_format="markdown",
        extra_args={"temperature": 0.1, "max_tokens": 2000},
        verbose=False,
    )
    crawl_config = CrawlerRunConfig(
        extraction_strategy=extraction_strategy,
        wait_until="domcontentloaded",
    )
    browser_config = BrowserConfig(headless=True, verbose=False)

    all_results: list[dict] = []
    async with AsyncWebCrawler(config=browser_config) as crawler:
        for i, url in enumerate(urls, 1):
            print(f"[{i}/{len(urls)}] Crawling: {url}")
            try:
                result = await crawler.arun(url=url, config=crawl_config)
                if not getattr(result, "success", False):
                    print(f"  Crawl failed: {getattr(result, 'error_message', 'unknown')}")
                    continue
                raw = getattr(result, "extracted_content", None) or ""
                items = parse_extracted_content(raw, url)
                for it in items:
                    it["website_url"] = it.get("website_url") or url
                all_results.extend(items)
                print(f"  -> {len(items)} brand(s) extracted")
            except Exception as e:
                print(f"  Error: {e}")

    if extraction_strategy and hasattr(extraction_strategy, "show_usage"):
        try:
            extraction_strategy.show_usage()
        except Exception:
            pass

    deduped = dedupe_by_brand(all_results)
    print(f"\nTotal unique brands: {len(deduped)}")

    if append and output_path.exists():
        # Load existing and merge by brand (keep higher confidence)
        existing: list[dict] = []
        with open(output_path, encoding="utf-8", newline="") as f:
            r = csv.DictReader(f)
            for row in r:
                existing.append({
                    "brand_name": row.get("brand_name", ""),
                    "website_url": row.get("website_url", ""),
                    "parent_company": row.get("parent_company", ""),
                    "page_title": row.get("page_title", ""),
                    "evidence_this_is_frozen_pizza": row.get("evidence_this_is_frozen_pizza", ""),
                    "evidence_this_is_official": row.get("evidence_this_is_official", ""),
                    "us_market_evidence": row.get("us_market_evidence", ""),
                    "product_types_mentioned": row.get("product_types_mentioned", "").split("|") if row.get("product_types_mentioned") else [],
                    "contact_or_about_page_url": row.get("contact_or_about_page_url", ""),
                    "confidence_score": row.get("confidence_score", ""),
                })
        merged = dedupe_by_brand(existing + deduped)
        write_csv(output_path, merged, append=False)
    else:
        write_csv(output_path, deduped, append=False)

    print("Wrote:", output_path)


def main() -> None:
    parser = argparse.ArgumentParser(description="Extract frozen pizza brands from seed URLs into CSV.")
    parser.add_argument(
        "--output",
        "-o",
        type=Path,
        default=PROJECT_ROOT / "data" / "frozen_pizza_brands.csv",
        help="Output CSV path",
    )
    parser.add_argument(
        "--seeds",
        "-s",
        type=Path,
        default=Path(__file__).resolve().parent / "seed_urls_frozen_pizza.txt",
        help="Seed URL file (one URL per line)",
    )
    parser.add_argument(
        "--append",
        action="store_true",
        help="Merge new results into existing CSV (keep higher confidence per brand)",
    )
    parser.add_argument(
        "--provider",
        "-p",
        default="openai/gpt-4o-mini",
        help="LiteLLM provider string (e.g. openai/gpt-4o-mini)",
    )
    args = parser.parse_args()

    api_key = os.getenv("OPENAI_API_KEY") or os.getenv("LLM_API_KEY")
    if not api_key:
        print("Set OPENAI_API_KEY (or LLM_API_KEY) for LLM extraction.", file=sys.stderr)
        sys.exit(1)

    asyncio.run(
        run_extraction(
            seed_file=args.seeds,
            output_path=args.output,
            append=args.append,
            llm_provider=args.provider,
            llm_api_token=api_key,
        )
    )


if __name__ == "__main__":
    main()

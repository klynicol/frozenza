#!/usr/bin/env python3
"""
Elaborate frozen pizza brands: crawl each brand's website with Crawl4AI, then use an LLM
with the elaboration prompt to produce structured SEO content (description, brand story,
USPs, founded year, etc.). Outputs JSON and optionally CSV.

Usage:
  python scripts/brands_elaborate.py [--input CSV] [--prompt FILE] [--output JSON] [--output-csv CSV] [--limit N] [--provider MODEL]
  Set OPENAI_API_KEY or LLM_API_KEY for the LLM.

Input CSV columns: brand_name, website_url.
Output JSON: {"brands": [{ brand_name, website_url, parent_company, founded_year, ... }, ...]}
"""
import argparse
import asyncio
import csv
import json
import os
import re
import sys
from pathlib import Path

PROJECT_ROOT = Path(__file__).resolve().parent.parent
sys.path.insert(0, str(PROJECT_ROOT))

try:
    from dotenv import load_dotenv
    load_dotenv(PROJECT_ROOT / ".env")
except ImportError:
    pass

# Content snippet size to stay within context limits
CONTENT_SNIPPET_CHARS = 14_000


def _normalize_url(url: str) -> str:
    u = (url or "").strip().lower()
    if u.endswith("/"):
        u = u[:-1]
    return u


def load_csv(path: Path) -> list[dict]:
    """Load CSV with brand_name, website_url. Returns list of dicts."""
    if not path.exists():
        return []
    rows = []
    with open(path, encoding="utf-8") as f:
        reader = csv.DictReader(f)
        for row in reader:
            name = (row.get("brand_name") or "").strip()
            url = (row.get("website_url") or "").strip()
            if name and url:
                rows.append({"brand_name": name, "website_url": url})
    return rows


def dedupe_by_url(rows: list[dict]) -> list[dict]:
    """Keep one row per website_url (first occurrence). URL normalized (lowercase, no trailing slash)."""
    seen: set[str] = set()
    out = []
    for r in rows:
        url = _normalize_url(r.get("website_url") or "")
        if not url or url in seen:
            continue
        seen.add(url)
        out.append(r)
    return out


def load_prompt(path: Path) -> str:
    """Load prompt text from file."""
    if not path.exists():
        return ""
    return path.read_text(encoding="utf-8").strip()


def fetch_url_fallback(url: str, timeout: int = 25) -> str:
    """Fetch URL with stdlib only (no Crawl4AI). Strips HTML to approximate text. Use when Crawl4AI is not installed."""
    import urllib.request
    try:
        req = urllib.request.Request(
            url,
            headers={"User-Agent": "Mozilla/5.0 (compatible; PizzaKraken/1.0)"},
        )
        with urllib.request.urlopen(req, timeout=timeout) as resp:
            raw = resp.read()
        charset = resp.headers.get_content_charset() or "utf-8"
        try:
            html = raw.decode(charset, errors="replace")
        except Exception:
            html = raw.decode("utf-8", errors="replace")
        # Remove script/style and strip tags; normalize whitespace
        html = re.sub(r"<script[^>]*>.*?</script>", " ", html, flags=re.DOTALL | re.IGNORECASE)
        html = re.sub(r"<style[^>]*>.*?</style>", " ", html, flags=re.DOTALL | re.IGNORECASE)
        text = re.sub(r"<[^>]+>", " ", html)
        text = re.sub(r"\s+", " ", text).strip()
        return text
    except Exception:
        return ""


async def crawl_url(crawler, url: str, run_config) -> str:
    """Crawl URL with Crawl4AI; return markdown or truncated raw content."""
    try:
        result = await crawler.arun(url=url, config=run_config)
        if result and getattr(result, "success", False):
            content = (getattr(result, "markdown", None) or getattr(result, "raw_content", None) or "")
            if isinstance(content, str) and content.strip():
                return content.strip()
    except Exception:
        pass
    return ""


def _parse_elaboration_json(content: str) -> list[dict]:
    """Parse JSON from LLM response; return list of brand objects (may be empty)."""
    if "```" in content:
        content = re.sub(r"^```(?:json)?\s*", "", content)
        content = re.sub(r"\s*```\s*$", "", content)
    content = content.strip()
    try:
        data = json.loads(content)
    except json.JSONDecodeError:
        return []
    brands = data.get("brands") if isinstance(data, dict) else []
    if not isinstance(brands, list):
        return []
    out = []
    required_keys = {
        "parent_company", "founded_year", "headquarter_address", "description",
        "brand_story", "logo_image", "unique_selling_points", "store_locator_url",
    }
    for b in brands:
        if not isinstance(b, dict):
            continue
        row = {}
        for k in required_keys:
            if k == "founded_year":
                val = b.get(k)
                if val is None or val == "":
                    row[k] = None
                elif isinstance(val, int):
                    row[k] = val
                else:
                    try:
                        row[k] = int(val)
                    except (TypeError, ValueError):
                        row[k] = None
            else:
                v = b.get(k)
                row[k] = (v if v is None else str(v).strip()) or ""
        row["parent_company"] = row.get("parent_company") or ""
        row["headquarter_address"] = row.get("headquarter_address") or ""
        row["description"] = row.get("description") or ""
        row["brand_story"] = row.get("brand_story") or ""
        row["logo_image"] = row.get("logo_image") or ""
        row["unique_selling_points"] = row.get("unique_selling_points") or ""
        row["store_locator_url"] = row.get("store_locator_url") or ""
        out.append(row)
    return out


def call_llm(prompt_text: str, brand_name: str, website_url: str, page_content: str, provider: str) -> list[dict]:
    """Call LLM with prompt + brand context + page content; return list of brand objects."""
    api_key = os.getenv("OPENAI_API_KEY") or os.getenv("LLM_API_KEY")
    if not api_key:
        return []
    try:
        import litellm
    except ImportError:
        return []

    snippet = (page_content or "")[:CONTENT_SNIPPET_CHARS]
    if len(page_content or "") > CONTENT_SNIPPET_CHARS:
        snippet += "\n\n... (content truncated)"

    # Prompt file mentions "Vital Pursuit" as an example; substitute the actual brand so the LLM writes about the right brand
    prompt_for_brand = (
        prompt_text.replace("Vital Pursuit Frozen Pizza", brand_name)
        .replace("Vital Pursuit", brand_name)
    )

    extraction_note = """

IMPORTANT: All description, brand_story, and other content must be about the brand named above (Brand: ...) only. Do not use another brand's name or story.

CRITICAL: From the page content above, extract these three fields when present (use full URLs; use empty string only if genuinely not found):
- logo_image: Full URL of the brand's logo image (look for og:image, logo img src, or main brand image).
- store_locator_url: Full URL of a store locator, "where to buy", or product finder page.
- headquarter_address: Full physical address (street, city, state/region, country) of headquarters or contact address.
"""
    user_message = (
        f"{prompt_for_brand}\n\n"
        f"Brand: {brand_name}\n"
        f"URL: {website_url}\n\n"
        f"Page content (crawled):\n{snippet}"
        f"{extraction_note}"
    )
    try:
        response = litellm.completion(
            model=provider,
            messages=[{"role": "user", "content": user_message}],
            api_key=api_key,
            temperature=0.2,
        )
        content = (response.choices[0].message.content or "").strip()
    except Exception as e:
        print(f"  LLM error for {brand_name}: {e}", file=sys.stderr)
        return []

    parsed = _parse_elaboration_json(content)
    # Attach brand_name and website_url to each object
    for obj in parsed:
        obj["brand_name"] = brand_name
        obj["website_url"] = website_url
    return parsed if parsed else [{}]


async def run_elaboration(
    rows: list[dict],
    prompt_text: str,
    output_json: Path,
    output_csv: Path | None,
    limit: int | None,
    provider: str,
) -> None:
    """Crawl each brand URL, call LLM, aggregate, write JSON and optionally CSV."""
    use_crawl4ai = True
    try:
        from crawl4ai import AsyncWebCrawler, BrowserConfig, CrawlerRunConfig
    except ModuleNotFoundError:
        use_crawl4ai = False
        print(
            "Crawl4AI not installed (e.g. lxml build failed on Windows). Using simple HTTP fetch instead.",
            file=sys.stderr,
        )
        print(
            "For browser-based crawling, install Crawl4AI: pip install -r requirements-crawl.txt && crawl4ai-setup",
            file=sys.stderr,
        )

    total = len(rows)
    if total == 0:
        print("No brands to process.", file=sys.stderr)
        return

    all_brands: list[dict] = []
    sem = asyncio.Semaphore(2)

    async def process_one_crawl4ai(crawler, idx: int, row: dict) -> list[dict]:
        brand_name = row.get("brand_name", "")
        website_url = row.get("website_url", "")
        async with sem:
            print(f"[{idx + 1}/{total}] {brand_name} ...", flush=True)
            content = await crawl_url(crawler, website_url, run_config)
            if not content:
                print(f"  No content for {website_url}", file=sys.stderr)
            elaborated = call_llm(prompt_text, brand_name, website_url, content, provider)
            if not elaborated:
                elaborated = [_stub_brand(brand_name, website_url)]
            return elaborated

    async def process_one_fallback(idx: int, row: dict) -> list[dict]:
        brand_name = row.get("brand_name", "")
        website_url = row.get("website_url", "")
        async with sem:
            print(f"[{idx + 1}/{total}] {brand_name} ...", flush=True)
            content = await asyncio.to_thread(fetch_url_fallback, website_url)
            if not content:
                print(f"  No content for {website_url}", file=sys.stderr)
            elaborated = call_llm(prompt_text, brand_name, website_url, content, provider)
            if not elaborated:
                elaborated = [_stub_brand(brand_name, website_url)]
            return elaborated

    def _stub_brand(brand_name: str, website_url: str) -> dict:
        return {
            "brand_name": brand_name,
            "website_url": website_url,
            "parent_company": "",
            "founded_year": None,
            "headquarter_address": "",
            "description": "",
            "brand_story": "",
            "logo_image": "",
            "unique_selling_points": "",
            "store_locator_url": "",
        }

    if use_crawl4ai:
        browser_config = BrowserConfig(headless=True, verbose=False)
        run_config = CrawlerRunConfig(wait_until="domcontentloaded")
        async with AsyncWebCrawler(config=browser_config) as crawler:
            for i, row in enumerate(rows):
                try:
                    batch = await process_one_crawl4ai(crawler, i, row)
                    all_brands.extend(batch)
                except Exception as e:
                    print(f"  Error: {e}", file=sys.stderr)
    else:
        for i, row in enumerate(rows):
            try:
                batch = await process_one_fallback(i, row)
                all_brands.extend(batch)
            except Exception as e:
                print(f"  Error: {e}", file=sys.stderr)

    # Write JSON
    output_json.parent.mkdir(parents=True, exist_ok=True)
    with open(output_json, "w", encoding="utf-8") as f:
        json.dump({"brands": all_brands}, f, indent=2, ensure_ascii=False)
    print(f"Wrote {len(all_brands)} brand(s) to {output_json}.")

    if output_csv:
        fieldnames = [
            "brand_name", "website_url", "parent_company", "founded_year", "headquarter_address",
            "description", "brand_story", "logo_image", "unique_selling_points", "store_locator_url",
        ]
        with open(output_csv, "w", newline="", encoding="utf-8") as f:
            w = csv.DictWriter(f, fieldnames=fieldnames, quoting=csv.QUOTE_MINIMAL)
            w.writeheader()
            for b in all_brands:
                w.writerow({k: ("" if v is None else str(v)) for k, v in b.items() if k in fieldnames})
        print(f"Wrote CSV to {output_csv}.")


def main() -> None:
    parser = argparse.ArgumentParser(
        description="Elaborate frozen pizza brands: crawl with Crawl4AI, extract with LLM, write JSON/CSV.",
    )
    parser.add_argument(
        "--input", "-i",
        type=Path,
        default=PROJECT_ROOT / "data" / "frozen_pizza_brands.csv",
        help="Input CSV with brand_name, website_url",
    )
    parser.add_argument(
        "--prompt", "-p",
        type=Path,
        default=PROJECT_ROOT / "scripts" / "extract_brands_prompt.txt",
        help="Path to elaboration prompt text file",
    )
    parser.add_argument(
        "--output", "-o",
        type=Path,
        default=PROJECT_ROOT / "data" / "brands_elaborated.json",
        help="Output JSON path",
    )
    parser.add_argument(
        "--output-csv",
        type=Path,
        default=None,
        help="Optional: also write CSV with same fields",
    )
    parser.add_argument(
        "--limit",
        type=int,
        default=None,
        help="Process only first N brands (for testing)",
    )
    parser.add_argument(
        "--provider",
        default="openai/gpt-4o",
        help="LiteLLM provider/model (e.g. openai/gpt-4o)",
    )
    args = parser.parse_args()

    rows = load_csv(PROJECT_ROOT / "data" / "frozen_pizza_brands.csv")
    if not rows:
        print(f"No rows in {args.input}.", file=sys.stderr)
        sys.exit(1)
    rows = dedupe_by_url(rows)
    total_available = len(rows)
    if args.limit is not None and args.limit > 0:
        rows = rows[: args.limit]
        print(f"Loaded {total_available} unique brand(s); processing first {len(rows)} (--limit {args.limit}).")
    else:
        print(f"Loaded {total_available} unique brand(s); processing all.")

    prompt_text = load_prompt(args.prompt)
    if not prompt_text:
        print(f"Prompt file empty or missing: {args.prompt}.", file=sys.stderr)
        sys.exit(1)

    if not os.getenv("OPENAI_API_KEY") and not os.getenv("LLM_API_KEY"):
        print("Set OPENAI_API_KEY or LLM_API_KEY for the LLM.", file=sys.stderr)
        sys.exit(1)

    asyncio.run(run_elaboration(
        rows=rows,
        prompt_text=prompt_text,
        output_json=args.output,
        output_csv=args.output_csv,
        limit=args.limit,
        provider=args.provider,
    ))


if __name__ == "__main__":
    main()

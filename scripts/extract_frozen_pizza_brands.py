#!/usr/bin/env python3
"""
Discover frozen pizza brand URLs in the USA by searching the web for
"frozen pizza brands" and optionally filtering with an LLM. No seed file required.

Usage:
  .venv/bin/python scripts/extract_frozen_pizza_brands.py [--output CSV_PATH] [--no-filter] [--seeds FILE]
  With --filter (default): set OPENAI_API_KEY (or LLM_API_KEY) to filter results to official brand sites.
  With --no-filter: write all search result URLs (title as brand_name); no API key needed.

Output: CSV with columns brand_name, website_url.
"""
import argparse
import csv
import json
import os
import re
import sys
from pathlib import Path

# Project root for imports and default paths
PROJECT_ROOT = Path(__file__).resolve().parent.parent
sys.path.insert(0, str(PROJECT_ROOT))

# Search (no API key)
try:
    from ddgs import DDGS
except ImportError:
    DDGS = None  # will error at runtime if search is used

# Optional LLM filter
def _have_llm():
    return bool(os.getenv("OPENAI_API_KEY") or os.getenv("LLM_API_KEY"))


SEARCH_QUERIES = [
    "frozen pizza brands",
    "frozen pizza brands USA",
]

# Prompt for filtering search results: keep only official brand sites, output brand_name + website_url
FILTER_INSTRUCTION = """You are given a list of web search results for "frozen pizza brands".

For each result, decide: Is this an official frozen pizza brand (or brand product) website sold in the USA?
- Include: official brand sites, product pages for a frozen pizza brand.
- Exclude: listicles ("10 best frozen pizza brands"), Wikipedia, retailers (Walmart, Target, Amazon), review sites, news.

Return a JSON object with one key "brands": an array of objects. Each object has exactly:
- brand_name (string): the frozen pizza brand name
- website_url (string): the URL

Include only results that are official frozen pizza brand websites. If none qualify, return {"brands": []}.

Search results to classify:
"""
# (we append the list of title / url / snippet here)


def search_frozen_pizza_brands(max_results_per_query: int = 25) -> list[dict]:
    """Run web search for frozen pizza brands; return list of {title, url, snippet}."""
    if DDGS is None:
        raise RuntimeError("Install ddgs: pip install ddgs")
    seen_urls: set[str] = set()
    out: list[dict] = []
    with DDGS() as ddgs:
        for q in SEARCH_QUERIES:
            try:
                for r in ddgs.text(q, max_results=max_results_per_query):
                    url = (r.get("href") or r.get("url") or "").strip()
                    if not url or url in seen_urls:
                        continue
                    seen_urls.add(url)
                    out.append({
                        "title": (r.get("title") or "").strip(),
                        "url": url,
                        "snippet": (r.get("body") or r.get("snippet") or "").strip(),
                    })
            except Exception as e:
                print(f"Search '{q}' failed: {e}", file=sys.stderr)
    return out


def filter_results_with_llm(
    search_results: list[dict],
    provider: str = "openai/gpt-4o-mini",
    api_key: str | None = None,
) -> list[dict]:
    """Use LLM to keep only official brand sites; return list of {brand_name, website_url}."""
    api_key = api_key or os.getenv("OPENAI_API_KEY") or os.getenv("LLM_API_KEY")
    if not api_key:
        return []
    try:
        import litellm
    except ImportError:
        print("Optional: pip install litellm for --filter.", file=sys.stderr)
        return []

    # Build prompt: list each result as title / url / snippet
    lines = []
    for i, r in enumerate(search_results, 1):
        lines.append(f"{i}. Title: {r.get('title', '')}\n   URL: {r.get('url', '')}\n   Snippet: {r.get('snippet', '')}")
    prompt = FILTER_INSTRUCTION + "\n".join(lines)

    try:
        response = litellm.completion(
            model=provider,
            messages=[{"role": "user", "content": prompt}],
            api_key=api_key,
            temperature=0.1,
        )
        content = (response.choices[0].message.content or "").strip()
    except Exception as e:
        print(f"LLM filter failed: {e}", file=sys.stderr)
        return []

    # Parse JSON from response (allow markdown code block)
    if "```" in content:
        content = re.sub(r"^```(?:json)?\s*", "", content)
        content = re.sub(r"\s*```\s*$", "", content)
    try:
        data = json.loads(content)
    except json.JSONDecodeError:
        return []
    brands = data.get("brands") if isinstance(data, dict) else []
    if not isinstance(brands, list):
        return []
    out = []
    for b in brands:
        if not isinstance(b, dict):
            continue
        name = (b.get("brand_name") or "").strip()
        url = (b.get("website_url") or "").strip()
        if name and url:
            out.append({"brand_name": name, "website_url": url})
    return out


def load_seed_urls(path: Path | None) -> list[dict]:
    """Load URLs from file; return list of {brand_name, website_url} (brand_name from URL)."""
    if not path or not path.exists():
        return []
    rows = []
    with open(path, encoding="utf-8") as f:
        for line in f:
            line = line.strip()
            if not line or line.startswith("#"):
                continue
            # Use domain or URL as a simple "name" if we have no name
            try:
                from urllib.parse import urlparse
                netloc = urlparse(line).netloc or line
                name = netloc.replace("www.", "").split(".")[0] if netloc else line
            except Exception:
                name = line
            rows.append({"brand_name": name, "website_url": line})
    return rows


def dedupe_by_url(rows: list[dict]) -> list[dict]:
    """Keep one row per website_url (first occurrence)."""
    seen: set[str] = set()
    out = []
    for r in rows:
        url = (r.get("website_url") or "").strip().lower()
        if not url or url in seen:
            continue
        seen.add(url)
        out.append(r)
    return out


def write_csv(path: Path, rows: list[dict], append: bool = False) -> None:
    path.parent.mkdir(parents=True, exist_ok=True)
    file_exists = path.exists() and append
    with open(path, "a" if append else "w", newline="", encoding="utf-8") as f:
        w = csv.DictWriter(f, fieldnames=["brand_name", "website_url"], quoting=csv.QUOTE_MINIMAL)
        if not file_exists:
            w.writeheader()
        for r in rows:
            w.writerow({"brand_name": r.get("brand_name", ""), "website_url": r.get("website_url", "")})


def main() -> None:
    parser = argparse.ArgumentParser(
        description="Discover frozen pizza brand URLs by searching the web for 'frozen pizza brands'."
    )
    parser.add_argument(
        "--output",
        "-o",
        type=Path,
        default=PROJECT_ROOT / "data" / "frozen_pizza_brands.csv",
        help="Output CSV path (columns: brand_name, website_url)",
    )
    parser.add_argument(
        "--no-filter",
        action="store_true",
        help="Do not use LLM; output all search result URLs (title as brand_name). No API key needed.",
    )
    parser.add_argument(
        "--seeds",
        "-s",
        type=Path,
        default=None,
        help="Optional: add URLs from file (one per line) to the results.",
    )
    parser.add_argument(
        "--max-results",
        type=int,
        default=25,
        help="Max search results per query (default 25)",
    )
    parser.add_argument(
        "--provider",
        "-p",
        default="openai/gpt-4o-mini",
        help="LiteLLM provider for filter (e.g. openai/gpt-4o-mini)",
    )
    args = parser.parse_args()

    # 1) Search
    print("Searching the web for 'frozen pizza brands'...")
    search_results = search_frozen_pizza_brands(max_results_per_query=args.max_results)
    print(f"  Found {len(search_results)} result(s).")

    if not search_results:
        print("No search results. Check your connection or try again later.", file=sys.stderr)
        sys.exit(1)

    # 2) Optional LLM filter or use all as brands
    if args.no_filter:
        brands = [
            {"brand_name": r.get("title") or r.get("url", ""), "website_url": r.get("url", "")}
            for r in search_results
        ]
    else:
        if not _have_llm():
            print("Set OPENAI_API_KEY (or LLM_API_KEY) to filter results, or use --no-filter.", file=sys.stderr)
            sys.exit(1)
        brands = filter_results_with_llm(search_results, provider=args.provider)
        if not brands:
            print("LLM returned no brands. Try --no-filter to include all search results.", file=sys.stderr)

    # 3) Add optional seed URLs
    if args.seeds:
        seeds = load_seed_urls(args.seeds)
        if seeds:
            brands = brands + seeds
            print(f"  Added {len(seeds)} URL(s) from {args.seeds}.")

    # 4) Dedupe and write
    brands = dedupe_by_url(brands)
    write_csv(args.output, brands, append=False)
    print(f"\nWrote {len(brands)} brand(s) to {args.output}.")


if __name__ == "__main__":
    main()

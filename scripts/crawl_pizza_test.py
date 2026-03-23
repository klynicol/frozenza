#!/usr/bin/env python3
"""
Basic Crawl4AI test: crawl a page for frozen pizza data.
Run from project root: .venv/bin/python scripts/crawl_pizza_test.py
"""
import asyncio
import sys
from pathlib import Path

# Ensure we can import crawl4ai from project venv
sys.path.insert(0, str(Path(__file__).resolve().parent.parent))

from crawl4ai import AsyncWebCrawler, BrowserConfig, CrawlerRunConfig


async def main():
    # Example: crawl a frozen pizza / food page to get markdown content
    url = "https://www.fda.gov/food/recalls-warnings-alerts/fda-recalls-frozen-pizzas-due-risk-contamination"
    print(f"Crawling: {url}\n")

    browser_config = BrowserConfig(
        headless=True,
        verbose=False,
    )
    run_config = CrawlerRunConfig(
        wait_until="domcontentloaded",
    )

    async with AsyncWebCrawler(config=browser_config) as crawler:
        result = await crawler.arun(url=url, config=run_config)

    if result.success:
        print("--- Markdown (first 3000 chars) ---")
        print((result.markdown or "").strip()[:3000])
        if result.markdown and len(result.markdown) > 3000:
            print("\n... (truncated)")
        print("\n--- Done ---")
    else:
        print("Crawl failed:", getattr(result, "error_message", "unknown error"))


if __name__ == "__main__":
    asyncio.run(main())

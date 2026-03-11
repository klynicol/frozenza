# Gameplan: Frozen Pizza Brand Discovery & Extraction

## Goal
Discover and identify **official** frozen pizza brand/product websites in the United States, then extract structured data per your prompt into a CSV.

---

## 1. How we’ll do it effectively

### Phase 1: Seed list (no search API)
- **Source**: Your README brand list + a small curated list of known official URLs.
- We **don’t** use a search API; we start from a **seed URL list** (e.g. `scripts/seed_urls_frozen_pizza.txt`).
- You can add URLs over time (e.g. from manual search, sitemaps, or future discovery runs).

### Phase 2: One URL → one crawl → one LLM extraction
- For **each** seed URL we:
  1. **Crawl** the page with Crawl4AI (markdown or HTML).
  2. **Extract** with Crawl4AI’s `LLMExtractionStrategy` using your full prompt and a Pydantic schema that matches your desired JSON shape.
  3. **Parse** the LLM output as a JSON array of result objects.
- Each page can yield **0, 1, or more** brands (e.g. a parent company page listing several brands). The prompt tells the LLM to return only valid results and to reject non–frozen-pizza / non-official / non–U.S. pages.

### Phase 3: Deduplication and canonical choice
- If the same `brand_name` appears from multiple URLs (e.g. brand homepage + parent company page), we **keep one row per brand**:
  - Prefer the row with **highest `confidence_score`**.
  - If tied, prefer the URL that looks more “canonical” (e.g. brand’s own domain over parent’s subpage).

### Phase 4: Output
- All accepted results are written to **one CSV** with columns exactly matching your prompt.
- Optional: append new runs to the same CSV or write a timestamped file; script will support a single output file and optional append mode.

### Why this works
- **No invented facts**: The LLM only sees the crawled page; we don’t feed it external knowledge.
- **Evidence fields**: Your `evidence_*` and `confidence_score` fields force the model to justify and score, so we can filter or review low-confidence rows.
- **Scalable**: Add more seed URLs and re-run; we can later add a “discovery” step (e.g. crawl a directory page and collect links) and feed those into the same extraction pipeline.

---

## 2. How we’ll organize the CSV

- **Filename**: `frozen_pizza_brands.csv` (or `frozen_pizza_brands_YYYYMMDD.csv` if you want dated runs).
- **Location**: Project root or `data/` (e.g. `data/frozen_pizza_brands.csv`).

**Columns** (one row per brand):

| Column                         | Type   | Notes |
|--------------------------------|--------|--------|
| brand_name                     | string | |
| website_url                    | string | Canonical page URL |
| parent_company                | string | |
| page_title                     | string | |
| evidence_this_is_frozen_pizza  | string | |
| evidence_this_is_official     | string | |
| us_market_evidence             | string | |
| product_types_mentioned       | string | **Pipe-separated** list, e.g. `Frozen Cheese\|Frozen Pepperoni` (CSV-safe, easy to split) |
| contact_or_about_page_url      | string | |
| confidence_score              | int    | 1–10 |

- **Encoding**: UTF-8.
- **Delimiter**: Comma. Any field that contains a comma or newline will be quoted per standard CSV.
- **Array field**: `product_types_mentioned` is stored as a **single pipe-separated string** so we don’t need multiple columns or JSON inside CSV.

If you prefer `product_types_mentioned` as JSON array in one cell (e.g. `["Frozen Cheese","Frozen Pepperoni"]`), we can switch to that; pipe-separated is simpler for Excel and most tools.

---

## 3. What you need to run the script

- **Python**: Use the project venv (e.g. `.venv/bin/python`).
- **Crawl4AI**: Already installed; browser (Chromium) set up.
- **LLM**: An API key for the provider you use (e.g. OpenAI). Set in env, e.g. `OPENAI_API_KEY`.
- **Seed URLs**: Populate `scripts/seed_urls_frozen_pizza.txt` (one URL per line). The script will include a small default list; you can replace or extend it.

After this, we’ll add the script that implements the above and writes the CSV.

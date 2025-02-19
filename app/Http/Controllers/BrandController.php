<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Show the brands page
     * @api {get} /brands Show the brands page
     */
    public function index()
    {
        $brands = Brand::withCount('pizzas')
            ->with('image')
            ->orderBy('name')
            ->get();

        Inertia::share('meta', [
            'title' => 'Frozen Pizza Brands - Complete Brand Directory',
            'description' => 'Browse all frozen pizza brands and manufacturers. Find and compare different frozen pizza brands and their products.',
        ]);

        return Inertia::render('Brands/Index', [
            'brands' => $brands
        ]);
    }

    /**
     * Show the brand page
     * @api {get} /brands/{brand:slug} Show the brand page
     */
    public function show(Brand $brand)
    {
        $brand->load(['pizzas' => function ($query) {
            $query->with(['style', 'brand', 'image'])
                ->orderBy('average_rating', 'desc');
        }, 'image']);

        // Get the brand's schema markup
        $schemaMarkup = $brand->getSchemaMarkup();

        $brandData = array_merge($brand->toArray(), [
            'schema_markup' => $schemaMarkup,
            'seo_title' => $brand->getMetaTitle(),
            'seo_description' => $brand->getMetaDescription(),
            'seo_faq_questions' => $brand->getFAQQuestions(),
            'seo_about_content' => $brand->getAboutContent(),
        ]);

        Inertia::share('meta', [
            'title' => Str::limit($brand->getMetaTitle(), 65),
            'description' => $brand->getMetaDescription(),
            'keywords' => $brand->seo_keywords,
            'canonicalUrl' => "/brands/{$brand->slug}",
            'imageUrl' => $brand->image ? url($brand->image->path . '/' . $brand->image->name) : null,
        ]);

        return Inertia::render('Brands/Show', [
            'brand' => $brandData
        ]);
    }
} 
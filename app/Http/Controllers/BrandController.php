<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Inertia\Inertia;

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

        return Inertia::render('Brands/Index', [
            'brands' => $brands,
            'meta' => [
                'title' => 'Frozen Pizza Brands - Complete List of Manufacturers',
                'description' => 'Browse all frozen pizza brands and manufacturers. Find and compare different frozen pizza brands and their products.',
            ]
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

        return Inertia::render('Brands/Show', [
            'brand' => array_merge($brand->toArray(), [
                'schema_markup' => $schemaMarkup,
                'seo_title' => $brand->getMetaTitle(),
                'seo_description' => $brand->getMetaDescription(),
                'seo_faq_questions' => $brand->getFAQQuestions(),
                'seo_about_content' => $brand->getAboutContent(),
            ]),
            'meta' => [
                'title' => $brand->getMetaTitle(),
                'description' => $brand->getMetaDescription(),
                'keywords' => $brand->seo_keywords,
                'canonicalUrl' => "/brands/{$brand->slug}",
                'imageUrl' => $brand->image ? url($brand->image->path . '/' . $brand->image->name) : null,
            ]
        ]);
    }
} 
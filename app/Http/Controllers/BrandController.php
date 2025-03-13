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
            'description' => "Frozen Pizza Brands: Explore Pizza Kraken's comprehensive directory to compare, learn, and find your favorite frozen pizza options today!",
            'keywords' => "frozen pizza, pizza brands, frozen pizza directory, pizza manufacturers, pizza product comparisons, pizza nutritional information, best frozen pizzas, pizza reviews, brand histories, frozen pizza options",
            'canonicalUrl' => "/brands",
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
        $brand->load(['image', 'pizzas' => function ($query) {
            $query->with(['brand.image', 'tags', 'images' => function($imageQuery){
                $imageQuery->withPivot('type', 'created_at');
            }])
                ->orderBy('average_rating', 'desc');
        }]);

        Inertia::share('meta', [
            'title' => "{$brand->name} Frozen Pizzas | Reviews & Ratings",
            'description' => "Discover {$brand->name}'s best frozen pizza selection. Read reviews, nutritional information, and find your favorite varieties.",
            'keywords' => "{$brand->name}, frozen pizza, pizza reviews, pizza ratings, best frozen pizzas, frozen pizza brands, frozen pizza guide, frozen pizza ingredients, pizza comparison",
            'canonicalUrl' => "/brands/{$brand->slug}",
        ]);

        return Inertia::render('Brands/Show', [
            'brand' => $brand
        ]);
    }
}

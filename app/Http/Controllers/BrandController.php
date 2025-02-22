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
        $brand->load(['image', 'pizzas' => function ($query) {
            $query->with(['brand', 'images' => function($imageQuery){
                $imageQuery->withPivot('type', 'created_at');
            }])
                ->orderBy('average_rating', 'desc');
        }]);

        Inertia::share('meta', [
            'title' => "{$brand->name} Frozen Pizzas | Reviews & Ratings",
            'description' => "Discover {$brand->name}'s best frozen pizza selection. Read reviews, nutritional information, and find your favorite varieties.",
        ]);

        return Inertia::render('Brands/Show', [
            'brand' => $brand
        ]);
    }
} 
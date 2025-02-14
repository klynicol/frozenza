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

        return Inertia::render('Brands/Show', [
            'brand' => $brand,
            'meta' => [
                'title' => "{$brand->name} Frozen Pizzas - Reviews and Ratings",
                'description' => "Browse and review all frozen pizzas from {$brand->name}. Find the best rated {$brand->name} pizzas and where to buy them.",
            ]
        ]);
    }
} 
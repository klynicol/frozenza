<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandValidationRules;
use App\Models\Brand;
use App\Models\Image;
use App\Handlers\ImageHandler;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Show the brands page (public)
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
     * Show the brand page (public)
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

    // ===== ADMIN CRUD OPERATIONS =====

    /**
     * Display a listing of brands for admin
     */
    public function adminIndex()
    {
        $brands = Brand::withCount('pizzas')
            ->with('image')
            ->orderBy('name')
            ->paginate(20);

        return Inertia::render('Admin/Brands/Index', [
            'brands' => $brands
        ]);
    }

    /**
     * Show the form for creating a new brand (admin)
     */
    public function create()
    {
        return Inertia::render('Admin/Brands/Create');
    }

    /**
     * Store a newly created brand (admin or submission flow).
     */
    public function store(Request $request)
    {
        $isSubmission = $request->routeIs('brand-submissions.store');

        $request->validate(
            $isSubmission ? BrandValidationRules::submission() : BrandValidationRules::store()
        );

        $allowed = $isSubmission
            ? ['name', 'description', 'website', 'store_locator_url', 'founded_year', 'brand_story', 'unique_selling_points', 'social_media_handles']
            : ['name', 'slug', 'description', 'website', 'store_locator_url', 'founded_year', 'brand_story', 'unique_selling_points', 'social_media_handles', 'seo_title', 'seo_description', 'seo_about_content', 'seo_keywords'];

        $brandData = $request->only($allowed);
        $brandData['slug'] = ! empty($brandData['slug'] ?? null) ? $brandData['slug'] : Str::slug($request->name);

        if ($request->hasFile('logo')) {
            $image = ImageHandler::upload($request->file('logo'));
            $brandData['image_id'] = $image->id;
        }

        $brand = Brand::create($brandData);

        if ($isSubmission) {
            return redirect()->route('brand-submissions.success', $brand)
                ->with('success', 'Brand submitted successfully! It will be reviewed by our team.');
        }

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand created successfully!');
    }

    /**
     * Display the specified brand for admin
     */
    public function adminShow(Brand $brand)
    {
        $brand->load(['image', 'pizzas' => function ($query) {
            $query->with('image')->orderBy('name');
        }]);

        return Inertia::render('Admin/Brands/Show', [
            'brand' => $brand
        ]);
    }

    /**
     * Show the form for editing the specified brand (admin)
     */
    public function edit(Brand $brand)
    {
        $brand->load('image');

        return Inertia::render('Brands/Edit', [
            'brand' => $brand
        ]);
    }

    /**
     * Update the specified brand (admin)
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate(BrandValidationRules::update($brand));

        $brandData = $request->only([
            'name', 'slug', 'description', 'website', 'store_locator_url', 
            'founded_year', 'brand_story', 'unique_selling_points', 
            'social_media_handles', 'seo_title', 'seo_description', 
            'seo_about_content', 'seo_keywords'
        ]);

        // Generate slug from name if not provided
        if (empty($brandData['slug'])) {
            $brandData['slug'] = Str::slug($request->name);
        }
        
        // Handle logo upload if provided
        if ($request->hasFile('logo')) {
            $image = ImageHandler::upload($request->file('logo'));
            $brandData['image_id'] = $image->id;
        }

        $brand->update($brandData);

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand updated successfully!');
    }

    /**
     * Remove the specified brand (admin)
     */
    public function destroy(Brand $brand)
    {
        // Check if brand has pizzas
        if ($brand->pizzas()->count() > 0) {
            return redirect()->route('admin.brands.index')
                ->with('error', 'Cannot delete brand that has pizzas. Please delete all pizzas first.');
        }

        $brand->delete();

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand deleted successfully!');
    }
}

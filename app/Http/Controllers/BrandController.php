<?php

namespace App\Http\Controllers;

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
     * Store a newly created brand (admin)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
            'slug' => 'nullable|string|max:255|unique:brands,slug',
            'description' => 'required|string|max:1000',
            'website' => 'nullable|url|max:255',
            'store_locator_url' => 'nullable|url|max:255',
            'founded_year' => 'nullable|integer|min:1800|max:' . (date('Y') + 1),
            'brand_story' => 'nullable|string|max:2000',
            'unique_selling_points' => 'nullable|array',
            'unique_selling_points.*' => 'string|max:255',
            'social_media_handles' => 'nullable|array',
            'social_media_handles.*' => 'string|max:255',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:500',
            'seo_about_content' => 'nullable|string|max:2000',
            'seo_keywords' => 'nullable|array',
            'seo_keywords.*' => 'string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

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

        $brand = Brand::create($brandData);

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
        return Inertia::render('Admin/Brands/Edit', [
            'brand' => $brand
        ]);
    }

    /**
     * Update the specified brand (admin)
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'slug' => 'nullable|string|max:255|unique:brands,slug,' . $brand->id,
            'description' => 'required|string|max:1000',
            'website' => 'nullable|url|max:255',
            'store_locator_url' => 'nullable|url|max:255',
            'founded_year' => 'nullable|integer|min:1800|max:' . (date('Y') + 1),
            'brand_story' => 'nullable|string|max:2000',
            'unique_selling_points' => 'nullable|array',
            'unique_selling_points.*' => 'string|max:255',
            'social_media_handles' => 'nullable|array',
            'social_media_handles.*' => 'string|max:255',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:500',
            'seo_about_content' => 'nullable|string|max:2000',
            'seo_keywords' => 'nullable|array',
            'seo_keywords.*' => 'string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

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

    // ===== BRAND SUBMISSION FUNCTIONALITY =====

    /**
     * Show the form for brand submission
     */
    public function submissionCreate()
    {
        return Inertia::render('BrandSubmission/Create');
    }

    /**
     * Store a brand submission
     */
    public function submissionStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
            'description' => 'required|string|max:1000',
            'website' => 'nullable|url|max:255',
            'store_locator_url' => 'nullable|url|max:255',
            'founded_year' => 'nullable|integer|min:1800|max:' . (date('Y') + 1),
            'brand_story' => 'nullable|string|max:2000',
            'unique_selling_points' => 'nullable|array',
            'unique_selling_points.*' => 'string|max:255',
            'social_media_handles' => 'nullable|array',
            'social_media_handles.*' => 'string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $brandData = $request->only([
            'name', 'description', 'website', 'store_locator_url', 'founded_year', 
            'brand_story', 'unique_selling_points', 'social_media_handles'
        ]);

        // Generate slug from name
        $brandData['slug'] = Str::slug($request->name);
        
        // Handle logo upload if provided
        if ($request->hasFile('logo')) {
            $image = ImageHandler::upload($request->file('logo'));
            $brandData['image_id'] = $image->id;
        }

        $brand = Brand::create($brandData);

        return redirect()->route('brand-submissions.success', $brand)
            ->with('success', 'Brand submitted successfully! It will be reviewed by our team.');
    }

    /**
     * Show brand submission success page
     */
    public function submissionSuccess(Brand $brand)
    {
        return Inertia::render('BrandSubmission/Success', [
            'brand' => $brand
        ]);
    }
}

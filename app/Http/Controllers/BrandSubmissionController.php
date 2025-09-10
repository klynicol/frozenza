<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Image;
use App\Handlers\ImageHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class BrandSubmissionController extends Controller
{
    public function create()
    {
        return Inertia::render('BrandSubmission/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
            'description' => 'required|string|max:1000',
            'website' => 'nullable|url|max:255',
            'founded_year' => 'nullable|integer|min:1800|max:' . (date('Y') + 1),
            'brand_story' => 'nullable|string|max:2000',
            'unique_selling_points' => 'nullable|array',
            'unique_selling_points.*' => 'string|max:255',
            'social_media_handles' => 'nullable|array',
            'social_media_handles.*' => 'string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $brandData = $request->only([
            'name', 'description', 'website', 'founded_year', 
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

    public function success(Brand $brand)
    {
        return Inertia::render('BrandSubmission/Success', [
            'brand' => $brand
        ]);
    }
}

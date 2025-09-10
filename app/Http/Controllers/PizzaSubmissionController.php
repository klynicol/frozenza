<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Brand;
use App\Models\Style;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Image;
use App\Handlers\ImageHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

class PizzaSubmissionController extends Controller
{
    public function create()
    {
        $brands = Brand::orderBy('name')->get(['id', 'name']);
        $styles = Style::orderBy('name')->get(['id', 'name']);
        $categories = Category::orderBy('name')->get(['id', 'name']);
        $tags = Tag::orderBy('name')->get(['id', 'name']);

        return Inertia::render('PizzaSubmission/Create', [
            'brands' => $brands,
            'styles' => $styles,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'brand_id' => 'required|exists:brands,id',
            'style_id' => 'nullable|exists:styles,id',
            'ingredients' => 'nullable|array',
            'ingredients.*' => 'string|max:255',
            'allergens' => 'nullable|string|max:500',
            'website' => 'nullable|url|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'pizza_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pizzaData = $request->only([
            'name', 'description', 'brand_id', 'style_id', 
            'ingredients', 'allergens', 'website'
        ]);

        // Generate slug from name and brand
        $brand = Brand::find($request->brand_id);
        $pizzaData['slug'] = Str::slug($brand->slug . '-' . $request->name);
        
        // Handle pizza image upload if provided
        if ($request->hasFile('pizza_image')) {
            $image = ImageHandler::upload($request->file('pizza_image'));
            $pizzaData['image_url'] = $image->id; // We'll use image_id instead
        }

        $pizza = Pizza::create($pizzaData);

        // Attach tags if provided
        if ($request->has('tags')) {
            $pizza->tags()->attach($request->tags);
        }

        // Attach categories if provided
        if ($request->has('categories')) {
            $pizza->categories()->attach($request->categories);
        }

        return redirect()->route('pizza-submissions.success', $pizza)
            ->with('success', 'Pizza submitted successfully! It will be reviewed by our team.');
    }

    public function success(Pizza $pizza)
    {
        return Inertia::render('PizzaSubmission/Success', [
            'pizza' => $pizza->load('brand')
        ]);
    }
}

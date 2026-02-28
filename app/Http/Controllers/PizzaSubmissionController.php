<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Brand;
use App\Models\Tag;
use App\Models\Image;
use App\Models\NutritionFact;
use App\Handlers\ImageHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\File;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

class PizzaSubmissionController extends Controller
{
    public function create()
    {
        $brands = Brand::orderBy('name')->get(['id', 'name']);
        $tags = Tag::orderBy('slug')->get(['id', 'slug']);

        return Inertia::render('PizzaSubmission/Create', [
            'brands' => $brands,
            'tags' => $tags,
            'meta' => [
                'title' => 'Submit New Pizza',
                'description' => 'Submit a new frozen pizza to Frozenza.',
                'canonicalUrl' => '/' . request()->path(),
                'keywords' => 'submit pizza, frozen pizza, add pizza',
            ],
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'brand_id' => 'required|exists:brands,id',
            'ingredients' => 'nullable|string|max:5000',
            'allergens' => 'nullable|string|max:500',
            'website' => 'nullable|url|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'pizza_image' => ['nullable', File::types(['jpg', 'jpeg', 'png', 'gif'])->max('100mb')],
            'nutrition' => 'nullable|array',
            'nutrition.serving_per_container' => 'nullable|string|max:255',
            'nutrition.serving_size' => 'nullable|string|max:255',
            'nutrition.calories' => 'nullable',
            'nutrition.total_fat' => 'nullable|string|max:10',
            'nutrition.saturated_fat' => 'nullable|string|max:10',
            'nutrition.trans_fat' => 'nullable|string|max:10',
            'nutrition.cholesterol' => 'nullable|string|max:10',
            'nutrition.sodium' => 'nullable|string|max:10',
            'nutrition.total_carbohydrate' => 'nullable|string|max:10',
            'nutrition.dietary_fiber' => 'nullable|string|max:10',
            'nutrition.total_sugars' => 'nullable|string|max:10',
            'nutrition.added_sugars' => 'nullable|string|max:10',
            'nutrition.protein' => 'nullable|string|max:10',
            'nutrition.vitamin_d' => 'nullable|string|max:10',
            'nutrition.calcium' => 'nullable|string|max:10',
            'nutrition.iron' => 'nullable|string|max:10',
            'nutrition.potassium' => 'nullable|string|max:10',
            'nutrition.monounsaturated_fat' => 'nullable|string|max:10',
            'nutrition.polyunsaturated_fat' => 'nullable|string|max:10',
            'nutrition.vitamin_a' => 'nullable|string|max:10',
            'nutrition.vitamin_c' => 'nullable|string|max:10',
        ], [
            'pizza_image.max' => 'The pizza image must not be larger than 100 MB.',
            'pizza_image.uploaded' => 'The pizza image could not be uploaded. It may be too large (max 2 MB) or the connection was interrupted. Please try a smaller image.',
            'pizza_image.image' => 'The pizza image must be an image (JPEG, PNG, JPG, or GIF).',
            'pizza_image.mimes' => 'The pizza image must be a JPEG, PNG, JPG, or GIF.',
        ]);

        $pizzaData = $request->only([
            'name', 'description', 'brand_id',
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

        // Create nutrition facts if provided
        $nutrition = $request->input('nutrition', []);
        if (is_string($nutrition)) {
            $nutrition = json_decode($nutrition, true) ?? [];
        }
        $nutritionFilled = collect($nutrition)->filter(fn ($v) => $v !== null && $v !== '')->isNotEmpty();
        if ($nutritionFilled) {
            $nutritionData = array_filter([
                'pizza_id' => $pizza->id,
                'serving_per_container' => $nutrition['serving_per_container'] ?? null,
                'serving_size' => $nutrition['serving_size'] ?? null,
                'calories' => isset($nutrition['calories']) && $nutrition['calories'] !== '' ? (int) $nutrition['calories'] : null,
                'total_fat' => $nutrition['total_fat'] ?? null,
                'saturated_fat' => $nutrition['saturated_fat'] ?? null,
                'trans_fat' => $nutrition['trans_fat'] ?? null,
                'cholesterol' => $nutrition['cholesterol'] ?? null,
                'sodium' => $nutrition['sodium'] ?? null,
                'total_carbohydrate' => $nutrition['total_carbohydrate'] ?? null,
                'dietary_fiber' => $nutrition['dietary_fiber'] ?? null,
                'total_sugars' => $nutrition['total_sugars'] ?? null,
                'added_sugars' => $nutrition['added_sugars'] ?? null,
                'protein' => $nutrition['protein'] ?? null,
                'vitamin_d' => $nutrition['vitamin_d'] ?? null,
                'calcium' => $nutrition['calcium'] ?? null,
                'iron' => $nutrition['iron'] ?? null,
                'potassium' => $nutrition['potassium'] ?? null,
                'monounsaturated_fat' => $nutrition['monounsaturated_fat'] ?? null,
                'polyunsaturated_fat' => $nutrition['polyunsaturated_fat'] ?? null,
                'vitamin_a' => $nutrition['vitamin_a'] ?? null,
                'vitamin_c' => $nutrition['vitamin_c'] ?? null,
            ], fn ($v) => $v !== null && $v !== '');
            // Only create if we have required fields (serving_per_container, serving_size, calories, total_fat, total_carbohydrate, protein)
            $required = ['serving_per_container', 'serving_size', 'calories', 'total_fat', 'total_carbohydrate', 'protein'];
            $hasRequired = count(array_intersect_key(array_flip($required), $nutritionData)) === count($required);
            if ($hasRequired) {
                NutritionFact::create($nutritionData);
            }
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

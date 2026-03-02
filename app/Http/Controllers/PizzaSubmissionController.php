<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Brand;
use App\Models\Tag;
use App\Models\Image;
use App\Models\NutritionFact;
use App\Handlers\ImageHandler;
use App\Enums\PizzaImageType;
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
            'nutrition.serving_per_container' => 'nullable|integer|min:1',
            'nutrition.serving_fraction' => 'nullable|string|max:20',
            'nutrition.serving_weight' => 'nullable|integer|min:0',
            'nutrition.calories' => 'nullable',
            'nutrition.caloris_from_fat' => 'nullable|integer|min:0',
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
            'pizza_image.uploaded' => 'The pizza image could not be uploaded. It may be too large (max 100 MB) or the connection was interrupted. Please try a smaller image.',
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

        $pizza = Pizza::create($pizzaData);
        
        // Handle pizza image upload if provided
        if ($request->hasFile('pizza_image')) {
            $image = ImageHandler::upload($request->file('pizza_image'));
            $pizza->images()->attach($image, [
                'image_id' => $image->id,
                'type' => PizzaImageType::MAIN
            ]);
        }

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
            $normalize = function ($v) {
                if ($v === null || $v === '') return null;
                if (is_numeric($v)) return (float) $v;
                return (float) preg_replace('/[^0-9.-]/', '', (string) $v);
            };
            $nutritionData = array_filter([
                'pizza_id' => $pizza->id,
                'serving_per_container' => isset($nutrition['serving_per_container']) && $nutrition['serving_per_container'] !== '' ? (int) $nutrition['serving_per_container'] : null,
                'serving_fraction' => isset($nutrition['serving_fraction']) && $nutrition['serving_fraction'] !== '' ? (string) $nutrition['serving_fraction'] : '1',
                'serving_weight' => isset($nutrition['serving_weight']) && $nutrition['serving_weight'] !== '' ? (int) $nutrition['serving_weight'] : 0,
                'calories' => isset($nutrition['calories']) && $nutrition['calories'] !== '' ? (int) $nutrition['calories'] : null,
                'caloris_from_fat' => isset($nutrition['caloris_from_fat']) && $nutrition['caloris_from_fat'] !== '' ? (int) $nutrition['caloris_from_fat'] : 0,
                'total_fat' => $normalize($nutrition['total_fat'] ?? null),
                'saturated_fat' => $normalize($nutrition['saturated_fat'] ?? null),
                'trans_fat' => $normalize($nutrition['trans_fat'] ?? null),
                'cholesterol' => $normalize($nutrition['cholesterol'] ?? null),
                'sodium' => $normalize($nutrition['sodium'] ?? null),
                'total_carbohydrate' => $normalize($nutrition['total_carbohydrate'] ?? null),
                'dietary_fiber' => $normalize($nutrition['dietary_fiber'] ?? null),
                'total_sugars' => $normalize($nutrition['total_sugars'] ?? null),
                'added_sugars' => $normalize($nutrition['added_sugars'] ?? null),
                'protein' => $normalize($nutrition['protein'] ?? null),
                'vitamin_d' => $normalize($nutrition['vitamin_d'] ?? null),
                'calcium' => $normalize($nutrition['calcium'] ?? null),
                'iron' => $normalize($nutrition['iron'] ?? null),
                'potassium' => $normalize($nutrition['potassium'] ?? null),
                'monounsaturated_fat' => $normalize($nutrition['monounsaturated_fat'] ?? null),
                'polyunsaturated_fat' => $normalize($nutrition['polyunsaturated_fat'] ?? null),
                'vitamin_a' => $normalize($nutrition['vitamin_a'] ?? null),
                'vitamin_c' => $normalize($nutrition['vitamin_c'] ?? null),
            ], fn ($v) => $v !== null && $v !== '');
            // Only create if we have required fields (serving_per_container, serving_fraction or serving_weight, calories, total_fat, total_carbohydrate, protein)
            $required = ['serving_per_container', 'calories', 'total_fat', 'total_carbohydrate', 'protein'];
            $hasRequired = count(array_intersect_key(array_flip($required), $nutritionData)) === count($required)
                && (!empty($nutritionData['serving_fraction']) || isset($nutritionData['serving_weight']));
            if ($hasRequired) {
                NutritionFact::create($nutritionData);
            }
        }

        return redirect()->route('pizza-submissions.success', $pizza)
            ->with('success', 'Pizza submitted successfully! It will be reviewed by our team.');
    }

    public function edit(Pizza $pizza)
    {
        $pizza->load(['brand', 'tags', 'nutritionFact', 'images' => fn ($q) => $q->withPivot('type', 'created_at')]);
        $brands = Brand::orderBy('name')->get(['id', 'name']);
        $tags = Tag::orderBy('slug')->get(['id', 'slug']);

        return Inertia::render('PizzaSubmission/Edit', [
            'pizza' => $pizza,
            'brands' => $brands,
            'tags' => $tags,
            'meta' => [
                'title' => 'Edit Pizza: ' . $pizza->name,
                'description' => 'Edit pizza details for ' . $pizza->name . '.',
                'canonicalUrl' => '/' . request()->path(),
                'keywords' => 'edit pizza, frozen pizza',
            ],
        ]);
    }

    public function update(Request $request, Pizza $pizza)
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
            'nutrition.serving_per_container' => 'nullable|integer|min:1',
            'nutrition.serving_fraction' => 'nullable|string|max:20',
            'nutrition.serving_weight' => 'nullable|integer|min:0',
            'nutrition.calories' => 'nullable',
            'nutrition.caloris_from_fat' => 'nullable|integer|min:0',
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
            'pizza_image.uploaded' => 'The pizza image could not be uploaded. It may be too large (max 100 MB) or the connection was interrupted. Please try a smaller image.',
            'pizza_image.image' => 'The pizza image must be an image (JPEG, PNG, JPG, or GIF).',
            'pizza_image.mimes' => 'The pizza image must be a JPEG, PNG, JPG, or GIF.',
        ]);

        $brand = Brand::find($request->brand_id);
        $pizza->update([
            'name' => $request->name,
            'slug' => Str::slug($brand->slug . '-' . $request->name),
            'description' => $request->description,
            'brand_id' => $request->brand_id,
            'ingredients' => $request->ingredients,
            'allergens' => $request->allergens,
            'website' => $request->website,
        ]);

        if ($request->hasFile('pizza_image')) {
            $pizza->images()->wherePivot('type', PizzaImageType::MAIN->value)->detach();
            $image = ImageHandler::upload($request->file('pizza_image'));
            $pizza->images()->attach($image, [
                'image_id' => $image->id,
                'type' => PizzaImageType::MAIN,
            ]);
        }

        if ($request->has('tags')) {
            $pizza->tags()->sync($request->tags);
        }

        $nutrition = $request->input('nutrition', []);
        if (is_string($nutrition)) {
            $nutrition = json_decode($nutrition, true) ?? [];
        }
        $nutritionFilled = collect($nutrition)->filter(fn ($v) => $v !== null && $v !== '')->isNotEmpty();
        $normalize = function ($v) {
            if ($v === null || $v === '') return null;
            if (is_numeric($v)) return (float) $v;
            return (float) preg_replace('/[^0-9.-]/', '', (string) $v);
        };
        if ($nutritionFilled) {
            $nutritionData = array_filter([
                'serving_per_container' => isset($nutrition['serving_per_container']) && $nutrition['serving_per_container'] !== '' ? (int) $nutrition['serving_per_container'] : null,
                'serving_fraction' => isset($nutrition['serving_fraction']) && $nutrition['serving_fraction'] !== '' ? (string) $nutrition['serving_fraction'] : '1',
                'serving_weight' => isset($nutrition['serving_weight']) && $nutrition['serving_weight'] !== '' ? (int) $nutrition['serving_weight'] : 0,
                'calories' => isset($nutrition['calories']) && $nutrition['calories'] !== '' ? (int) $nutrition['calories'] : null,
                'caloris_from_fat' => isset($nutrition['caloris_from_fat']) && $nutrition['caloris_from_fat'] !== '' ? (int) $nutrition['caloris_from_fat'] : 0,
                'total_fat' => $normalize($nutrition['total_fat'] ?? null),
                'saturated_fat' => $normalize($nutrition['saturated_fat'] ?? null),
                'trans_fat' => $normalize($nutrition['trans_fat'] ?? null),
                'cholesterol' => $normalize($nutrition['cholesterol'] ?? null),
                'sodium' => $normalize($nutrition['sodium'] ?? null),
                'total_carbohydrate' => $normalize($nutrition['total_carbohydrate'] ?? null),
                'dietary_fiber' => $normalize($nutrition['dietary_fiber'] ?? null),
                'total_sugars' => $normalize($nutrition['total_sugars'] ?? null),
                'added_sugars' => $normalize($nutrition['added_sugars'] ?? null),
                'protein' => $normalize($nutrition['protein'] ?? null),
                'vitamin_d' => $normalize($nutrition['vitamin_d'] ?? null),
                'calcium' => $normalize($nutrition['calcium'] ?? null),
                'iron' => $normalize($nutrition['iron'] ?? null),
                'potassium' => $normalize($nutrition['potassium'] ?? null),
                'monounsaturated_fat' => $normalize($nutrition['monounsaturated_fat'] ?? null),
                'polyunsaturated_fat' => $normalize($nutrition['polyunsaturated_fat'] ?? null),
                'vitamin_a' => $normalize($nutrition['vitamin_a'] ?? null),
                'vitamin_c' => $normalize($nutrition['vitamin_c'] ?? null),
            ], fn ($v) => $v !== null && $v !== '');
            $required = ['serving_per_container', 'calories', 'total_fat', 'total_carbohydrate', 'protein'];
            $hasRequired = count(array_intersect_key(array_flip($required), $nutritionData)) === count($required)
                && (!empty($nutritionData['serving_fraction']) || isset($nutritionData['serving_weight']));
            if ($hasRequired) {
                $nutritionData['pizza_id'] = $pizza->id;
                $pizza->nutritionFact()->updateOrCreate(['pizza_id' => $pizza->id], $nutritionData);
            }
        }

        return redirect()->route('pizzas.show', [$pizza->brand->slug, $pizza->slug])
            ->with('success', 'Pizza updated successfully.');
    }

    public function success(Pizza $pizza)
    {
        return Inertia::render('PizzaSubmission/Success', [
            'pizza' => $pizza->load('brand')
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('pizzas')
            ->orderBy('name')
            ->get();

        Inertia::share('meta', [
            'title' => 'Pizza Categories - Find Your Perfect Pizza',
            'description' => 'Browse frozen pizzas by category. From vegetarian to meat lovers, find the perfect frozen pizza for your taste.',
        ]);

        return Inertia::render('Categories/Index', [
            'categories' => $categories
        ]);
    }

    public function show(Category $category)
    {
        $category->load(['pizzas' => function ($query) {
            $query->with(['brand'])
                ->orderBy('average_rating', 'desc');
        }]);

        Inertia::share('meta', [
            'title' => Str::limit("{$category->name} Frozen Pizzas - Reviews", 65),
            'description' => "Find the best {$category->name} frozen pizzas. Compare brands, read reviews, and discover where to buy.",
        ]);

        return Inertia::render('Categories/Show', [
            'category' => $category
        ]);
    }
} 
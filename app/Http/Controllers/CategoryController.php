<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('pizzas')
            ->orderBy('name')
            ->get();

        return Inertia::render('Categories/Index', [
            'categories' => $categories,
            'meta' => [
                'title' => 'Pizza Categories - Find Your Perfect Frozen Pizza',
                'description' => 'Browse frozen pizzas by category. From vegetarian to meat lovers, find the perfect frozen pizza for your taste.',
            ]
        ]);
    }

    public function show(Category $category)
    {
        $category->load(['pizzas' => function ($query) {
            $query->with(['brand', 'style'])
                ->orderBy('average_rating', 'desc');
        }]);

        return Inertia::render('Categories/Show', [
            'category' => $category,
            'meta' => [
                'title' => "{$category->name} Frozen Pizzas - Reviews and Ratings",
                'description' => "Find the best {$category->name} frozen pizzas. Compare brands, read reviews, and discover where to buy {$category->name} pizzas.",
            ]
        ]);
    }
} 
<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PizzaController extends Controller
{
    public function index()
    {
        info('what');
        $pizzas = Pizza::with(['brand', 'style', 'categories'])
            ->orderBy('average_rating', 'desc')
            ->paginate(12);

        info($pizzas);
        return Inertia::render('Pizzas/Index', [
            'pizzas' => $pizzas,
            'meta' => [
                'title' => 'Frozen Pizza Reviews - Find the Best Frozen Pizzas',
                'description' => 'Discover and review the best frozen pizzas. Read honest reviews, ratings, and find where to buy your favorite frozen pizzas.',
            ]
        ]);
    }

    public function show(Pizza $pizza)
    {
        $pizza->load(['brand', 'style', 'categories', 'reviews.user']);
        
        return Inertia::render('Pizzas/Show', [
            'pizza' => $pizza,
            'meta' => [
                'title' => "{$pizza->name} by {$pizza->brand->name} - Frozen Pizza Review",
                'description' => "Read reviews and ratings for {$pizza->name} frozen pizza by {$pizza->brand->name}. Find out where to buy and what others think about this {$pizza->style->name} pizza.",
            ]
        ]);
    }

    public function topRated()
    {
        $pizzas = Pizza::with(['brand', 'style', 'categories'])
            ->where('average_rating', '>=', 4.0)
            ->orderBy('average_rating', 'desc')
            ->take(10)
            ->get();

        return Inertia::render('Pizzas/TopRated', [
            'pizzas' => $pizzas,
            'meta' => [
                'title' => 'Top 10 Best Rated Frozen Pizzas - Community Favorites',
                'description' => 'Discover the highest-rated frozen pizzas according to our community. See reviews, ratings, and where to buy these top-rated frozen pizzas.',
            ]
        ]);
    }
} 
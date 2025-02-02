<?php

namespace App\Http\Controllers;

use App\Models\Style;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StyleController extends Controller
{
    public function index()
    {
        $styles = Style::withCount('pizzas')
            ->orderBy('name')
            ->get();

        return Inertia::render('Styles/Index', [
            'styles' => $styles,
            'meta' => [
                'title' => 'Pizza Styles - Different Types of Frozen Pizza',
                'description' => 'Explore different styles of frozen pizza from thin crust to deep dish. Find reviews and ratings for each pizza style.',
            ]
        ]);
    }

    public function show(Style $style)
    {
        $style->load(['pizzas' => function ($query) {
            $query->with(['brand', 'categories'])
                ->orderBy('average_rating', 'desc');
        }]);

        return Inertia::render('Styles/Show', [
            'style' => $style,
            'meta' => [
                'title' => "{$style->name} Frozen Pizzas - Reviews and Ratings",
                'description' => "Discover the best {$style->name} frozen pizzas. Compare brands, read reviews, and find where to buy {$style->name} pizzas.",
            ]
        ]);
    }
} 
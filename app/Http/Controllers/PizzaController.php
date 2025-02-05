<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PizzaController extends Controller
{

    const PIZZAS_PER_PAGE = 12;

    public function index(): InertiaResponse
    {
        return Inertia::render('Pizzas/Index', [
            'pizzasFirstPage' => $this->list(),
            'meta' => [
                'title' => 'Frozen Pizza Reviews - Find the Best Frozen Pizzas',
                'description' => 'Discover and review the best frozen pizzas. Read honest reviews, ratings, and find where to buy your favorite frozen pizzas.',
            ]
        ]);
    }

    public function list(Request|null $request = null): LengthAwarePaginator
    {
        $page = $request?->input('page', 1) ?? 1;
        $pizzas = Pizza::with(['brand', 'style', 'categories'])
            ->orderBy('average_rating', 'desc')
            ->paginate(self::PIZZAS_PER_PAGE, ['*'], 'page', $page);
        return $pizzas;
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

    public function topRated(): InertiaResponse
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

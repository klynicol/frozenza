<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Pizza;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PizzaResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PizzaController extends Controller
{

    const PIZZAS_PER_PAGE = 12;

    /**
     * Display a listing of the resource.
     * 
     *@api {get} /pizzas Get all pizzas
     */
    public function index(): InertiaResponse
    {
        Inertia::share('meta', [
            'title' => "Pizza Kraken - The Frozen Pizza Directory",
            'description' => 'Discover and review the best frozen pizzas. Read honest reviews, ratings, and find where to buy your favorite frozen pizzas.',
        ]);

        return Inertia::render('Pizzas/Index', [
            'pizzasFirstPage' => $this->list(),
        ]);
    }

    /**
     * Get all pizzas
     * 
     *@api {get} /pizzas/list Get all pizzas
     */
    public function list(Request|null $request = null): AnonymousResourceCollection
    {
        $page = $request?->input('page', 1) ?? 1;

        $pizzas = Pizza::orderBy('average_rating', 'desc')
            ->with(['brand', 'tags', 'images' => function ($query) {
                $query->withPivot('type', 'created_at');
            }])
            ->paginate(self::PIZZAS_PER_PAGE, ['*'], 'page', $page);

        return PizzaResource::collection($pizzas);
    }

    /**
     * Display the specified pizza.
     * 
     *@api {get} /pizzas/{pizza:slug} Get a pizza
     */
    public function show(Brand $brand, Pizza $pizza)
    {
        $pizza->load([
            'brand',
            'tags',
            'reviews' => function ($query) {
                $query->with(['user', 'images']);
            },
            'images' => function ($query) {
                $query->withPivot('type', 'created_at');
            }
        ]);
        $brandName = $pizza?->brand?->name ?? 'Unknown Brand';

        // Add hasUserReviewed property
        $hasUserReviewed = false;
        if (Auth::check()) {
            $hasUserReviewed = $pizza->reviews()->where('user_id', Auth::id())->exists();
        }

        $tags = implode(', ', $pizza->tags ?? []);

        Inertia::share('meta', [
            'title' => "{$pizza->name} by {$brandName}",
            'description' => "Read reviews and ratings for {$pizza->name} frozen pizza by {$brandName}. Find out where to buy and what others think about this {$tags} pizza.",
        ]);

        return Inertia::render('Pizzas/Show', [
            'pizza' => array_merge($pizza->toArray(), ['hasUserReviewed' => $hasUserReviewed]),
        ]);
    }

    /**
     * Get the top rated pizzas
     * 
     *@api {get} /pizzas/top-rated Get the top rated pizzas
     */
    public function topRated(): InertiaResponse
    {
        $pizzas = Pizza::with(['brand', 'style', 'image'])
            ->orderBy('average_rating', 'desc')
            ->take(10)
            ->get();

        Inertia::share('meta', [
            'title' => 'Top 10 Best Rated Frozen Pizzas',
            'description' => 'Discover the highest-rated frozen pizzas according to our community. See reviews, ratings, and where to buy these top-rated frozen pizzas.',
        ]);

        return Inertia::render('Pizzas/TopRated', [
            'pizzas' => $pizzas,
        ]);
    }
}

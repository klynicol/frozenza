<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Pizza;

class PizzaTagController extends Controller
{
    public function show(string $tagSlug)
    {
        // Find all pizzas with a specific tag
        $pizzas = Pizza::whereHas('tags', function ($query) use ($tagSlug) {
            $query->where('slug', $tagSlug);
        })->get();

        // Find pizzas with multiple tags
        $pizzas = Pizza::whereHas('tags', function ($query) {
            $query->whereIn('slug', ['vegetarian', 'spicy']);
        }, '=', 2)->get();
    }
}

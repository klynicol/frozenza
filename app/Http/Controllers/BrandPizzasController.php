<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Inertia\Inertia;

class BrandPizzasController extends Controller
{
    public function index(Brand $brand)
    {
        $pizzas = $brand->pizzas()->paginate(12);

        return Inertia::render('Pizzas/Index', [
            'pizzas' => $pizzas,
            'meta' => [
                'title' => "{$brand->name} Pizzas",
                'description' => "Explore all pizzas from {$brand->name}.",
            ],
        ]);
    }
}

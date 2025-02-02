<?php

namespace Database\Factories;

use App\Models\Style;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StyleFactory extends Factory
{
    protected $model = Style::class;

    public function definition(): array
    {
        $styles = ['Thin Crust', 'Deep Dish', 'New York Style', 'Neapolitan', 'Detroit Style', 'Sicilian', 'Pan Pizza'];
        $name = $this->faker->unique()->randomElement($styles);
        
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(),
        ];
    }
} 
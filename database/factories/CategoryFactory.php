<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $categories = [
            'Vegetarian', 'Meat Lovers', 'Spicy', 'BBQ', 'Supreme', 
            'Hawaiian', 'Cheese Lovers', 'Low Calorie', 'Gluten Free'
        ];
        $name = $this->faker->unique()->randomElement($categories);
        
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(),
        ];
    }
} 
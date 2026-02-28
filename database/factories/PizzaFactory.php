<?php

namespace Database\Factories;

use App\Models\Pizza;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PizzaFactory extends Factory
{
    protected $model = Pizza::class;

    public function definition(): array
    {
        $name = $this->faker->words(3, true);
        return [
            'brand_id' => Brand::factory(),
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(),
            'ingredients' => $this->faker->randomElements([
                'Mozzarella', 'Tomato Sauce', 'Pepperoni', 'Mushrooms',
                'Onions', 'Bell Peppers', 'Sausage', 'Bacon', 'Ham',
                'Pineapple', 'Olives', 'Chicken', 'Beef', 'Spinach'
            ], $this->faker->numberBetween(4, 8)),
            'nutritional_info' => [
                'calories' => $this->faker->numberBetween(200, 400),
                'protein' => $this->faker->numberBetween(10, 25),
                'carbs' => $this->faker->numberBetween(25, 45),
                'fat' => $this->faker->numberBetween(8, 20),
            ],
            'average_rating' => 0,
            'total_reviews' => 0,
            'tags' => $this->faker->randomElements([
                'Spicy', 'Mild', 'Cheesy', 'Meaty', 'Veggie',
                'Thin', 'Thick', 'Crispy', 'Gourmet', 'Classic'
            ], $this->faker->numberBetween(2, 5)),
            'image_url' => $this->faker->imageUrl(640, 480, 'pizza'),
        ];
    }
} 
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pizza;
use App\Models\Brand;
use App\Models\Style;
use App\Models\Category;
use App\Models\Tag;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some brands
        $brands = [
            ['name' => 'DiGiorno', 'slug' => 'digiorno', 'description' => 'DiGiorno is known for its rising crust pizzas.'],
            ['name' => 'Tombstone', 'slug' => 'tombstone', 'description' => 'Tombstone offers a variety of classic frozen pizzas.'],
            ['name' => 'Red Baron', 'slug' => 'red-baron', 'description' => 'Red Baron is famous for its classic crust pizzas.'],
        ];

        foreach ($brands as $brandData) {
            Brand::create($brandData);
        }

        // Create some styles
        $styles = [
            ['name' => 'Thin Crust', 'slug' => 'thin-crust', 'description' => 'A crispy and thin crust.'],
            ['name' => 'Deep Dish', 'slug' => 'deep-dish', 'description' => 'A thick and hearty crust.'],
            ['name' => 'Stuffed Crust', 'slug' => 'stuffed-crust', 'description' => 'A crust filled with cheese.'],
        ];

        foreach ($styles as $styleData) {
            Style::create($styleData);
        }

        // Create some categories
        $categories = [
            ['name' => 'Vegetarian', 'slug' => 'vegetarian', 'description' => 'Pizzas with no meat.'],
            ['name' => 'Meat Lovers', 'slug' => 'meat-lovers', 'description' => 'Pizzas loaded with meat toppings.'],
            ['name' => 'Cheese Lovers', 'slug' => 'cheese-lovers', 'description' => 'Pizzas with extra cheese.'],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Create some tags
        $tags = [
            ['name' => 'Spicy', 'slug' => 'spicy'],
            ['name' => 'Cheesy', 'slug' => 'cheesy'],
            ['name' => 'Meaty', 'slug' => 'meaty'],
            ['name' => 'Savory', 'slug' => 'savory'],
            ['name' => 'Classic', 'slug' => 'classic'],
        ];

        foreach ($tags as $tagData) {
            Tag::create($tagData);
        }

        // Create some pizzas
        $pizzas = [
            [
                'name' => 'DiGiorno Rising Crust Pepperoni',
                'slug' => 'digiorno-rising-crust-pepperoni',
                'description' => 'A classic pepperoni pizza with a rising crust.',
                'brand_id' => Brand::where('slug', 'digiorno')->first()->id,
                'style_id' => Style::where('slug', 'stuffed-crust')->first()->id,
                'ingredients' => ['Pepperoni', 'Mozzarella Cheese', 'Tomato Sauce'],
                'nutritional_info' => ['calories' => 300, 'protein' => 15, 'carbs' => 35, 'fat' => 12],
                'average_rating' => 4.5,
                'total_reviews' => 100,
                'image_url' => 'https://example.com/digiorno-pepperoni.jpg',
            ],
            [
                'name' => 'Tombstone Original 4 Meat',
                'slug' => 'tombstone-original-4-meat',
                'description' => 'A pizza loaded with four types of meat.',
                'brand_id' => Brand::where('slug', 'tombstone')->first()->id,
                'style_id' => Style::where('slug', 'deep-dish')->first()->id,
                'ingredients' => ['Sausage', 'Pepperoni', 'Ham', 'Bacon'],
                'nutritional_info' => ['calories' => 350, 'protein' => 20, 'carbs' => 40, 'fat' => 15],
                'average_rating' => 4.2,
                'total_reviews' => 80,
                'image_url' => 'https://example.com/tombstone-4-meat.jpg',
            ],
            [
                'name' => 'Red Baron Classic Crust Cheese',
                'slug' => 'red-baron-classic-crust-cheese',
                'description' => 'A classic cheese pizza with a crispy crust.',
                'brand_id' => Brand::where('slug', 'red-baron')->first()->id,
                'style_id' => Style::where('slug', 'thin-crust')->first()->id,
                'ingredients' => ['Mozzarella Cheese', 'Cheddar Cheese', 'Tomato Sauce'],
                'nutritional_info' => ['calories' => 280, 'protein' => 12, 'carbs' => 30, 'fat' => 10],
                'average_rating' => 4.0,
                'total_reviews' => 60,
                'image_url' => 'https://example.com/red-baron-cheese.jpg',
            ],
        ];

        foreach ($pizzas as $pizzaData) {
            $pizza = Pizza::create($pizzaData);
            $pizza->tags()->attach(Tag::whereIn('slug', ['spicy', 'cheesy'])->pluck('id'));
        }
    }
} 
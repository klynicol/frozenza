<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pizza;
use App\Models\Brand;
use App\Models\Style;
use App\Models\Category;
use App\Models\Tag;

class RedBaronPizzaSeeder extends Seeder
{
    public function run(): void
    {
        $brand = Brand::firstOrCreate(
            ['name' => 'Red Baron'],
            ['slug' => 'red-baron', 'description' => 'Red Baron is famous for its classic crust pizzas.']
        );

        $style = Style::firstOrCreate(
            ['name' => 'Classic Crust'],
            ['slug' => 'classic-crust', 'description' => 'Not too thick and not too thin with just the right amount of crunch.']
        );

        Pizza::create([
            'name' => 'RED BARON Classic Crust Pepperoni Pizza',
            'slug' => 'red-baron-classic-crust-pepperoni',
            'description' => 'Savor the mouthwatering taste of zesty tomato sauce, 100% real cheese and a hearty topping of pepperoni.',
            'brand_id' => $brand->id,
            'style_id' => $style->id,
            'ingredients' => [
                'Tomatoes', 'Enriched Flour', 'Low Moisture Part Skim Mozzarella Cheese', 'Pepperoni', 'Water', 
                'Yeast', 'Palm Oil', 'Vegetable Oil', 'Sugar', 'Salt', 'Modified Food Starch', 'Spice', 
                'Maltodextrin', 'Sea Salt', 'Dried Garlic', 'Hydrolyzed Soy And Corn Protein', 'Paprika', 
                'Dried Onion', 'Dough Conditioners', 'Natural Flavor', 'Soy Lecithin'
            ],
            'nutritional_info' => [
                'calories' => 380,
                'total_fat' => 17,
                'saturated_fat' => 8,
                'trans_fat' => 0,
                'cholesterol' => 40,
                'sodium' => 790,
                'total_carbohydrate' => 40,
                'dietary_fiber' => 2,
                'total_sugars' => 8,
                'added_sugars' => 1,
                'protein' => 14,
            ],
            'average_rating' => 4.5,
            'total_reviews' => 150,
            'tags' => ['Cheesy', 'Pepperoni', 'Classic'],
            'image_url' => 'https://example.com/red-baron-pepperoni.jpg',
        ])
            ->categories()->attach(Category::where('slug', 'pizza')->first())
            ->tags()->attach(Tag::where('slug', 'cheesy')->first())
            ->tags()->attach(Tag::where('slug', 'pepperoni')->first())
            ->tags()->attach(Tag::where('slug', 'classic')->first());
    }
} 
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            //toppings
            ['slug' => 'pepperoni'],
            ['slug' => 'mushroom'],
            ['slug' => 'garlic'],
            ['slug' => 'pineapple'],
            ['slug' => 'spinach'],
            ['slug' => 'artichoke'],
            ['slug' => 'bacon'],
            ['slug' => 'sausage'],
            ['slug' => 'beef'],
            ['slug' => 'ham'],
            ['slug' => 'salami'],
            ['slug' => 'jalapeno'],
            ['slug' => 'chorizo'],
            ['slug' => 'chicken'],
            ['slug' => 'canadian-bacon'],
            ['slug' => 'onion'],
            ['slug' => 'olives'],
            ['slug' => 'tomato'],
            ['slug' => 'peppers'],
            ['slug' => 'honey'],
            ['slug' => 'sriracha'],
            ['slug' => 'eggs'],
            ['slug' => 'corn-chips'],
            ['slug' => 'basil'],
            ['slug' => 'meatball'],
            ['slug' => 'steak'],
            ['slug' => 'smoked'],
            ['slug' => 'thick-crust'],
            ['slug' => 'thin-crust'],
            ['slug' => 'deep-dish'],
            ['slug' => 'stuffed-crust'],

            //sauces
            ['slug' => 'pesto'],
            ['slug' => 'bbq'],
            ['slug' => 'alfredo'],
            ['slug' => 'buffalo'],
            ['slug' => 'ranch'],
            ['slug' => 'taco-sauce'],
            ['slug' => 'hot-sauce'],

            //crusts
            ['slug' => 'gluten-free'],
            ['slug' => 'low-carb'],
            ['slug' => 'keto'],
            ['slug' => 'handmade'],
            ['slug' => 'wood-fired'],
            ['slug' => 'thin'],
            ['slug' => 'crispy'],
            ['slug' => 'rising-crust'],
            ['slug' => 'cauliflower-crust'],
            ['slug' => 'tavern-style'],
            ['slug' => 'hand-tossed'],

            //cheeses
            ['slug' => 'parmesan'],
            ['slug' => 'provolone'],
            ['slug' => 'ricotta'],
            ['slug' => 'feta'],
            ['slug' => 'gorgonzola'],
            ['slug' => 'asiago'],
            ['slug' => 'fontina'],
            ['slug' => 'romano'],
            ['slug' => 'cheddar'],
            ['slug' => 'fontina'],

            //styles and types
            ['slug' => 'spicy'],
            ['slug' => 'classic'],
            ['slug' => 'vegan'],
            ['slug' => 'vegetarian'],
            ['slug' => 'meat-lovers'],
            ['slug' => 'cheese-lovers'],
            ['slug' => 'deluxe'],
            ['slug' => 'supreme'],
            ['slug' => 'pub-style'],
            ['slug' => 'homestyle'],
            ['slug' => 'mexican'],
            ['slug' => 'greek'],
            ['slug' => 'japanese'],
            ['slug' => 'korean'],
            ['slug' => 'chinese'],
            ['slug' => 'cheeseburger'],
            ['slug' => 'taco'],
            ['slug' => 'hawaiian'],
            ['slug' => 'breakfast'],
            ['slug' => 'cheesesteak'],
            ['slug' => 'st-louis-style'],
        ];

        foreach ($tags as $tagData) {
            Tag::updateOrCreate($tagData);
        }
    }
}

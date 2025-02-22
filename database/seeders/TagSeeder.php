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
            ['slug' => 'spicy'],
            ['slug' => 'classic'],
            ['slug' => 'gluten-free'],
            ['slug' => 'low-carb'],
            ['slug' => 'keto'],
            ['slug' => 'vegan'],
            ['slug' => 'vegetarian'],
            ['slug' => 'pesto'],
            ['slug' => 'bbq'],
            ['slug' => 'meat-lovers'],
            ['slug' => 'cheese-lovers'],
            ['slug' => 'pepperoni'],
            ['slug' => 'mushroom'],
            ['slug' => 'garlic'],
            ['slug' => 'pineapple'],
            ['slug' => 'spinach'],
            ['slug' => 'artichoke'],
            ['slug' => 'parmesan'],
            ['slug' => 'provolone'],
            ['slug' => 'ricotta'],
            ['slug' => 'feta'],
            ['slug' => 'bacon'],
            ['slug' => 'sausage'],
            ['slug' => 'beef'],
            ['slug' => 'ham'],
            ['slug' => 'salami'],
            ['slug' => 'handmade'],
            ['slug' => 'wood-fired'],
            ['slug' => 'thin'],
            ['slug' => 'crispy'],
            ['slug' => 'rising-crust'],
            ['slug' => 'deluxe'],
            ['slug' => 'supreme'],
            ['slug' => 'pub-style'],
            ['slug' => 'homestyle'],
            ['slug' => 'mexican'],
            ['slug' => 'greek'],
            ['slug' => 'japanese'],
            ['slug' => 'korean'],
            ['slug' => 'chinese'],
            ['slug' => 'jalapeno'],
            ['slug' => 'chorizo'],
            ['slug' => 'cauliflower-crust'],
            ['slug' => 'cheeseburger'],
            ['slug' => 'bacon'],
            ['slug' => 'alfredo'],
            ['slug' => 'chicken'],
            ['slug' => 'pesto'],
            ['slug' => 'canadian-bacon'],
        ];

        foreach ($tags as $tagData) {
            Tag::updateOrCreate($tagData);
        }
    }
}

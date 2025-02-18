<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Handlers\PizzaSeedHandler;

class AmericanFlatbreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brand = Brand::where('slug', 'american-flatbread')->first();

        $pizzas = [
            // American Flatbread
            [
                'name' => 'Cheese & Herb',
                'slug' => 'cheese-herb',
                'description' => "With mozzarella, garlic oil & fresh herbs. Handmade, wood-fired, thin & crispy pizza. Hand crafted to perfection! No artificial preservatives. You don't just eat an American Flatbread Pizza - you experience it. That is why we're serious about what goes in and on our pizza. To start, there's sourcing. We get our cheese straight from farms we trust and love. Then, there's quality. Our ingredients have to be fresh, handled properly-only the best. Quantity is Important, too. So is balance: getting all the flavors in our recipes to play well together, creating that special combination of textures that you love when you bite into a pizza. We're inspired by ingredients and the way they come together in a perfect bite for you. Unconditionally guaranteed if for any reason you are not satisfied with our product please call us toll free at 888-519-5119 or email us at: info(at)americanflatbreadproducts.com. AmericanFlatbreadProducts.com. Printed on recycled board with soy-based inks. Made in the USA.",
                'ingredients' => "Crust: 100% Organically Grown Wheat, Good Mountain Water, Organic Wheat Bran, Kosher Slat, Fresh Yeast. Toppings: Mozzarella Cheese (Whole Milk, Vegetable Rennet, Salt), Vermont's Blythedale Farm Padano Cheese (Whole Milk from Jersey Cows, Vegetable Rennet, Salt), Parmesan Cheese (Cultured Milk, Vegetable Rennet, Salt), Garlic Oil (Extra Virgin Olive Oil, Canola Oil, Fresh Garlic), Fresh Parsley, Herbs, Kosher Salt.",
                'allergens' => "Milk, Wheat",
                'tags' => ['handmade', 'wood-fired', 'thin', 'crispy'],
                'nutritional_facts' => [
                    'serving_per_container' => '3 servings per container',
                    'serving_size' => '0.333 pizza (130 g)',
                    'calories' => 370,
                    'total_fat' => '15g',
                    'saturated_fat' => '8g',
                    'trans_fat' => '0g',
                    'cholesterol' => '45mg',
                    'sodium' => '850mg',
                    'total_carbohydrate' => '41g',
                    'dietary_fiber' => '2g',
                    'total_sugars' => '1g',
                    'added_sugars' => '0g',
                    'protein' => '19g',
                    'vitamin_d' => '1.5mcg',
                    'potassium' => '180mg',
                    'iron' => '2.2mg',
                    'calcium' => '390mg',
                ],
                'image_url' => "https://img.cdn4dd.com/cdn-cgi/image/fit=contain,width=1200,height=672,format=auto/https://doordash-static.s3.amazonaws.com/media/photosV2/72992d93-c1c3-4fc5-8714-650b84312a36-retina-large.jpg",
            ],
            [
                'name' => 'Vegan Harvest',
                'slug' => 'vegan-harvest',
                'description' => "American Flatbread Vegan Harvest Thin & Crispy Pizza is a handcrafted, wood-fired pizza featuring homemade tomato sauce, dairy-free mozzarella-style shreds, and a blend of fresh herbs. This pizza offers a rich and satisfying taste with an emphasis on quality ingredients that are non-GMO Project verified. It is produced without artificial preservatives, ensuring a pure and wholesome flavor profile. Each pizza is carefully assembled to deliver an optimal combination of flavors and textures. Made in the USA, this product is presented on recycled board packaging printed with soy-based inks.",
                'ingredients' => "Crust: 100% Organically Grown Wheat, Good Mountain Water, Organic Wheat Bran, Sea Salt, Fresh Yeast, Toppings: Tomato Sauce (organic Tomatoes, Fresh Organic Onions, Fresh Organic Carrots, Fresh Organic Celery, Organic Garlic, Organic Red Wine, Organic Maple Syrup, Organic Extra Virgin Olive Oil, Kosher Salt, Fresh Organic Herbs, Organic Black Pepper, Organic Red Pepper Flakes), Vegan Mozzarella Style Shreds (filtered Water, Tapioca Starch, Coconut Oil, Non-gmo, Expeller Pressed: Canola And/or Safflower Oil, Vegan Natural Flavors, Sea Salt, Potato Protein Isolate, Tricalcium Phosphate, Lactic Acid (vegan), Whole Algal Flour, Konjac Gum, Xanthan Gum, Yeast Extract), Fresh Parsley, Herbs, Kosher Salt.",
                'allergens' => 'Wheat',
                'tags' => ['vegan', 'vegetarian', 'handmade', 'wood-fired', 'thin', 'crispy'],
                'nutritional_facts' => [
                    'serving_per_container' => '2 servings per container',
                    'serving_size' => '145 g',
                    'calories' => 260,
                    'total_fat' => '9g',
                    'saturated_fat' => '1g',
                    'trans_fat' => '0g',
                    'cholesterol' => '0mg',
                    'sodium' => '650mg',
                    'total_carbohydrate' => '38g',
                    'dietary_fiber' => '3g',
                    'total_sugars' => '2g',
                    'added_sugars' => '1g',
                    'protein' => '6g',
                ],
                'image_url' => "https://tb-static.uber.com/prod/image-proc/processed_images/abc558e408392a561c4a27a52525dba7/957777de4e8d7439bef56daddbfae227.jpeg"
            ],
            [
                'name' => 'Revolution',
                'slug' => 'revolution',
                'description' => "Handmade, wood-fired, thin & crispy pizza with mushrooms, caramelized onions, & homemade tomato sauce. Handcrafted to perfection! No artificial preservatives. You don't just eat an American Flatbread pizza - you experience it. That is why we're serious about what goes in and on our pizza. To start, there's sourcing. We get our cheese straight from farms we trust and love. Then there's quality. Our ingredients have to be fresh, handled properly - only the best. Quantity is important, too. So is balance: getting all the flavors in our recipes to play well together, creating that special combination of textures that you love when you bite into a pizza. We inspired by ingredients and the way they come together in a perfect bite for you. Inspired ingredients in every bite. Unconditionally Guaranteed: If for any reason you are not satisfied with our product please call us toll free at 888-519-5119 or email us at: info(at)AmericanFlatbreadProducts.com. Printed on recycled board with soy-based inks. Made in the USA.",
                'ingredients' => "Crust: 100% Organically Grown Wheat, Good Mountain Water, Organic Wheat Bran, Kosher Salt, Fresh Yeast. Toppings: Mozzarella Cheese (Whole Milk, Vegetable Rennet, Salt), Fresh Mushrooms, Tomato Sauce (Organic Tomatoes, Fresh Organic Onions, Fresh Organic Carrots, Fresh Organic Celery, Organic Garlic, Organic Red Wine, Organic Maple Syrup, Organic Extra Virgin Olive Oil, Kosher Salt, Fresh Organic Herbs, Organic Black Pepper, Organic Red Pepper Flakes), Asiago Cheese (Whole Milk, Vegetable Rennet, Salt), Parmesan Cheese (Cultured Milk, Vegetable Rennet, Salt), Fresh Onions, Garlic Oil (Extra Virgin Olive Oil, Canola Oil, Fresh Garlic), Fresh Parsley, Herbs, Kosher Salt.",
                'allergens' => "Milk, Wheat",
                'tags' => ['handmade', 'wood-fired', 'thin', 'crispy'],
                'nutritional_facts' => [
                    'serving_per_container' => '3 servings per container',
                    'serving_size' => '0.13 pizza',
                    'calories' => 300,
                    'total_fat' => '12g',
                    'saturated_fat' => '6g',
                    'trans_fat' => '0g',
                    'cholesterol' => '30mg',
                    'sodium' => '820mg',
                    'potassium' => '180mg',
                    'total_carbohydrate' => '45g',
                    'dietary_fiber' => '4g',
                    'total_sugars' => '4g',
                    'added_sugars' => '1g',
                    'protein' => '7g',
                    'calcium' => '320mg',
                    'iron' => '0.3mg',
                    'vitamin_d' => '0mcg',
                ],
                'image_url' => "https://contenthandler-raleys.fieldera.com/prod/305495/1/0/0/80049262-Main.jpg",
            ]
        ];

        foreach ($pizzas as $pizza) {
            PizzaSeedHandler::seedPizza($brand, $pizza);
        }
    }
}

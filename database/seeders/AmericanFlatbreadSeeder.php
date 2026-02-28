<?php

namespace Database\Seeders;

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

        // Update brand with SEO data
        $brand->update([
            'seo_title' => 'American Flatbread Frozen Pizzas | Authentic Wood-Fired Pizza Reviews',
            'seo_description' => 'Discover American Flatbread\'s authentic wood-fired frozen pizzas. Read honest reviews, nutritional information, and find your favorite varieties of these artisanal, handmade frozen pizzas.',
            'seo_keywords' => [
                'American Flatbread pizzas',
                'wood-fired frozen pizza',
                'organic frozen pizza',
                'artisanal frozen pizza',
                'handmade frozen pizza',
                'authentic frozen pizza',
                'best frozen pizza',
                'American Flatbread reviews',
                'American Flatbread nutrition',
                'American Flatbread ingredients'
            ],
            'seo_about_content' => "American Flatbread is renowned for their authentic wood-fired frozen pizzas, crafted with organic ingredients and traditional methods. Each pizza is handmade and baked in wood-fired ovens, capturing the essence of artisanal pizza-making. Their commitment to quality ingredients and traditional baking methods sets them apart in the frozen pizza market.",
            'unique_selling_points' => "• Authentic wood-fired frozen pizzas\n• Handmade with organic and natural ingredients\n• No artificial preservatives or additives\n• Traditional baking methods\n• Thin, crispy crust\n• Premium, locally-sourced ingredients when possible\n• Commitment to quality and authenticity",
            'brand_story' => "American Flatbread began with a simple mission: to create authentic, wood-fired pizzas that maintain their artisanal quality even when frozen. Founded on the principles of traditional pizza-making and a commitment to organic, high-quality ingredients, American Flatbread has revolutionized the frozen pizza category by proving that convenience doesn't have to compromise quality.\n\nEach pizza is handmade, featuring a thin, crispy crust made from 100% organically grown wheat, and topped with carefully selected ingredients. The pizzas are baked in wood-fired ovens, giving them their distinctive flavor and texture that sets them apart from conventional frozen pizzas.",
            'founded_year' => '1990',
        ]);

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
                    'serving_per_container' => 3,
                    'serving_fraction' => '1/3',
                    'serving_weight' => 130,
                    'calories' => 370,
                    'caloris_from_fat' => 0,
                    'total_fat' => 15,
                    'saturated_fat' => 8,
                    'trans_fat' => 0,
                    'cholesterol' => 45,
                    'sodium' => 850,
                    'total_carbohydrate' => 41,
                    'dietary_fiber' => 2,
                    'total_sugars' => 1,
                    'added_sugars' => 0,
                    'protein' => 19,
                    'vitamin_d' => 1.5,
                    'potassium' => 180,
                    'iron' => 2.2,
                    'calcium' => 390,
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
                    'serving_per_container' => 2,
                    'serving_fraction' => '1/3',
                    'serving_weight' => 145,
                    'calories' => 260,
                    'caloris_from_fat' => 0,
                    'total_fat' => 9,
                    'saturated_fat' => 1,
                    'trans_fat' => 0,
                    'cholesterol' => 0,
                    'sodium' => 650,
                    'total_carbohydrate' => 38,
                    'dietary_fiber' => 3,
                    'total_sugars' => 2,
                    'added_sugars' => 1,
                    'protein' => 6,
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
                    'serving_per_container' => 3,
                    'serving_fraction' => '1/3',
                    'serving_weight' => 0,
                    'calories' => 300,
                    'caloris_from_fat' => 0,
                    'total_fat' => 12,
                    'saturated_fat' => 6,
                    'trans_fat' => 0,
                    'cholesterol' => 30,
                    'sodium' => 820,
                    'potassium' => 180,
                    'total_carbohydrate' => 45,
                    'dietary_fiber' => 4,
                    'total_sugars' => 4,
                    'added_sugars' => 1,
                    'protein' => 7,
                    'calcium' => 320,
                    'iron' => 0.3,
                    'vitamin_d' => 0,
                ],
                'image_url' => "https://contenthandler-raleys.fieldera.com/prod/305495/1/0/0/80049262-Main.jpg",
            ]
        ];

        foreach ($pizzas as $pizza) {
            PizzaSeedHandler::seedPizza($brand, $pizza);
        }
    }
}

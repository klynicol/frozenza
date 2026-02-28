<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Handlers\ImageHandler;
use App\Handlers\PizzaSeedHandler;

class PizzaCornerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brand = Brand::updateOrCreate([
            'slug' => 'pizza-corner',
        ], [
            'name' => 'Pizza Corner',
            'website' => 'https://www.shopbernatellospizza.com/',
            'brand_story' => "Pizza Corner pizza is more than just a frozen meal—it’s a slice of North Dakota history and pride. Born in Valley City and created by founder Dave Zubrod, the brand quickly became a local institution known for its signature crispy crust, robust tomato sauce, and savory toppings that evoke the comfort of home-cooked meals. Over the years, Pizza Corner grew from a small, family-run restaurant into a beloved regional brand that resonated with locals for its authentic taste and community spirit. In 2016, in a move to expand its reach while preserving its unique flavor, the frozen pizza division of Pizza Corner was acquired by Bernatello’s Foods, a family-owned company with deep roots in the Midwest. Despite this change in production and distribution, the original Pizza Corner restaurant in Valley City remains under Dave Zubrod’s care, symbolizing a steadfast commitment to quality and tradition. Today, whether enjoyed fresh at the restaurant or from the freezer at home, Pizza Corner pizza continues to serve as a delicious reminder of North Dakota’s enduring culinary legacy.",
            'founded_year' => '1977', // Approximately based on "28 years in" from website content
            'description' => "Pizza Corner is a beloved North Dakota brand, born in Valley City by founder Dave Zubrod. Known for its crispy crust, robust sauce, and savory toppings, it delivers authentic, home-style flavor—whether enjoyed fresh at the original restaurant or from the freezer via Bernatello’s Foods.",
        ]);

        if (!$brand->image) {
            $image = ImageHandler::createFromUrl(
                'https://cdn11.bigcommerce.com/s-5tf6tdwuxj/product_images/uploaded_images/pc-logo.png',
                'public',
                'images/logos/frozen',
                'PizzaCorner'
            );
            $brand->image_id = $image->id;
            $brand->save();
        }
        $pizzas = [
            [
                'name' => "Pepperoni",
                'slug' => "pepproni",
                'tags' => ['pepperoni', 'classic'],
                'description' => "From the Corner of 2nd and Main in Valley City, North Dakota. That’s where, in 1977, the magic of Pizza Corner Pepperoni pizza was created. This special family recipe included an Italian-Style crust, a rich and tangy tomato sauce, authentic Italian seasonings and generous amounts of high-quality pepperoni and 100% real Mozzarella cheese! We know you may never get to the corner of 2nd and Main. So, we happily bring you the flavors of the Pizza Corner Pizzeria, fresh from your own oven. Enjoy!",
                'image_url' => "https://cdn11.bigcommerce.com/s-5tf6tdwuxj/images/stencil/1280x1280/products/214/802/6782_PC_Pepperoni_Lg_Label__22781.1680032015.jpg?c=2",
                'ingredients' => "Crust (flour (wheat, malted barley), water, soybean oil, yeast, salt, dextrose, leavening (sodium aluminum phosphate, sodium bicarbonate), calcium propionate (preservative) and soy lecithin), low moisture park skim mozzarella cheese (cultured pasteurized part skim milk, salt, enzymes, tomato paste, tabasco sauce (vinegar, red pepper and salt), romano cheese (pasteurized part skim cows milk, cheese cultures, salt, enzymes), spices), pepperoni (pork, beef, salt, dextrose, sodium nitrite, bha, bht, citric acid, may contain water, spices, flavoring, smoke flavoring, paprika, oleoresin of paprika, lactic acid starter culture, sodium ascorbate, garlic powder, dehydrated garlic).",
                'allergens' => "Wheat, Milk, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 5,
                    'serving_fraction' => '1/5',
                    'serving_weight' => 149,
                    'calories' => 380,
                    'caloris_from_fat' => 0,
                    'total_fat' => 16,
                    'saturated_fat' => 7,
                    'trans_fat' => 0,
                    'cholesterol' => 35,
                    'sodium' => 710,
                    'total_carbohydrate' => 41,
                    'dietary_fiber' => 2,
                    'total_sugars' => 3,
                    'added_sugars' => 0,
                    'protein' => 17,
                    'vitamin_d' => 0.1,
                    'calcium' => 340,
                    'iron' => 1.4,
                    'potassium' => 290,
                ]
            ],
            [
                'name' => "Supreme",
                'slug' => "supreme",
                'tags' => ['supreme', 'pepperoni', 'bacon', 'beef', 'canadian-bacon', ],
                'description' => "From the Corner of 2nd and Main in Valley City, North Dakota. That’s where, in 1977, the magic of Pizza Corner Supreme pizza was created. This special family recipe included an Italian-Style crust, a rich and tangy tomato sauce, authentic Italian seasonings and generous amounts of ground beef, Canadian style bacon, pepperoni and 100% real Mozzarella cheese! We know you may never get to the corner of 2nd and Main. So, we happily bring you the flavors of the Pizza Corner Pizzeria, fresh from your own oven. Enjoy!",
                'image_url' => "https://cdn11.bigcommerce.com/s-5tf6tdwuxj/images/stencil/1280x1280/products/217/805/6788_PC_DeliciouslySupreme_Lg_Label__11315.1680032461.jpg?c=2",
                'ingredients' => "Crust (flour (wheat, malted barley), water, soybean oil, yeast, salt, dextrose, leavening (sodium aluminum phosphate, sodium bicarbonate), calcium propionate (preservative) and soy lecithin), low moisture part skim mozzarella cheese (cultured pasteurized) part skim milk, salt, enzymes), sauce (tomato paste, tabasco sauce (vinegar, red pepper and salt), romano cheese (pasteurized part skim cows milk, cheese cultures, salt, enzymes), spices), canadian style bacon (pork, water, salt, brown sugar, potassium lactate, sodium lactate, sodium phosphate, sodium, diacetate, sodium erythorbate, and sodium nitrite), cooked seasoned ground beef (beef, salt, natural flavorings), pepperoni (pork, beef, salt, dextrose, sodium nitrite, bha, bht, citric acid, may contain water, spices, flavoring, smoke flavoring, paprika, oleoresin of paprika, lactic acid starter culture, sodium ascorbate, garlic powder, dehydrated garlic),",
                'allergens' => "Wheat, Milk, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 6,
                    'serving_fraction' => '1/6',
                    'serving_weight' => 134,
                    'calories' => 320,
                    'caloris_from_fat' => 0,
                    'total_fat' => 13,
                    'saturated_fat' => 5,
                    'trans_fat' => 0,
                    'cholesterol' => 35,
                    'sodium' => 660,
                    'total_carbohydrate' => 34,
                    'dietary_fiber' => 2,
                    'total_sugars' => 3,
                    'added_sugars' => 0,
                    'protein' => 17,
                    'vitamin_d' => 0.1,
                    'calcium' => 260,
                    'iron' => 1.3,
                    'potassium' => 320,
                ]
            ],
            [
                'name' => "Taco",
                'slug' => "taco",
                'tags' => ['taco', 'taco-sauce', 'beef', 'cheddar'],
                'description' => "From the Corner of 2nd and Main in Valley City, North Dakota. That’s where, in 1977, the magic of Pizza Corner Taco pizza was created. This special family recipe included an Italian-Style crust, a tangy tomato sauce, authentic Italian seasonings and generous amounts of taco beef, tortilla chips, and 100% real Colby Jack, Cheddar and Mozzarella cheese! We know you may never get to the corner of 2nd and Main. So, we happily bring you the flavors of the Pizza Corner Pizzeria, fresh from your own oven. Enjoy!",
                'image_url' => "https://cdn11.bigcommerce.com/s-5tf6tdwuxj/images/stencil/1280x1280/products/215/803/6789_PC_Taco_Lg_Label__73865.1680032128.jpg?c=2",
                'ingredients' => "Crust (flour (wheat, malted barley), water, soybean oil, yeast, salt, dextrose, leavening (sodium aluminum phosphate,sodium bicarbonate), calcium propionate (preservative) and soy lecithin), colby jack cheese (pasteurized milk, cheese cultures, salt, enzymes, and annatto (color), sauce (tomato paste, tabasco sauce (vinegar, red pepper and salt), pinto bean powder, salt, yeast, extract, spices, dehydrated onion, dehydrated garlic, vegetable or corn oil, spices), cooked taco beef filling (beef, water, salt, spices, paprika, onion, garlic powder, flavoring), cheddar (pasteurized milk, salt, cheese cultures, enzymes, annatto), yellow round tortilla chips (whole grain corn flour, vegetable oil (sunflower oil and/or corn oil, and/or canola oil), salt).",
                'allergens' => "Wheat, Milk, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 6,
                    'serving_fraction' => '1/6',
                    'serving_weight' => 141,
                    'calories' => 390,
                    'caloris_from_fat' => 0,
                    'total_fat' => 19,
                    'saturated_fat' => 9,
                    'trans_fat' => 0,
                    'cholesterol' => 45,
                    'sodium' => 560,
                    'total_carbohydrate' => 37,
                    'dietary_fiber' => 2,
                    'total_sugars' => 2,
                    'added_sugars' => 0,
                    'protein' => 16,
                    'vitamin_d' => 0.2,
                    'calcium' => 330,
                    'iron' => 1.2,
                    'potassium' => 300,
                ]
            ],
            [
                'name' => "Sausage & Pepperoni",
                'slug' => "sausage-and-pepperoni",
                'tags' => ['sausage', 'pepperoni', 'classic'],
                'description' => "From the Corner of 2nd and Main in Valley City, North Dakota. That’s where, in 1977, the magic of Pizza Corner Pepperoni pizza was created. This special family recipe included an Italian-Style crust, a rich and tangy tomato sauce, authentic Italian seasonings and generous amounts of high-quality pepperoni and 100% real Mozzarella cheese! We know you may never get to the corner of 2nd and Main. So, we happily bring you the flavors of the Pizza Corner Pizzeria, fresh from your own oven. Enjoy!",
                'image_url' => "https://cdn11.bigcommerce.com/s-5tf6tdwuxj/images/stencil/1280x1280/products/216/804/6784_PC_SausPep_Lg_Label__26259.1680032338.jpg?c=2",
                'ingredients' => "Crust (flour (wheat, Malted Barley), Water, Soybean Oil, Yeast, Salt, Dextrose, Leavening (sodium Aluminum Phosphate, Sodium Bicarbonate), Calcium Propionate (preservative) And Soy Lecithin), Low Moisture Part Skim Mozzarella Cheese (cultured Pasteurized Part Skim Milk, Salt, Enzymes), Sauce (tomato Paste, Tabasco Sauce Vinegar, Red Pepper And Salt, Romano Cheese (pasteurized Part Skim Cows Milk, Cheese Cultures, Salt, Enzymes), Spices), Mild Sausage With Parmesan Cheese (pork, Water, Salt, Spices (fennel, Anise, Black Pepper, And Red Pepper), Parmesan Cheese (pasteurized Part Skim Milk, Cheese Cultures, Salt, Enzymes), Paprika, Sodium Phosphates, Garlic Powder), Pepperoni (pork, Beef, Salt, Dextrose, Sodium Nitrite, Bha, Bht, Citric Acid, May Contain Water, Spices, Flavoring, Smoke Flavoring, Paprika, Oleoresin Of Paprika, Lactic Acid Starter Culture, Sodium Ascorbate, Garlic Powder, Dehydrated Garlic).",
                'allergens' => "Wheat, Milk, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 5,
                    'serving_fraction' => '1/5',
                    'serving_weight' => 152,
                    'calories' => 380,
                    'caloris_from_fat' => 0,
                    'total_fat' => 16,
                    'saturated_fat' => 6,
                    'trans_fat' => 0,
                    'cholesterol' => 35,
                    'sodium' => 710,
                    'total_carbohydrate' => 41,
                    'dietary_fiber' => 2,
                    'total_sugars' => 3,
                    'added_sugars' => 0,
                    'protein' => 17,
                    'vitamin_d' => 0.2,
                    'calcium' => 310,
                    'iron' => 1.3,
                    'potassium' => 330,
                ]
            ],
        ];

        foreach($pizzas as $pizza) {
            PizzaSeedHandler::seedPizza($brand, $pizza);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Handlers\ImageHandler;
use App\Handlers\PizzaSeedHandler;
use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brand = Brand::updateOrCreate([
            'slug' => 'porta',
        ], [
            'name' => 'Porta',
            'website' => 'https://eatporta.com',
            'brand_story' => 'For over 30 years, Cosi and his family have been at the heart of authentic Italian dining—sharing cherished traditions through twelve restaurants, bakeries, and shops across North America. Driven by a passion to bring the warmth and quality of their restaurant experience directly into homes, they launched PORTA. (Meaning “door” or “carry” in Italian, PORTA transforms what was once an exclusive treat into delicious Italian food available for everyone.) With every hand-tossed, Roman-style pinsa pizza—flash-frozen to preserve its rich flavors—PORTA invites you to experience the family’s time-honored techniques and the taste of Italy in 10 minutes or less.',
            'founded_year' => '1995',
            'description' => 'PORTA is a family-run brand dedicated to delivering genuine Italian pizza straight to your home. Building on a 30-year legacy of culinary excellence, PORTA uses only the highest quality ingredients and traditional techniques to create its signature Roman-style pinsa pizzas. Each pizza is expertly hand-tossed by seasoned chefs and flash-frozen to lock in flavor, ensuring a restaurant-quality meal that’s ready in just 10 minutes. With PORTA, traditional Italian dining becomes accessible—bringing a taste of Italy right to your doorstep.',
        ]);

        if (!$brand->image) {
            $image = ImageHandler::createFromUrl(
                'https://media.licdn.com/dms/image/v2/D560BAQGfoibc4mCNew/company-logo_200_200/company-logo_200_200/0/1689341186108/eatporta_logo?e=1748476800&v=beta&t=E-jQFv5aTeWpekR7b_lDUONhr2mQDNEw4z_EietON4I', // url
                'public',
                'images/logos/frozen',
                'Porta' // name - no extension
            );
            $brand->image_id = $image->id ?? null;
            $brand->save();
        }

        $pizzas = [
            [
                'name' => "Uncured Pepperoni",
                'slug' => "uncured-pepperoni",
                'tags' => ['pepperoni'],
                'description' => "Porta Uncured Pepperona Pizza",
                'image_url' => "https://eatporta.com/cdn/shop/files/uncured-pepperoni-us_630x.png?v=1720017814",
                'ingredients' => "Enriched wheat flour (wheat flour, wheat starch, reduced iron, niacin, thiamine mononitrate, riboflavin, tricalcium phosphate, folic acid), Water, Part-skim mozzarella cheese (part-skim pasteurized milk, enzymes, cheese culture, salt), Tomatoes (peeled tomatoes, tomato juice, citric acid), Sliced pepperoni (pork, beef, salt, seasoning (sugar, extractive of paprika, natural flavors, garlic powder, natural hickory smoke flavor, cultured celery powder, sea salt), water, lactic acid starter culture), Durum wheat semolina, Olive oil, Salt, Rice flour, Sunflower lecithin, Barley malt extract, Nonfat dry milk, Ground fennel seeds, Basil, Yeast.",
                'allergens' => "Milk, Wheat",
                'nutritional_facts' => [
                    'serving_per_container' => '3',
                    'serving_size' => '1/3 pizza',
                    'calories' => '360',
                    'total_fat' => '15g',
                    'saturated_fat' => '7g',
                    'trans_fat' => '0g',
                    'cholesterol' => '40mg',
                    'sodium' => '710mg',
                    'total_carbohydrate' => '39g',
                    'dietary_fiber' => '3g',
                    'total_sugars' => '5g',
                    'added_sugars' => '1g',
                    'protein' => '15g',
                    'vitamin_d' => '0μg',
                    'calcium' => '120mg',
                    'iron' => '3.1mg',
                    'potassium' => '400mg',
                ]
            ],
            [
                'name' => "Margherita",
                'slug' => "margherita",
                'tags' => ['basil', 'vegetarian'],
                'description' => "Italian pomodoro sauce, mozzarella, fior di latte and basil.",
                'image_url' => "https://eatporta.com/cdn/shop/files/margherita-us_840x.png?v=1720017763",
                'ingredients' => "Enriched wheat flour (wheat flour, wheat starch, reduced iron, niacin, thiamine mononitrate, riboflavin, tricalcium phosphate, folic acid), Part-skim mozzarella cheese (part-skim pasteurized milk, microbial enzyme, bacterial cultures, salt), Water, Tomatoes (peeled tomatoes, tomato juice, citric acid), Fior di latte cheese (pasteurized milk, calcium chloride, microbial enzyme, bacterial culture), Durum wheat semolina, Olive oil, Salt, Basil, Rice flour, Sunflower lecithin, Barley malt extract, Nonfat dry milk, Yeast.",
                'allergens' => "Milk, Wheat",
                'nutritional_facts' => [
                    'serving_per_container' => '3',
                    'serving_size' => '1/3 pizza',
                    'calories' => '330',
                    'total_fat' => '13g',
                    'saturated_fat' => '7g',
                    'trans_fat' => '0g',
                    'cholesterol' => '35mg',
                    'sodium' => '500mg',
                    'total_carbohydrate' => '39g',
                    'dietary_fiber' => '2g',
                    'total_sugars' => '5g',
                    'added_sugars' => '0g',
                    'protein' => '14g',
                    'vitamin_d' => '0mcg',
                    'calcium' => '170mg',
                    'iron' => '2.7mg',
                    'potassium' => '350mg',
                ]
            ],
            [
                'name' => "Mushroom & Fontina",
                'slug' => "mushroom-fontina",
                'tags' => ['mushroom', 'fontina'],
                'description' => "Mozzarella, fontina, button mushrooms, truffle-infused oil and a touch of parsley.",
                'image_url' => "https://eatporta.com/cdn/shop/files/mushroom-fontina-us_840x.png?v=1720017792",
                'ingredients' => "Enriched wheat flour (wheat flour, wheat starch, reduced iron, niacin, thiamine mononitrate, riboflavin, tricalcium phosphate, folic acid), Part-skim mozzarella cheese (part-skim pasteurized milk, microbial enzyme, bacterial cultures, salt), Water, Tomatoes (peeled tomatoes, tomato juice, citric acid), Fior di latte cheese (pasteurized milk, calcium chloride, microbial enzyme, bacterial culture), Durum wheat semolina, Olive oil, Salt, Basil, Rice flour, Sunflower lecithin, Barley malt extract, Nonfat dry milk, Yeast.",
                'allergens' => "Milk, Wheat",
                'nutritional_facts' => [
                    'serving_per_container' => '3',
                    'serving_size' => '1/3 pizza',
                    'calories' => '340',
                    'total_fat' => '14g',
                    'saturated_fat' => '7g',
                    'trans_fat' => '0g',
                    'cholesterol' => '35mg',
                    'sodium' => '400mg',
                    'total_carbohydrate' => '37g',
                    'dietary_fiber' => '2g',
                    'total_sugars' => '4g',
                    'added_sugars' => '0g',
                    'protein' => '14g',
                    'vitamin_d' => '0.1mcg',
                    'calcium' => '160mg',
                    'iron' => '2.5mg',
                    'potassium' => '350mg',
                ]
            ],
            [
                'name' => "Sausage & Caramelized Onion",
                'slug' => "sausage-caramelized-onion",
                'tags' => ['sausage', 'onion'],
                'description' => "Italian pomodoro sauce, mozzarella, smoked scamorza, sausage, caramelized onions and a touch of parsley.",
                'image_url' => "https://eatporta.com/cdn/shop/files/sausage-caramelized-onion-us_840x.png?v=1720017855",
                'ingredients' => "Enriched wheat flour (wheat flour, wheat starch, reduced iron, niacin, thiamine mononitrate, riboflavin, tricalcium phosphate, folic acid), Water, Tomatoes (peeled tomatoes, tomato juice, citric acid), Part-skim mozzarella cheese (part-skim pasteurized milk, enzymes, cheese cultures, salt), Cooked pork sausage (pork, salt, black pepper, crushed red chili, paprika, wine [sulphites]), Low moisture part-skim mozzarella cheese with smoke added (pasteurized part-skim milk, salt, calcium chloride, microbial enzyme, bacterial culture, wood smoke), Caramelized onion (onion, olive oil, salt), Durum wheat semolina, Parsley, Olive oil, Salt, Rice flour, Sunflower lecithin, Barley malt extract, Nonfat dry milk, Basil, Yeast.",
                'allergens' => "",
                'nutritional_facts' => [
                    'serving_per_container' => '4',
                    'serving_size' => '1/4 pizza',
                    'calories' => '280',
                    'total_fat' => '11g',
                    'saturated_fat' => '4.5g',
                    'trans_fat' => '0g',
                    'cholesterol' => '30mg',
                    'sodium' => '540mg',
                    'total_carbohydrate' => '31g',
                    'dietary_fiber' => '2g',
                    'total_sugars' => '3g',
                    'added_sugars' => '0g',
                    'protein' => '15g',
                    'vitamin_d' => '0.1mcg',
                    'calcium' => '140mg',
                    'iron' => '2.4mg',
                    'potassium' => '310mg',
                ]
            ],
        ];

        foreach ($pizzas as $pizza) {
            PizzaSeedHandler::seedPizza($brand, $pizza);
        }
    }
}

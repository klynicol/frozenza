<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Handlers\ImageHandler;
use App\Handlers\PizzaSeedHandler;

class BrewPubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brand = Brand::updateOrCreate([
            'slug' => 'brewpub',
        ], [
            'name' => 'BrewPub',
            'website' => 'https://www.shopbernatellospizza.com/brew-pub/',
            'brand_story' => 'Brew Pub is Bernatello’s Foods’ premium frozen pizza brand—a bold, upscale entry designed to bring the hearty, indulgent flavors of a traditional brewpub right to your freezer. Launched as part of Bernatello’s strategy to modernize and expand its portfolio, Brew Pub pizzas are crafted with twice the cheese and generous helpings of classic pizza meats, including even a bacon cheeseburger variation. The brand aims to deliver a restaurant-quality, meat-forward experience that pairs perfectly with a cold brew, capturing the nostalgic essence of a neighborhood brewpub while embracing innovative frozen pizza production techniques.',
            'brand_story' => "Brew Pub was born from Bernatello’s Foods’ rich history of frozen pizza innovation. As Bernatello’s evolved from its early days in the 1980s—when it first gained a reputation for quality frozen pizzas—the company began to explore premium product lines to meet changing consumer tastes. Recognizing the growing demand for a frozen pizza that could deliver the robust, hearty flavors of a neighborhood brewpub, Bernatello’s developed Brew Pub. This brand was designed to capture the essence of traditional brewpub fare with extra layers of cheese, bold, savory toppings, and even a bacon cheeseburger-inspired variation. Brew Pub represents the fusion of time-honored recipes with modern production techniques, a nod to both the company’s past successes and its innovative spirit moving forward.",
            'founded_year' => '2012',
            'description' => 'Brew Pub is Bernatello’s Foods’ premium frozen pizza brand, proudly crafted in Maple Lake, Minnesota. It features a rich, meat-forward style with twice the cheese and generous portions of classic pizza meats—including a unique bacon cheeseburger option—delivering the indulgent flavors of a traditional brewpub right from your freezer.',
        ]);

        if (!$brand->image) {
            $image = ImageHandler::createFromUrl(
                'https://www.shopbernatellospizza.com/product_images/uploaded_images/brewpub-brandmark.jpg', // url
                'public',
                'images/logos/frozen',
                'BrewPub' // name - no extension
            );
            $brand->image_id = $image->id;
            $brand->save();
        }

        $pizzas = [
            [
                'name' => "Lotzza Motzza Sausage & Pepperoni",
                'slug' => "lotzza-motzza-sausage-pepperoni",
                'tags' => ['pepperoni', 'sausage'],
                'description' => "Fresh tomato sauce, large nuggets of zesty sausage, flavorful pepperoni slices and over 1/2 of real Wisconsin Mozzarella Cheese!",
                'image_url' => "https://cdn11.bigcommerce.com/s-5tf6tdwuxj/images/stencil/1280x1280/products/146/794/LotzzaMotzza_SausagePepperoni_f__66303.1680029918.png?c=2",
                'ingredients' => "Low Moisture Part Skim Mozzarella Cheese (Pasteurized Part Skim Milk, Salt, Cheese Cultures, Enzymes), Crust (Enriched Flour [Bleached Wheat Flour, Niacin, Reduced Iron, Thiamine Mononitrate, Riboflavin, Enzyme, Folic Acid], Water, Lard [Lard, BHA, Propyl Gallate with Citric Acid Added to Help Protect Flavor], Dough Conditioner [Malted Barley Flour, Dextrose], Salt, Sugar, Yeast [Yeast, Sorbitan Monostearate, Ascorbic Acid]), Sauce (Tomato Puree, Water, Seasoning [Salt, Spices, Sugar, Garlic Powder], Romano Cheese Made from Cow's Milk [Pasteurized Milk, Cheese Cultures, Salt, Enzymes]), Cooked Italian Sausage (Pork, Spices, Salt, Dextrose, Garlic Powder, Paprika, Flavoring), Pepperoni (Pork, Beef, salt, Spices, Contains 2% or less of Dextrose, Lactic Acid Starter Culture, Flavorings, Garlic Powder, Sodium Nitrite, BHA, BHT, Citric Acid, Oleoresin of Paprika, and/or Paprika, May also contain Water, Smoke Flavoring, Sodium Ascorbate). ",
                'allergens' => "Wheat, Milk, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => '5 servings per container',
                    'serving_size' => '1/5 pizza (152g)',
                    'calories' => 380,
                    'total_fat' => '16g',
                    'saturated_fat' => '6g',
                    'trans_fat' => '0g',
                    'cholesterol' => '35mg',
                    'sodium' => '710mg',
                    'total_carbohydrate' => '41g',
                    'dietary_fiber' => '2g',
                    'total_sugars' => '3g',
                    'added_sugars' => '0g',
                    'protein' => '17g',
                    'vitamin_d' => '0.2mcg',
                    'calcium' => '310mg',
                    'iron' => '1.3mg',
                    'potassium' => '330mg',
                ]
            ],
            [
                'name' => "Lotzza Motzza Pepperoni",
                'slug' => "lotzza-motzza-pepperoni",
                'tags' => ['pepperoni'],
                'description' => "Fresh tomato sauce, flavorful pepperoni slices, diced pepperoni pieces, and over 1/2 pound of Real Wisconsin Mozzarella Cheese!",
                'image_url' => "https://cdn11.bigcommerce.com/s-5tf6tdwuxj/images/stencil/1280x1280/products/144/798/LotzzaMotzza_Pepperoni_f__04921.1680030696.png?c=2",
                'ingredients' => "Low Moisture Part Skim Mozzarella Cheese (Pasteurized Part Skim Milk, Salt, Cheese Cultures, Enzymes), Crust (Enriched Flour [Bleached Wheat Flour, Niacin, Reduced Iron, Thiamine Mononitrate, Riboflavin, Enzyme, Folic Acid], Water, Lard [Lard, BHA, Propyl Gallate with Citric Acid Added to Help Protect Flavor], Dough Conditioner (Malted Barley Flour, Dextrose), Salt, Sugar, Yeast [Yeast, Sorbitan Monostearate, Ascorbic Acid), Sauce (Tomato Puree, Water, Seasoning [Salt, Spices, Sugar, Garlic Powder], Romano Cheese Made from Cow's Milk [Pasteurized Milk, Cheese Cultures, Salt, Enzymes]), Pepperoni (Pork, Beef, salt, Spices, Contains 2% or less of Dextrose, Lactic Acid Starter Culture, Flavorings, Garlic Powder, Sodium Nitrite, BHA, BHT, Citric Acid, Oleoresin of Paprika, and/or Paprika, May also contain Water, Smoke Flavoring, Sodium Ascorbate). ",
                'allergens' => "Wheat, Milk, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => '4 servings per container',
                    'serving_size' => '1/4 pizza (149g)',
                    'calories' => 380,
                    'total_fat' => '18g',
                    'saturated_fat' => '9g',
                    'trans_fat' => '0g',
                    'cholesterol' => '45mg',
                    'sodium' => '900mg',
                    'total_carbohydrate' => '35g',
                    'dietary_fiber' => '2g',
                    'total_sugars' => '4g',
                    'added_sugars' => '<1g',
                    'protein' => '16g',
                    'vitamin_d' => '0.3mcg',
                    'calcium' => '400mg',
                    'iron' => '2.2mg',
                    'potassium' => '380mg',
                ]
            ],
            [
                'name' => "Lotzza Motzza Sausage",
                'slug' => "lotzza-motzza-sausage",
                'tags' => ['sausage'],
                'description' => "Fresh tomato sauce, large nuggets of zesty sausage, and over 1/2 pound of Real Wisconsin Mozzarella Cheese!",
                'image_url' => "https://cdn11.bigcommerce.com/s-5tf6tdwuxj/images/stencil/1280x1280/products/143/800/LotzzaMotzza_Sausage_f__37797.1680030863.png?c=2",
                'ingredients' => "Low Moisture Part Skim Mozzarella Cheese (Pasteurized Part Skim Milk, Salt,  Cheese Cultures, Enzymes), Crust (Enriched Flour [Bleached Wheat Flour, Niacin, Reduced Iron, Thiamine Mononitrate, Riboflavin, Enzyme, Folic Acid], Water, Lard [Lard, BHA, Propyl Gallate with Citric Acid Added to Help Protect Flavor], Dough Conditioner [Malted Barley Flour, Dextrose], Salt, Sugar, Yeast [Yeast, Sorbitan Monostearate, Ascorbic Acid]), Sauce (Tomato Puree, Water, Seasoning [Salt, Spices, Sugar, Garlic Powder], Romano Cheese Made from Cow's Milk [Pasteurized Milk, Cheese Cultures, Salt, Enzymes]), Cooked Italian Sausage (Pork, Spices, Salt, Dextrose, Garlic Powder, Paprika, Flavoring). ",
                'allergens' => "Wheat, Milk, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => '5 servings per container',
                    'serving_size' => '1/5 pizza (134g)',
                    'calories' => 330,
                    'total_fat' => '16g',
                    'saturated_fat' => '8g',
                    'trans_fat' => '0g',
                    'cholesterol' => '45mg',
                    'sodium' => '770mg',
                    'total_carbohydrate' => '28g',
                    'dietary_fiber' => '2g',
                    'total_sugars' => '4g',
                    'added_sugars' => '<1g',
                    'protein' => '15g',
                    'vitamin_d' => '0.4mcg',
                    'calcium' => '330mg',
                    'iron' => '1.9mg',
                    'potassium' => '350mg',
                ]
            ],
            [
                'name' => "Lotzza Motzza Cheese",
                'slug' => "lotzza-motzza-cheese",
                'tags' => ['cheese-lovers', 'chedar', 'vegetarian'],
                'description' => "Fresh tomato sauce, white cheddar cheese, and over 1/2 pound of Real Wisconsin Mozzarella Cheese!",
                'image_url' => "https://cdn11.bigcommerce.com/s-5tf6tdwuxj/images/stencil/1280x1280/products/145/796/LotzzaMotzza_Cheese_f__55673.1680030497.png?c=2",
                'ingredients' => "Low Moisture Part Skim Mozzarella Cheese (Pasteurized Milk, Salt, Cheese Cultures, Enzymes), Crust (Wheat Flour [Bleached Wheat Flour, Niacin, Reduced Iron, Thiamine Mononitrate, Riboflavin, Enzyme, Folic Acid], Water, Lard [Lard, BHA, Propyl Gallate with Citric Acid Added to Help Protect Flavor], Dough Conditioner [Malted Barley Flour, Dextrose], Salt, Sugar, Yeast [Yeast, Sorbitan, Monostearate, Ascorbic Acid]), Sauce (Tomato Puree, Water, Seasoning [Salt, Spices, Sugar, Garlic Powder], Romano Cheese [Pasteurized Cows Milk, Cheese Cultures, Salt, Enzymes]). ",
                'allergens' => "Wheat, Milk, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => '4 servings per container',
                    'serving_size' => '1/4 pizza (142g)',
                    'calories' => 340,
                    'total_fat' => '14g',
                    'saturated_fat' => '8g',
                    'trans_fat' => '0g',
                    'cholesterol' => '40mg',
                    'sodium' => '760mg',
                    'total_carbohydrate' => '35g',
                    'dietary_fiber' => '2g',
                    'total_sugars' => '4g',
                    'added_sugars' => '<1g',
                    'protein' => '15g',
                    'vitamin_d' => '0.2mcg',
                    'calcium' => '430mg',
                    'iron' => '2.1mg',
                    'potassium' => '350mg',
                ]
            ],
            [
                'name' => "Lotzza Motzza Supreme",
                'slug' => "lotzza-motzza-supreme",
                'tags' => ['supreme', 'pepperoni', 'sausage', 'peppers', 'onions', 'mushroom'],
                'description' => "Fresh tomato sauce, large nuggets of zesty sausage, flavorful pepperoni slices, premium green and red peppers, onions, mushrooms, and With over 1/2 of real Wisconsin Mozzarella Cheese!",
                'image_url' => "https://cdn11.bigcommerce.com/s-5tf6tdwuxj/images/stencil/1280x1280/products/147/792/LotzzaMotzza_Supreme_f__09336.1680029674.png?c=2",
                'ingredients' => "Low Moisture Part Skim Mozzarella Cheese (Pasteurized Part Skim Milk, Salt, Cheese Cultures,Enzymes), Crust (Enriched Flour [Bleached Wheat Flour, Niacin, Reduced Iron, Thiamine Mononitrate, Riboflavin, Enzyme, Folic Acid], Water, Lard [Lard, BHA, Propyl Gallate with Citric Acid Added to Help Protect Flavor], Dough Conditioner [Malted Barley Flour, Dextrose], Salt, Sugar, Yeast [Yeast, Sorbitan Monostearate, Ascorbic Acid]), Sauce (Tomato Puree, Water, Seasoning [Salt, Spices, Sugar, Garlic Powder], Romano Cheese Made from Cow's Milk [Pasteurized Milk, Cheese Cultures, Salt, Enzymes]), Cooked Italian Sausage (Pork, Spices, Salt, Dextrose, Garlic Powder, Paprika, Flavoring), Fire Roasted Vegetable Blend (Red Bell Pepper, Green Bell Pepper, Red Onion), Mushrooms, Pepperoni (Pork, Beef, salt, Spices, Contains 2% or less of Dextrose, Lactic Acid Starter Culture, Flavorings, Garlic Powder, Sodium Nitrite, BHA, BHT, Citric Acid, Oleoresin of Paprika, and/or Paprika, May also contain Water, Smoke Flavoring, Sodium Ascorbate).",
                'allergens' => "Wheat, Milk, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => '4 servings per container',
                    'serving_size' => '1/4 pizza (142g)',
                    'calories' => 320,
                    'total_fat' => '12g',
                    'saturated_fat' => '6g',
                    'trans_fat' => '0g',
                    'cholesterol' => '30mg',
                    'sodium' => '700mg',
                    'total_carbohydrate' => '30g',
                    'dietary_fiber' => '2g',
                    'total_sugars' => '3g',
                    'added_sugars' => '<1g',
                    'protein' => '14g',
                    'vitamin_d' => '0.1mcg',
                    'calcium' => '400mg',
                    'iron' => '1.5mg',
                    'potassium' => '300mg',
                    'monounsaturated_fat' => '3g',
                    'polyunsaturated_fat' => '1g',
                    'vitamin_a' => '200IU',
                    'vitamin_c' => '2mg',
                ]
            ],
            [
                'name' => " Lotzza Motzza 4 Meat",
                'slug' => "lotzza-motzza-4-meat",
                'tags' => ['meat-lovers', 'bacon', 'pepperoni', 'sausage', 'canadian-bacon'],
                'description' => "Fresh tomato sauce, large nuggets of zesty sausage, flavorful slices of pepperoni, Canadian style bacon, bacon pieces, and over 1/2 lb of real Wisconsin Mozzarella Cheese!",
                'image_url' => "https://cdn11.bigcommerce.com/s-5tf6tdwuxj/images/stencil/1280x1280/products/148/790/LotzzaMotzza_4Meat_f__96612.1680023162.png?c=2",
                'ingredients' => "Low Moisture Part Skim Mozzarella Cheese (Pasteurized Part Skim Milk, Salt, Cheese Cultures, Enzymes), Crust (Enriched Flour [Bleached Wheat Flour, Niacin, Reduced Iron, Thiamine Mononitrate, Riboflavin, Enzyme, Folic Acid], Water, Lard [Lard, BHA, Propyl Gallate with Citric Acid Added to Help Protect Flavor], Dough Conditioner [Malted Barley Flour, Dextrose], Salt, Sugar, Yeast [Yeast, Sorbitan Monostearate, Ascorbic Acid]), Sauce (Tomato Puree, Water, Seasoning [Salt, Spices, Sugar, Garlic Powder], Romano Cheese Made from Cow's Milk [Pasteurized Milk, Cheese Cultures, Salt, Enzymes]), Cooked Italian Sausage (Pork, Spices, Salt, Dextrose, Garlic Powder, Paprika, Flavoring),Bacon (Pork Cured with: Water, Salt, Sodium Phosphate, Sodium Erythorbate, Sodium Nitrite. May Also Contain Sugar, Flavoring, Smoke Flavor, Brown Sugar),Pepperoni (Pork, Beef, salt, Spices, Contains 2% or less of Dextrose, Lactic Acid Starter Culture, Flavorings, Garlic Powder, Sodium Nitrite, BHA, BHT, Citric Acid, Oleoresin of Paprika, and/or Paprika, May also contain Water, Smoke Flavoring, Sodium Ascorbate), Canadian Style BaconMade With Pork Sirloin Hips (Pork, Water, Salt, Brown Sugar, Potassium Lactate, Sodium Lactate, Sodium Phosphate, Sodium Diacetate, Sodium Erythorbate, Sodium Nitrite). ",
                'allergens' => "Wheat, Milk, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => '5 servings per container',
                    'serving_size' => '1/5 pizza (138g)',
                    'calories' => 360,
                    'total_fat' => '18g',
                    'saturated_fat' => '8g',
                    'trans_fat' => '0g',
                    'cholesterol' => '50mg',
                    'sodium' => '920mg',
                    'total_carbohydrate' => '28g',
                    'dietary_fiber' => '2g',
                    'total_sugars' => '4g',
                    'added_sugars' => '<1g',
                    'protein' => '17g',
                    'vitamin_d' => '0.3mcg',
                    'calcium' => '330mg',
                    'iron' => '2mg',
                    'potassium' => '390mg',
                ]
            ],
            [
                'name' => "Lotzza Motzza Breakfast",
                'slug' => "lotzza-motzza-breakfast",
                'tags' => ['breakfast', 'bacon', 'sausage', 'eggs', 'cheddar'],
                'description' => "BrewPub Lotzza Motzza Breakfast Pizza",
                'image_url' => "https://cdn11.bigcommerce.com/s-5tf6tdwuxj/images/stencil/1280x1280/products/220/791/LotzzaMotzza_BreakfastPizza_f__55832.1680023297.png?c=2",
                'ingredients' => "Crust (Enriched Flour [Bleached Wheat Flour, Niacin, Reduced Iron, Thiamine Mononitrate, Riboflavin, Enzyme, Folic Acid], Water, Lard [Lard, BHA, Propyl Gallate with Citric Acid Added to Help Protect Flavor], Dough Conditioner [Malted Barley Flour, Dextrose], Salt, Sugar, Yeast [Yeast, Sorbitan Monostearate, Ascorbic Acid]), Low Moisture Part Skim MozzarellaCheese (Pasteurized Part Skim Milk, Salt, Cheese Cultures, Enzymes), Scrambled Eggs (Whole Eggs, Skim Milk, Soybean Oil, Corn Starch, Salt, Xanthan Gum, Citric Acid), Country Gravy (Water, Seasoning [Modified Corn Starch, Cream Powder {Coconut Oil, Corn Syrup Solids, Sodium Caseinate, Dipotassium Phosphate, Mono & Diglycerides}, Nonfat Dry Milk, Salt, Dextrose, Maltodextrin, Whey, Natural Flavors Including Butter, Spice, Onion Powder, Autolyzed Yeast Extract, Torula Yeast, Hydrolyzed Corn Protein, Disodium Inosinate and Guanylate, Chicken Fat]), CookedSausage (Pork, Spices, Water, Salt, and Less Than 2% of the Following: Dextrose, Paprika, Garlic Powder, Yeast Extract, Natural Flavorings, Potassium Chloride, Sodium Tripolyphosphate), Cheddar Cheese (Pasteurized Milk, Cheese Cultures, Salt, Enzymes, Annatto [Color]),Fully Cooked Bacon  (Pork, Cured with: Water, Salt, Sodium Phosphate, Sodium Erythorbate, Sodium Nitrite. May Contain Sugar, Flavoring, Smoke Flavor, Brown Sugar). ",
                'allergens' => "Wheat, Milk, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => '5 servings per container',
                    'serving_size' => '1/5 pizza (138g)',
                    'calories' => 370,
                    'total_fat' => '20g',
                    'saturated_fat' => '9g',
                    'trans_fat' => '0g',
                    'cholesterol' => '125mg',
                    'sodium' => '840mg',
                    'total_carbohydrate' => '27g',
                    'dietary_fiber' => '1g',
                    'total_sugars' => '2g',
                    'added_sugars' => '<1g',
                    'protein' => '16g',
                    'vitamin_d' => '0.3mcg',
                    'calcium' => '330mg',
                    'iron' => '1.8mg',
                    'potassium' => '260mg',
                ]
            ],
            [
                'name' => "Packers - The Pick 6",
                'slug' => "packers-the-pick-6",
                'tags' => ['sausage', 'ham', 'beef', 'pepperoni', 'canadian-bacon', 'bacon'],
                'description' => "The Pick-6 pizza is the perfect combination of 6 meats - sausage, diced ham, pepperoni, beef, Canadian style bacon, and bacon bits - bombarded with our classic Brew Pub sauce and award-winning Wisconsin mozzarella cheese. Brew Pub pizza and the Green Bay Packers are a winning combination that can't be beat! Brew Pub Pizza is the Official Pizza of the Green Bay Packers!",
                'image_url' => "https://cdn11.bigcommerce.com/s-5tf6tdwuxj/images/stencil/1280x1280/products/232/817/BP_Packers_The_Pick_6-01__54574.1719598757.png?c=2",
                'ingredients' => "Crust (Enriched Flour [Bleached Wheat Flour, Niacin, Reduced Iron, Thiamin Mononitrate, Riboflavin, Enzyme, Folic Acid], Water, Lard [Lard, BHA Propyl Gallate with Citric Acid Added to Help Protect Flavor], Dough Conditioner [Malted Barley Flour, Dextrose], Salt, Sugar, Yeast [Yeast, Sorbitan Monostearate, Ascorbic Acid]), Low Moisture Part Skim Mozzarella Cheese (Pasteurized Part Skim Milk, Salt, Cheese Cultures, Enzymes), Sauce (Tomato Puree, Water, Seasoning [Salt, Spices, Sugar, Garlic Powder], Romano Cheese Made from Cow's Milk [Pasteurized Milk, Cheese Cultures, Salt, Enzymes]), Cooked Italian Sausage (Pork, Spices, Salt, Dextrose, Garlic Powder, Paprika, Flavoring), Fully Cooked Diced Smoked Ham with Natural Juices (Pork Cured with Water, Salt, Dextrose, Sodium Phosphate, Sodium Erythorbate, Sodium Nitrite), Beef Water and Binder Product (Beef, Water, Dextrose, Salt, Sodium Phosphates, Modified Food Starch, Sodium Citrate, Hydrolyzed Corn Protein, Autolyzed Yeast Extract, Caramel Color, Sodium Diacetate, Spices [Including Celery Seed], Onion and Garlic Powder, Guar Gum, Paprika, Maltodextrin, Corn Syrup Solids, Natural Smoke Flavor), Pepperoni (Pork, Beef, Salt, Spices, Contains 2% or Less of Dextrose, Lactic Acid Starter Culture, Flavorings, Garlic Powder, Sodium Nitrite, BHA, BHT, Citric Acid, Oleoresin of Paprika, and/or Paprika, May Also Contain Water, Smoke Flavoring, Sodium Ascorbate), Canadian Style Bacon Made with Pork Sirloin Hips (Pork, Water, Salt, Brown Sugar, Potassium Lactate, Sodium Lactate, Sodium Phosphate, Sodium Diacetate, Sodium Erythorbate, Sodium Nitrite), Fully Cooked Bacon Topping (Pork Cured with Water, Salt, Sodium Phosphate, Sodium Erythorbate, Sodium Nitrite, May Also Contain Sugar, Flavoring, Smoke Flavor, Brown Sugar).",
                'allergens' => "Wheat, Milk, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => '5 servings per container',
                    'serving_size' => '1/5 pizza (135g)',
                    'calories' => 330,
                    'total_fat' => '16g',
                    'saturated_fat' => '7g',
                    'trans_fat' => '0g',
                    'cholesterol' => '45mg',
                    'sodium' => '910mg',
                    'total_carbohydrate' => '28g',
                    'dietary_fiber' => '2g',
                    'total_sugars' => '4g',
                    'added_sugars' => '1g',
                    'protein' => '15g',
                    'vitamin_d' => '0.3mcg',
                    'calcium' => '260mg',
                    'iron' => '2mg',
                    'potassium' => '380mg',
                ]
            ],
            [
                'name' => "Packers - The Kicker",
                'slug' => "packers-the-kicker",
                'tags' => ['jalapeno', 'bacon', 'asiago', 'garlic'],
                'description' => "The Kicker is a Jalapeno Popper pizza topped with Jalapeno Cream cheese sauce, then loaded with mozzarella and asiago cheeses, bacon, jalapeno peppers and garlic. Brew Pub pizza and the Green Bay Packers are a winning combination that can't be beat! Brew Pub Pizza is the Official Pizza of the Green Bay Packers!",
                'image_url' => "https://cdn11.bigcommerce.com/s-5tf6tdwuxj/images/stencil/1280x1280/products/231/815/BP_Packers_The_Kicker-01__15006.1719598657.png?c=2",
                'ingredients' => "Crust (Enriched Flour [Bleached Wheat Flour, Niacin, Reduced Iron, Thiamin Mononitrate, Riboflavin, Enzyme, Folic Acid], Water, Lard [Lard, BHA, Propyl Gallate with Citric Acid Added to Help Protect Flavor], Dough Conditioner [Malted Barley Flour, Dextrose], Salt, Sugar, Yeast [Yeast, Sorbitan Monostearate, Ascorbic Acid]), Jalapeno Cream Cheese Sauce (Water, [Cream Cheese {Pasteurized Milk and Cream, Cheese Culture, Salt, Carob Bean Gum}, Sour Cream Powder {Cream, Cultures and Lactic Acid}, Modified Food Starch, Whey, Nonfat Milk, Sugar, Less than 2% of Spices, Salt, Sodium Phosphate, Citric Acid, and Fully Refined Soybean Oil]), Low Moisture Part Skim Mozzarella Cheese (Pasteurized Part Skim Milk, Salt, Cheese Cultures, Enzymes), Fully Cooked Bacon Topping (Pork Cured with Water, Salt, Sodium Phosphate, Sodium Erythorbate, Sodium Nitrite, May Also Contain Sugar, Flavoring, Smoke Flavor, Brown Sugar), Jalapeno Pepper, Shredded Asiago Cheese (Asiago Cheese [Pasteurized Milk, Cheese Cultures, Salt, Enzymes] Powdered Cellulose [to Prevent Caking]), Minced Garlic.",
                'allergens' => "Wheat, Milk, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => '4 servings per container',
                    'serving_size' => '1/4 pizza (146g)',
                    'calories' => 400,
                    'total_fat' => '21g',
                    'saturated_fat' => '11g',
                    'trans_fat' => '0.5g',
                    'cholesterol' => '60mg',
                    'sodium' => '900mg',
                    'total_carbohydrate' => '34g',
                    'dietary_fiber' => '1g',
                    'total_sugars' => '4g',
                    'added_sugars' => '1g',
                    'protein' => '15g',
                    'vitamin_d' => '0.4mcg',
                    'calcium' => '320mg',
                    'iron' => '2mg',
                    'potassium' => '290mg',
                ]
            ],
            [
                'name' => "Packers - Stadium Steak",
                'slug' => "packers-stadium-steak",
                'tags' => ['cheesesteak', 'beef', 'peppers', 'onions', 'provolone'],
                'description' => "The Stadium Steak pizza is a Philly Style Cheesesteak pizza, topped with a perfect combination of cheese sauce, beef topping, red and green peppers, red onion, mozzarella and provolone cheeses. Brew Pub pizza and the Green Bay Packers are a winning combination that can't be beat! Brew Pub Pizza is the Official Pizza of the Green Bay Packers!",
                'image_url' => "https://cdn11.bigcommerce.com/s-5tf6tdwuxj/images/stencil/1280x1280/products/229/811/BP_Packers_Stadium_Steak-01__09864.1719598395.png?c=2",
                'ingredients' => "Crust (Enriched Flour [Bleached Wheat Flour, Niacin, Reduced Iron, Thamin Mononitrate, Riboflavin, Enzyme, Folic Acid], Water, Lard [Lard, BHA Propyl Gallate with Citric Acid Added to Help Protect Flavor], Dough Conditioner [Malted Barley Flour, Dextrose] Salt, Sugar, Yeast [Yeast, Sorbitan Monostearate, Ascorbic Acid]), Cheddar Cheese Sauce [Water, Instant Cheese Sauce (Whey, Maltodextrin, Dehydrated Cheddar Cheese [Pasteurized Milk, Cheese Culture, Salt, Enzymes], Modified Corn Starch, Salt, Dry Whole Milk, Buttermilk Powder Sodium Phosphate, Lactic Acid, Natural Flavors, Dehydrated Butter, Extractives of Annatto [Color], Turmeric [Color]) Beef Water and Binder Product (Beef, Water, Dextrose, Salt, Sodium Phosphates, Modified Food Starch, Sodium Citrate, Hydrolyzed Corn Protein, Autolyzed Yeast Extract, Caramel Color, Sodium Diacetate, Spices [Including Celery Seed], Onion and Garlic Powder Guar Gum, Paprika, Maltodextrin, Corn Syrup Solids, Natural Smoke Flavor) Provolone Cheese (Pasteurized Whole Milk Cheese Culture, Salt, Enzymes), Low Moisture Part Skim Mozzarella Cheese (Pasteurized Part Skim Milk, Salt, Cheese Cultures, Enzymes), Fire Roasted Vegetable Blend (Red Bell Pepper, Green Bell Pepper Red Onion), Seasoning (Salt, Black Pepper, Garlic Powder).",
                'allergens' => "Wheat, Milk, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => '4 servings per container',
                    'serving_size' => '1/4 pizza (144g)',
                    'calories' => 370,
                    'total_fat' => '18g',
                    'saturated_fat' => '9g',
                    'trans_fat' => '0g',
                    'cholesterol' => '45mg',
                    'sodium' => '970mg',
                    'total_carbohydrate' => '36g',
                    'dietary_fiber' => '1g',
                    'total_sugars' => '4g',
                    'added_sugars' => '1g',
                    'protein' => '12g',
                    'vitamin_d' => '0mcg',
                    'calcium' => '300mg',
                    'iron' => '1.7mg',
                    'potassium' => '180mg',
                ]
            ],
            [
                'name' => "Packers - BBQ Blitz",
                'slug' => "packers-bbq-blitz",
                'tags' => ['bbq', 'chicken', 'cheddar', 'corn-chips',],
                'description' => "The BBQ Blitz pizza is made with generous amounts of BBQ Smoked Chicken, smothered in sweet, tangy BBQ sauce, and smothered with mozzarella and cheddar cheeses, green onions and corn chips. Brew Pub pizza and the Green Bay Packers are a winning combination that can't be beat! Brew Pub Pizza is the Official Pizza of the Green Bay Packers!",
                'image_url' => "https://cdn11.bigcommerce.com/s-5tf6tdwuxj/images/stencil/1280x1280/products/230/813/BP_Packers_BBQ_Blitz-01__18418.1719598566.png?c=2",
                'ingredients' => "Crust (Enriched Flour [Bleached Wheat Flour, Niacin, Reduced Iron, Thiamin Mononitrate, Riboflavin, Enzyme, Folic Acid], Water, Lard [Lard, BHA, Propyl Gallate with Citric Acid Added to Help Protect Flavor], Dough Conditioner [Malted Barley Flour, Dextrose], Salt, Sugar, Yeast [Yeast, Sorbitan Monostearate, Ascorbic Acid]), Low Moisture Part Skim Mozzarella Cheese (Pasteurized Part Skim Milk, Salt, Cheese Cultures, Enzymes), Bbq Sauce (Sugar, Water, Tomato Paste, Vinegar, Salt, Pineapple Juice Concentrate, Modified Food Starch, Worcestershire Sauce [Water, Salt, Vinegar, Sugar, Malic Acid, Molasses, Citric Acid, Dehydrated Onion and Garlic, Food Gums {Arabic, Xanthan, Guar, Cellulose}, Spices, Dextrose, Natural Flavors, Smoke Flavor], Liquid Smoke, Mustard Flour, Spices, Sodium Benzoate as a Preservative), Smoked Pulled Chicken (Chicken, Seasoning [Spices, Salt, Sugar, Garlic Powder, Disodium Inosinate and Disodium Guanylate, Silicon Dioxide and Sunflower Oil {to Prevent Caking}], Less than 2% of Potassium Lactate, Water, Sodium Diacetate, Natural Hickory Wood Smoke Flavor), Cheddar Cheese (Pasteurized Milk, Cheese Cultures, Salt, Enzymes, Annatto [Color]), Corn Chips (Corn, Corn Oil, and Salt), Green Onion.",
                'allergens' => "",
                'nutritional_facts' => [
                    'serving_per_container' => '4 servings per container',
                    'serving_size' => '1/4 pizza (151g)',
                    'calories' => 410,
                    'total_fat' => '16g',
                    'saturated_fat' => '7g',
                    'trans_fat' => '0g',
                    'cholesterol' => '60mg',
                    'sodium' => '950mg',
                    'total_carbohydrate' => '47g',
                    'dietary_fiber' => '2g',
                    'total_sugars' => '14g',
                    'added_sugars' => '11g',
                    'protein' => '17g',
                    'vitamin_d' => '0.3mcg',
                    'calcium' => '310mg',
                    'iron' => '2.2mg',
                    'potassium' => '400mg',
                ]
            ],
        ];

        foreach ($pizzas as $pizza) {
            PizzaSeedHandler::seedPizza($brand, $pizza);
        }
    }
}

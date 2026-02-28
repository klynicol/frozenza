<?php

namespace Database\Seeders;

use App\Handlers\ImageHandler;
use App\Handlers\PizzaSeedHandler;
use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DogtownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brand = Brand::updateOrCreate([
            'slug' => 'dogtown-pizza',
        ], [
            'name' => 'Dogtown Pizza',
            'website' => 'https://www.dogtownpizza.com/',
            'brand_story' => 'Rick and Meredith Schaper were known in their modest Dogtown neighborhood for their pizza parties. “We always were the ones who brought and baked pizza for block parties and other neighborhood events,” says Rick.

In October 2006, the two launched Dogtown Pizza out of their home kitchen…giving some away and selling even more. The business started slowly: a couple of hundred pizzas a week…from there, it’s grown slowly and steadly. Dogtown Pizza turns out nearly 65,000 pizzas monthly.

Dogtown Pizza started when some cracks started showing in the economic landscape. Undeterred, the Schaper’s kept at it. Rick knew that there was a very real local movement – people demanding that the products they chose for their families supported their neighbors, their town, their state. Dogtown Pizza still strives to source as much of its raw ingredients from as many local families as possible.

Today, the pizzas can be found all over town at grocers large and small – the big-name chains and small specialty stores, as well.',
            'founded_year' => '2006',
            'description' => 'It’s about family and friends – old neighbors and new neighbors alike. It’s about block parties, cook-outs, camp-outs, and having fun. Smiles, jokes, laughter, enjoyment, good drinks, and great eats. We take pride in and are honored to provide your family with food we enjoy as a family, too. Great ingredients, well-prepared, and carefully assembled into a fun, quick, nutritious meal that you can take pride in baking for your family. That’s what Dogtown Pizza is about.

So make an order and make it big. Keep some extra pizzas in the freezer and bake some up anytime.

From our family table to yours, thank you for your business. Enjoy!',
        ]);

        if (!$brand->image) {
            $image = ImageHandler::createFromUrl(
                'https://www.dogtownpizza.com/wp-content/uploads/2016/10/DTP-Logo.png', // url
                'public',
                'images/logos/frozen',
                'Dogtown' // name - no extension
            );
            $brand->image_id = $image->id;
            $brand->save();
        }

        $pizzas = [
            [
                'name' => "Bacon Bacon",
                'slug' => "bacon-bacon",
                'tags' => ['st-louis-style', 'bacon'],
                'description' => "Huge, juicy chunks of home-cooked, hand-torn bacon piled high. Because you deserve it.",
                'image_url' => "https://images.cdn.retail.brookshires.com/detail/8b5ce77f-a5f4-41fb-b8cb-192f3469d06a.jpeg",
                'ingredients' => "Pizza Crust (Unbleached Flour (Wheat Flour, Malted Barley Flour, Niacin, Reduced Iron, Thiamine Mononitrate, Riboflavin, Folio Acid), Water, Soybean Oil, Contains Less than 2% of the Following: Sugar, Yeast, Salt, Canola Oil (Releasing Agent), Pizza Sauce (Crushed Tomatoes (Water, Concentrated Crushed Tomatoes), Salt, Sugar, Dehydrated Onion, Spices, Citric Acid, Garlic Powder), Pasteurized Process Cheddar, Swiss and Provolone Cheese (Cultured Pasteurized Milk and Part-Skim Milk, Water, Salt, Sodium Phosphate, Milkfat, Contains Less than 0.5 Percent of Lactic Acid, Sorbic Acid (Preservative), Enzymes, Smoke Flavor), L•, Moisture Part Skim Mozzarella (Pasteurized Part Skim Milk, Cheese Cultures, Salt, Enzymes), Bacon (Cured with Water, Salt, Sugar, Sodium Erythorbate, Sodium Nitrite, May Also Contain Smoke Flavoring, Dextrose, Sodium Phosphate, Potassium Chloride, Sodium Diacetate, Flavoring, Honey), Paroma Cheese (Parmesan and Romano Cheese (Pasteurized Cow's Milk, Cheese Culture, Salt, Enzymes)), Ground Oregano.",
                'allergens' => "Milk, Wheat, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 4,
                    'serving_fraction' => '1/4',
                    'serving_weight' => 0,
                    'calories' => 290,
                    'caloris_from_fat' => 0,
                    'total_fat' => 13,
                    'saturated_fat' => 6,
                    'trans_fat' => 0,
                    'cholesterol' => 40,
                    'sodium' => 890,
                    'total_carbohydrate' => 26,
                    'dietary_fiber' => 2,
                    'total_sugars' => 1,
                    'added_sugars' => 1,
                    'protein' => 15,
                    'vitamin_d' => 0,
                    'calcium' => 239,
                    'iron' => 2,
                    'potassium' => 222,
                ]
            ],
            [
                'name' => "4 Meat",
                'slug' => "4-meat",
                'tags' => ['meat-lovers', 'st-louis-style'],
                'description' => "This is for all you carnivores out there: salsiccia, pepperoni, hickory-smoked bacon, and ham. Drool.",
                'image_url' => "https://ip.prod.freshop.retail.ncrcloud.com/resize?url=https://images.freshop.ncrcloud.com/00852642006076/582e2b6c34a983752e6c9cff96408cc5_large.png&width=512&type=webp&quality=90",
                'ingredients' => "Crust (Unbleached Flour (Wheat Flour, Malted Barley Flour, Niacin, Reduced Iron, Thiamine Mononitrate, Riboflavin, Folic Acid), Water, Soybean Oil, Contains Less than 2% of the Following: Sugar, Yeast, Salt, Canola Oil (Releasing Agent), Pizza Sauce (Crushed Tomatoes (Water, Concentrated Crushed Tomatoes), Salt, Sugar, Dehydrated Onion, Spices, Citric Acid, Garlic Powder), Pasteurized Process Cheddar, Swiss and Provolone Cheese (Cultured Pasteurized Milk and Part-Skim Milk, Water, Salt, Sodium Phosphate, Milkfat, Contains Less than 0.5 Percent of Lactic Acid, Sorbic Acid (Preservative), Enzymes, Smoke Flavor), Low Moisture Part Skim Mozzarella (Pasteurized Part Skim Milk, Cheese Cultures, Salt, Enzymes), Italian Sausage (Pork, Seasoning (Salt, Spices, Dextrose, Dehydrated Garlic), Natural Flavorings), Bacon (Cured with Water, Salt, Sugar, Sodium Erythorbate, Sodium Nitrite, May Also Contain Smoke Flavoring, Dextrose, Sodium Phosphate, Potassium Chloride, Sodium Diacetate, Flavoring, Honey), Pepperoni (Pork, Beef, Salt, Contains 2% or Less of Water, Paprika, Dextrose, Natural Spices, Smoke Flavoring, Lactic Acid Starter Culture, Sodium Ascorbate (Vitamin C), Flavoring, Garlic Powder, Sodium Nitrite, BHA, BHT, Citric Acid), Ham (Cured with Water, Salt, Dextrose, Modified Potato Starch, Sodium Phosphates, Potassium Lactate, Sugar, Corn Syrup, Sodium Erythorbate, Sodium Nitrite, Sodium Diacetate), Paroma Cheese (Parmesan and Romano Cheese (Pasteurized Cow's Milk, Cheese Culture, Salt, Enzymes)) Ground Oregano.",
                'allergens' => "Milk, Wheat, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 4,
                    'serving_fraction' => '1/4',
                    'serving_weight' => 0,
                    'calories' => 350,
                    'caloris_from_fat' => 0,
                    'total_fat' => 16,
                    'saturated_fat' => null,
                    'trans_fat' => null,
                    'cholesterol' => 55,
                    'sodium' => 1140,
                    'total_carbohydrate' => 26,
                    'dietary_fiber' => null,
                    'total_sugars' => null,
                    'added_sugars' => null,
                    'protein' => 19,
                    'vitamin_d' => 0,
                    'calcium' => 248,
                    'iron' => 2,
                    'potassium' => 255,
                ]
            ],
            [
                'name' => "Deluxe",
                'slug' => "deluxe",
                'tags' => ['deluxe', 'st-louis-style', 'mushroom', 'onion', 'sausage', 'bacon'],
                'description' => "Plump mushrooms, sweet yellow onion, italian salsiccia and crispy cooked bacon grace the top of this hearty pie.",
                'image_url' => "https://target.scene7.com/is/image/Target/GUEST_64f550fc-637c-4fea-98c0-0ab73e3c3a45?wid=800&hei=800&qlt=80&fmt=webp",
                'ingredients' => "pizza crust (unbleached flour (wheat flour, malted barley flour, niacin, reduced iron, thiamine mononitrate, riboflavin, folic acid), water, soybean oil, contains less than 2% of the following: sugar, yeast, salt, canola oil (releasing agent), pizza sauce (crushed tomatoes (water, concentrated crushed tomatoes), salt, sugar, dehydrated onion, spices, citric acid, garlic powder), pasteurized process cheddar, swiss and provolone cheese (cultured pasteurized milk and part-skim milk, water, salt, sodium phosphate, milkfat, contains less than 0.5 percent of lactic acid, sorbic arid (preservative), enzymes, smoke flavor), low moisture part skim mozzarella (pasteurized part skim milk, cheese cultures, salt, enzymes), italian sausage with cheese (pork, cheese mix (cheddar, swiss and provolone, cultured pasteurized milk and part skim milk, water, milkfat, sodium phosphate, salt, lactic acid, contains less than 0.5% of sorbic acid as a preservative, enzymes, smoke flavor, salt, water, spice (pepper, fennel), dextrose, garlic), bacon (cured with water, salt, sugar, sodium erythorbate, sodium nitrite, may also contain smoke flavoring, dextrose, sodium phosphate, potassium chloride, sodium diacetate, flavoring, honey), mushrooms, onion, paroma cheese (parmesan and romano cheese (pasteurized cow's milk, cheese culture, salt, enzymes)), ground oregano.",
                'allergens' => "Milk, Wheat, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 4,
                    'serving_fraction' => '1/4',
                    'serving_weight' => 0,
                    'calories' => 310,
                    'caloris_from_fat' => 0,
                    'total_fat' => 14,
                    'saturated_fat' => 7,
                    'trans_fat' => 0,
                    'cholesterol' => 45,
                    'sodium' => 950,
                    'total_carbohydrate' => 25,
                    'dietary_fiber' => 1,
                    'total_sugars' => 1,
                    'added_sugars' => 0,
                    'protein' => 17,
                    'vitamin_d' => 0,
                    'calcium' => 232,
                    'iron' => 3,
                    'potassium' => 132,
                ]
            ],
            [
                'name' => "Hamburger",
                'slug' => "hamburger",
                'tags' => ['st-louis-style', 'beef',],
                'description' => "Enjoy high-quality ground beef, with no fillers. Full-flavored and, of course, generously topped: perfectly complimentary to our 3-cheese blend and tangy sauce.",
                'image_url' => "https://www.instacart.com/image-server/699x699/filters:fill(FFF,true):format(webp)/www.instacart.com/assets/domains/product-image/file/large_9c6c1841-2665-4152-a2fb-58f37e5bd9e1.jpg",
                'ingredients' => "Pizza Crust (unbleached Flour (wheat Flour, Malted Barley Flour, Niacin, Reduced Iron, Thiamine Mononitrate, Riboflavin, Folic Acid) Water Pure Soybean Oil, Yeast, Sugar, Salt), Pizza Sauce (crushed Tomatoes (water, Concentrated Crushed Tomatoes), Salt, Sugar, Dehydrated Onion, Spices, Citric Acid, Garlic Powder.) Dogtown Pizza Cheese [(pizza Cheese (pasteurized Process Cheddar, Swiss And Provolone Cheese) (cultured Pasteurized Milk And Part Skim Milk, Water, Milkfat, Sodium Phosphate, Salt, Lactic Acid, Contains Less Than 0.5% Of Sorbic Acid As A Preservative, Enzymes, Smoke Flavor) Mozzarella Cheese (pasturized Part Skim Milk, Cheese Cultures, Salt, Enzymes)]. Hamburger (ground Beef, Salt, Spices). Paroma Cheese (parmesan And Romano Cheese (cow's Milk, Cheese Culture, Salt, Enzymes), Modified Food Starch, Water, Palm Oil Blend, Casein, Disodium Phosphate, Salt, Citric Acid, Xanthan Gum, And Trisodium Citrate.) Ground Oregano.",
                'allergens' => "Milk, Wheat, Soy",
            ],
            [
                'name' => "Pepperoni",
                'slug' => "pepperoni",
                'tags' => ['st-louis-style', 'pepperoni',],
                'description' => "We hand place 35 pieces of pepperoni so you get a mouthful of spicy deliciousness in every single bite.",
                'image_url' => 'https://images.albertsons-media.com/is/image/ABS/970566518-ECOM?$ng-ecom-pdp-desktop$&defaultImage=Not_Available',
                'ingredients' => "Pizza Crust (Unbleached Flour (Wheat Flour, Malted Barley Flour, Niacin, Reduced Iron, Thiamine Mononitrate, Riboflavin, Folic Acid), Water, Soybean Oil, Contains Less than 28 of the Following: Sugar, Yeast, Salt, Canola Oil (Releasing Agent), Pizza Sauce (Crushed Tomatoes (Water, Concentrated Crushed Tomatoes), Salt, Sugar, Dehydrated Onion, Spices, Citric Acid, Garlic Powder), Pasteurized Process Cheddar, Swiss and Provolone Cheese (Cultured Pasteurized Milk and Part-Skim Milk, Water, Salt, Sodium Phosphate, Milkfat, Contains Less than 0.5 Percent of Lactic Acid, Sorbic Acid (Preservative), Enzymes, Smoke Flavor), Low Moisture Part Skim Mozzarella (Pasteurized Part Skim Milk, Cheese Cultures, Salt, Enzymes), Pepperoni (Pork, Beef, Salt, Contains 28 or Less of Water, Paprika, Dextrose, Natural Spices, Smoke Flavoring, Lactic Acid Starter Culture, Sodium Ascorbate (Vitamin C), Flavoring, Garlic Powder, Sodium Nitrite, BHA, BHT, Citric Acid), Paroma Cheese (Parmesan and Romano Cheese (Pasteurized Cow's Milk, Cheese Culture, Salt, Enzymes)), Ground Oregano.",
                'allergens' => "Milk, Wheat, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 4,
                    'serving_fraction' => '1/4',
                    'serving_weight' => 0,
                    'calories' => 300,
                    'caloris_from_fat' => 0,
                    'total_fat' => 15,
                    'saturated_fat' => 8,
                    'trans_fat' => 0,
                    'cholesterol' => 40,
                    'sodium' => 860,
                    'total_carbohydrate' => 26,
                    'dietary_fiber' => 2,
                    'total_sugars' => 1,
                    'added_sugars' => 1,
                    'protein' => 13,
                    'vitamin_d' => 0,
                    'calcium' => 243,
                    'iron' => 2,
                    'potassium' => 205,
                ]
            ],
            [
                'name' => "Tomato Basic Garlic",
                'slug' => "tomato-basic-garlic",
                'tags' => ['st-louis-style', 'garlic', 'tomato', 'basil', 'vegetarian'],
                'description' => "Red-ripened tomatoes, fragrant basil, and freshly minced garlic are the defining qualities of this refreshing, all-natural pizza.",
                'image_url' => "https://target.scene7.com/is/image/Target/GUEST_f8a56ec3-2a3f-444c-9942-62fd3abc9328?wid=800&hei=800&qlt=80&fmt=webp",
                'ingredients' => "pizza crust (unbleached flour (wheat flour, malted barley flour, niacin, reduced iron, thiamine mononitrate, riboflavin, folic acid), water, soybean oil, contains less than 2% of the following: sugar, yeast, salt, canola oil (releasing agent), pasteurized process cheddar, swiss and provolone cheese (cultured pasteurized milk and part-skim milk, water, salt, sodium phosphate, milkfat, contains less than 0.5 percent of lactic acid, sorbic acid (preservative), enzymes, smoke flavor), low moisture part skim mozzarella (pasteurized part skim milk, cheese cultures, salt, enzymes), pizza sauce (crushed tomatoes (water, concentrated crushed tomatoes), salt, sugar, dehydrated onion, spices, citric acid, garlic powder) fresh tomatoes, paroma cheese (parmesan and romano cheese (pasteurized cow's milk, cheese culture, salt, enzymes)) olive oil, basil, garlic, sea salt, ground oregano.",
                'allergens' => "Milk, Wheat, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 4,
                    'serving_fraction' => '1/4',
                    'serving_weight' => 0,
                    'calories' => 240,
                    'caloris_from_fat' => 0,
                    'total_fat' => 9,
                    'saturated_fat' => 5,
                    'trans_fat' => 0,
                    'cholesterol' => 25,
                    'sodium' => 630,
                    'total_carbohydrate' => 27,
                    'dietary_fiber' => 2,
                    'total_sugars' => 2,
                    'added_sugars' => 1,
                    'protein' => 10,
                    'vitamin_d' => 0,
                    'calcium' => 251,
                    'iron' => 2,
                    'potassium' => 228,
                ]
            ],
            [
                'name' => "Pepperoni Pepperoncini",
                'slug' => "pepperoni-pepperoncini",
                'tags' => ['st-louis-style', 'pepperoni', 'peppers'],
                'description' => "Our classic Pepperoni Pizza but with a twist! We've added sweet, tangy pepperoncini peppers to create a delightfully mouth-watering combination.",
                'image_url' => 'https://s7d5.scene7.com/is/image/CentralMarket/008318512-1?hei=445&wid=445&$large$',
                'ingredients' => "Ingredients: Pizza Crust (Unbleached Flour (Wheat Flour, Malted Barley Flour, Niacin, Reduced Iron, Thiamine Mononitrate, Riboflavin, Folic Acid), Water, Soybean Oil, Contains Less than 2% of the Following: Sugar, Yeast, Salt, Canola Oil (Releasing Agent), Pizza Sauce (Crushed Tomatoes (Water, Concentrated Crushed Tomatoes), Salt, Sugar, Dehydrated Onion, Spices, Citric Acid, Garlic Powder), Dogtown Pizza Cheese [(Pizza Cheese (Pasteurized Process Cheddar, Swiss and Provolone Cheese) (Cultured Pasteurized Milk and Part Skim Milk, Water, Milkfat, Sodium Phosphate, Salt, Lactic Acid, Contains Less than 0.5% of Sorbic Acid as a Preservative, Enzymes, Smoke Flavor) Mozzarella Cheese (Pasteurized Part Skim Milk, Cheese Cultures, Salt, Enzymes)], Pepperoni (Pork, Beef, Salt, Contains 2% or Less of Water, Paprika, Dextrose, Natural Spices, Smoke Flavoring, Lactic Acid Starter Culture, Sodium Ascorbate (Vitamin C), Flavoring Garlic Powder, Sodium Nitrite, BHA, BHT, Citric Acid), Pepperoncini (Peppers, Water, Vinegar, Salt, Less than 1/10 of 1% Citric Acid, Turmeric Sodium Bisulfite as Preservatives), Paroma Cheese (Parmesan and Romano Cheese (Pasteurized Cow's Milk, Cheese Culture, Salt, Enzymes)), Ground Oregano.",
                'allergens' => "Milk, Wheat, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 4,
                    'serving_fraction' => '1/4',
                    'serving_weight' => 0,
                    'calories' => 290,
                    'caloris_from_fat' => 0,
                    'total_fat' => null,
                    'saturated_fat' => null,
                    'trans_fat' => null,
                    'cholesterol' => 40,
                    'sodium' => 910,
                    'total_carbohydrate' => null,
                    'dietary_fiber' => null,
                    'total_sugars' => null,
                    'added_sugars' => null,
                    'protein' => null,
                    'vitamin_d' => null,
                    'calcium' => 246,
                    'iron' => 2,
                    'potassium' => 201,
                ]
            ],
            [
                'name' => "Hot Chicken",
                'slug' => "hot-chicken",
                'tags' => ['st-louis-style', 'chicken', 'hot-sauce'],
                'description' => "A home run for two crowd-pleasing classics: pizza and hot wings in one spicy, delicious place.",
                'image_url' => "https://www.instacart.com/image-server/699x699/filters:fill(FFF,true):format(webp)/www.instacart.com/assets/domains/product-image/file/large_23825cb3-5551-4bc0-b225-ab1f2bd5853c.jpg",
                'ingredients' => "Pizza Crust (unbleached Flour (wheat Flour, Malted Barley Flour, Niacin, Reduced Iron, Thiamine Mononitrate, Riboflavin, Folic Acid) Water, Pure Soybean Oil, Yeast, Sugar, Salt). Hot Sauce (aged Cayenne Red Peppers, Soybean Oil, Water, Sugar, Distilled Vinegar, Lightly Salted Butter (cream, Salt), Salt, Mustard, Flour, Dehydrated Eggs, Modified Food Starch (corn), Xanthan Gum, Spice, Dehydrated Onion, Garlic Powder, Spice Extractives). Dogtown Pizza Cheese [(pizza Cheese (pasteurized Process Cheddar, Swiss And Provolone Cheese) (cultured Pasteurized Milk And Part Skim Milk, Water, Milkfat, Sodium Phosphate, Salt, Lactic Acid, Contains Less Than 0.5% Of Sorbic Acid As A Preservative, Enzymes, Smoke Flavor) Mozzarella Cheese (pasteurized Part Skim Milk, Cheese Cultures, Salt, Enzymes)]. Chicken Breast. Paroma Blend (parmesan And Romano Cheese (cow's Milk, Cheese Culture, Salt, Enzymes), Water, Milk Protein, Modified Food Starch, Salt, Dissodium Phosphate, Citric Acid, Guar Gum.), Olive Oil, Oregano.",
                'allergens' => "Milk, Wheat, Soy, Egg",
                'nutritional_facts' => [
                    'serving_per_container' => 4,
                    'serving_fraction' => '1/4',
                    'serving_weight' => 0,
                    'calories' => 300,
                    'caloris_from_fat' => 0,
                    'total_fat' => 14,
                    'saturated_fat' => 7,
                    'trans_fat' => 0,
                    'cholesterol' => 40,
                    'sodium' => 1560,
                    'total_carbohydrate' => 24,
                    'dietary_fiber' => 1,
                    'total_sugars' => 2,
                    'added_sugars' => null,
                    'protein' => 18,
                ]
            ],
            [
                'name' => "Cheese",
                'slug' => "cheese",
                'tags' => ['st-louis-style', 'cheese', 'vegetarian'],
                'description' => "Classic St. Louis-style pizza with our original 3-cheese blend. Creamy and tangy, never stringy.",
                'image_url' => "https://www.instacart.com/image-server/699x699/filters:fill(FFF,true):format(webp)/www.instacart.com/assets/domains/product-image/file/large_38ffbffa-8568-4d72-98a6-2e720116ba4f.jpg",
                'ingredients' => "Pizza Crust (unbleached Flour (wheat Flour, Malted Barley Flour, Niacin, Reduced Iron, Thiamine Mononitrate, Riboflavin, Folic Acid) Water, Pure Soybean Oil, Yeast, Sugar, Salt). Pizza Cheese ((pasteurized Process Cheddar, Swiss, And Provolone Cheese) Cultured Pasteurized Milk And Part Skim Milk, Water, Salt, Sodium Phosphate, Milkfat, Lactic Acid, Contains Less Than 0.5% Of Enzymes, Smoke Flavor). Pizza Sauce (crushed Tomatoes (water, Concentrated Crushed Tomatoes), Salt, Sugar, Dehydrated Onion, Spices, Citric Acid, Garlic Powder) Mozzarella Cheese (pasteurized Part Skim Milk, Cultures, Salt, Enzymes). Paroma Style (parmesan And Romano Cheese (cow's Milk, Cheese Culture, Salt, Enzymes), Water, Milk Protein, Modified Food Starch, Salt, Disodium Phosphate, Citric Acid, Guar Gum, Powdered Cellulose (anti-caking Agent).) Oregano.",
                'allergens' => "Milk, Wheat, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 3,
                    'serving_fraction' => '1/3',
                    'serving_weight' => 145,
                    'calories' => 330,
                    'caloris_from_fat' => 0,
                    'total_fat' => 14,
                    'saturated_fat' => 7,
                    'trans_fat' => 0,
                    'cholesterol' => 30,
                    'sodium' => 750,
                    'total_carbohydrate' => 31,
                    'dietary_fiber' => 2,
                    'total_sugars' => 3,
                    'added_sugars' => null,
                    'protein' => 20,
                ]
            ],
            [
                'name' => "Meatball Mozzarella",
                'slug' => "meatball-mozzarella",
                'tags' => ['st-louis-style', 'meatball', 'garlic', 'basil'],
                'description' => "Dogtown's St. Louis Style Meatball Mozzarella pizza is made with chunks of meatball, fresh cut basil, mozzarella cheese, and garlic infused parmesan/romano cheese.",
                'image_url' => 'https://s7d5.scene7.com/is/image/CentralMarket/014074011-1?hei=445&wid=445&$large$',
                'allergens' => "Milk, Wheat, Soy",
            ],
            [
                'name' => "Sausage & Pepperoni",
                'slug' => "sausage-pepperoni",
                'tags' => ['st-louis-style', 'pepperoni', 'sausage'],
                'description' => "This delectable combination of pepperoni and Italian salsiccia sausage delivers loads of mouthwatering flavor that your taste buds will do a little dance over. Great ingredients, well-prepared, and carefully assembled into a fun, quick, nutritious meal that you can take pride in baking for your family.",
                'image_url' => 'https://s7d5.scene7.com/is/image/CentralMarket/003282557-1?hei=445&wid=445&$large$',
                'ingredients' => "Pizza Crust (Unbleached Flour (Wheat Flour, Malted Barley Flour, Niacin, Reduced Iron, Thiamine Mononitrate, Riboflavin, Folic Acid), I Water, Soybean Oil Contains Less than 2% of the Following: Sugar, Yeast, Salt, Canola Oil (Releasing Agent) Pizza Sauce (Crushed Tomatoes (Water, Concentrated Crushed Tomatoes), Salt, Sugar, Dehydrated Onion Spices, Citric Acid, Garlic Powder) Pasteurized Process Cheddar, Swiss and Provolone Cheese (Cultured Pasteurized Milk and Part-Skim Milk, Water Salt, Sodium Phosphate, Milkfat, Contains Less than 0.6 Percent of Lactic Acid, Sorbic Acid (Preservative), Enzymes, Smoke Flavor) Low Moisture Part Skim Mozzarella (Pasteurized Fart Skim Milk, Cheese Cultures, Salt, Enzymes) Italian Sausage (Pork, Seasoning (Salt, Spices, Dextrose Dehydrated Garlic), Natural Flavorings) Pepperoni (Pork Beef, Salt, Contains 2% or Less of Water, Paprika, Dextrose, Natural Spices, Smoke Flavoring, Lactic Acid Starter Culture, Sodium Ascorbate (Vitamin C), Flavoring, Garlic Powder Sodium Nitrite, BHA, Ohs, Citric Acid) Verona Cheese (Parmesan and Romano Cheese (Pasteurized Cow's Milk, Cheese Culture, Salt, Enzymes)) Ground Oregano.",
                'allergens' => "Milk, Wheat, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 4,
                    'serving_fraction' => '1/4',
                    'serving_weight' => 0,
                    'calories' => 320,
                    'caloris_from_fat' => 0,
                    'total_fat' => null,
                    'saturated_fat' => null,
                    'trans_fat' => null,
                    'cholesterol' => 45,
                    'sodium' => 920,
                    'total_carbohydrate' => null,
                    'dietary_fiber' => null,
                    'total_sugars' => null,
                    'added_sugars' => null,
                    'protein' => null,
                    'vitamin_d' => null,
                    'calcium' => 249,
                    'iron' => 2,
                    'potassium' => 195,
                ]
            ],
            [
                'name' => "Veggie",
                'slug' => "veggie",
                'tags' => ['st-louis-style', 'vegetarian', 'peppers', 'onion', 'mushroom'],
                'description' => "Earthy mushrooms, sweet red onion, & crunchy bell peppers on our tangy sauce & creamy cheese will satisfy veggie lovers everywhere.",
                'image_url' => "https://www.instacart.com/image-server/699x699/filters:fill(FFF,true):format(webp)/www.instacart.com/assets/domains/product-image/file/large_de51b3ae-de25-44fe-bc13-b49e140e332b.jpg",
                'ingredients' => "Pizza Crust (unbleached Flour (wheat Flour, Malted Barley Flour, Niacin, Reduced Iron, Thiamine Mononitrate, Riboflavin, Folic Acid) Water, Pure Soybean Oil, Yeast, Sugar, Salt). Pizza Sauce (crushed Tomatoes (water, Concentrated Crushed Tomatoes), Salt, Sugar, Dehydrated Onion, Spices, Citric Acid, Garlic Powder.) Dogtown Pizza Cheese [(pizza Cheese (pasteurized Process Cheddar, Swiss And Provolone Cheese) (cultured Pasteurized Milk And Part Skim Milk, Water, Milkfat, Sodium Phosphate, Salt, Lactic Acid, Contains Less Than 0.5% Of Sorbic Acid As A Preservative, Enzymes, Smoke Flavor) Mozzarella Cheese (pasteurized Part Skim Milk, Cheese Cultures, Salt, Enzymes)]. Mushrooms, Bell Pepper, Onion. Paroma Cheese (parmesan And Romano Cheese (cow's Milk, Cheese Culture, Salt, Enzymes), Modified Food Starch, Water, Palm Oil Blend, Casein, Disodium Phosphate, Salt, Citric Acid, Xanthan Gum, And Trisodium Citrate.) Ground Oregano.",
                'allergens' => "Milk, Wheat, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 3,
                    'serving_fraction' => '1/3',
                    'serving_weight' => 161,
                    'calories' => 290,
                    'caloris_from_fat' => 0,
                    'total_fat' => 10,
                    'saturated_fat' => 5,
                    'trans_fat' => 0,
                    'cholesterol' => 25,
                    'sodium' => 650,
                    'total_carbohydrate' => 33,
                    'dietary_fiber' => 2,
                    'total_sugars' => 4,
                    'added_sugars' => null,
                    'protein' => 17,
                ]
            ],
        ];

        foreach ($pizzas as $pizza) {
            PizzaSeedHandler::seedPizza($brand, $pizza);
        }
    }
}

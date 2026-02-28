<?php

namespace Database\Seeders;

use App\Handlers\PizzaSeedHandler;
use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Handlers\ImageHandler;

class PepsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brand = Brand::updateOrCreate([
            'slug' => 'peps-pizza-co',
        ], [
            'name' => 'Peps Pizza Co.',
            'website' => 'https://pepspizzaco.com/',
            'brand_story' => "Brothers Joseph “Pep” Simek Sr. and Ron Simek bought the Tombstone Tavern in Medford, WI back in 1962. Adjacent to a cemetery, it was here in the bar’s 6’ x 6’ kitchen that the original frozen pizza – Tombstone Pizza – was born.That early success was the appetizer for Pep Simek’s main course; years later he reignited his love for pizza and founded a new venture – Pep’s Pizza.  His vast kitchen knowledge, use of the finest ingredients, and special sauce had his pizzas once again increasing in demand—throughout Wisconsin and beyond. Since Pep’s passing in 2013, his legacy lives on with pizza fanatics far and wide.  Pep’s Pizza Co. celebrates that devotion to premium quality pizzas day in and day out.",
            'founded_year' => '1962', // Approximately based on "28 years in" from website content
            'description' => "At Pep’s Pizza Co.™ we’re redefining the possibilities for your frozen pizza experience. For generations we’ve served you the delicious, crispy, cheesy goodness you and your crew count on. With handcrafted recipes, exceptional ingredients, and plenty of the highest-quality toppings, our pizzas are sure to put a little “Pep” into your at-home dining experience.",

        ]);

        if (!$brand->image) {
            $image = ImageHandler::createFromUrl(
                'https://pepspizzaco.com/wp-content/uploads/2023/06/pepspizzaco-logo.png',
                'public',
                'images/logos/frozen',
                'PepsPizzaCo'
            );
            $brand->image_id = $image->id;
            $brand->save();
        }


        $pizzas = [
            [
                'name' => "Legit™ Three Meat",
                'slug' => "legit-three-meat",
                'tags' => ['meat-lovers', 'sausage', 'pepperoni', 'ham', 'thin-crust', 'tavern-style'],
                'description' => "This is Legit™ Three Meat: Stone-baked, crispy, tavern-style crust, Parlor tomato sauce, whole milk mozzarella, spicy Italian sausage, cup & char pepperoni, savory ham, Parmesan, and special spice topping.",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2024/01/box-three-meat.png",
                'ingredients' => "Crust (wheat flour, water, palm oil, natural flavor, colored with beta carotene, salt, yeast, natural flavor, soy lecithin), Sauce (tomato puree, water, tomato paste, seasoning [salt, sugar, spices]), Extra virgin olive oil, Low moisture mozzarella cheese (pasteurized milk, salt, cheese cultures, enzymes), Powdered cellulose (to prevent caking), Cooked spicy Italian sausage (pork, water, spices, salt, corn syrup solids, paprika, granulated garlic, sugar, lemon juice powder), Pepperoni (pork, beef, salt, contains 2% or less of dextrose, spices, lactic acid starter culture, sodium ascorbate, oleoresin of paprika, garlic powder), Ham (water added, sugar, sodium phosphate, sodium diacetate, sodium erythorbate, sodium nitrite [preservative], less than 2% of Parmesan cheese [pasteurized cow's milk, cheese cultures, salt, enzymes], Oregano).",
                'allergens' => "Milk, Wheat, Soy.",
                'nutritional_facts' => [
                    'serving_per_container' => 4,
                    'serving_fraction' => '1/4',
                    'serving_weight' => 135,
                    'calories' => 340,
                    'caloris_from_fat' => 0,
                    'total_fat' => 19,
                    'saturated_fat' => 10,
                    'trans_fat' => 0,
                    'cholesterol' => 50,
                    'sodium' => 1000,
                    'total_carbohydrate' => 22,
                    'dietary_fiber' => 2,
                    'total_sugars' => 5,
                    'added_sugars' => 1,
                    'protein' => 16,
                    'vitamin_d' => 1,
                    'calcium' => 243,
                    'iron' => 1,
                    'potassium' => 341,
                ]
            ],
            [
                'name' => "Legit™ Sausage & Pepperoni",
                'slug' => "legit-sausage-pepperoni",
                'tags' => ['meat-lovers', 'sausage', 'pepperoni', 'thin-crust', 'tavern-style'],
                'description' => "This is Legit™ Sausage & Pepperoni: Stone-baked, crispy, tavern-style crust, Parlor tomato sauce, whole milk mozzarella, spicy Italian sausage, cup & char pepperoni, and Parmesan.",
                'ingredients' => "Crust (wheat flour, water, palm oil, natural flavor, colored with beta carotene, salt, yeast, natural flavor, soy lecithin), Sauce (tomato puree, water, tomato paste, seasoning [salt, sugar, spices]), Extra virgin olive oil, Low moisture mozzarella cheese (pasteurized milk, salt, cheese cultures, enzymes), Powdered cellulose (to prevent caking), Cooked spicy Italian sausage (pork, water, spices, salt, corn syrup solids, granulated garlic, sugar, lemon juice powder), Pepperoni (pork, beef, salt, contains 2% or less of dextrose, spices, lactic acid starter culture, sodium ascorbate, oleoresin of paprika, garlic powder), Less than 2% of Parmesan cheese (pasteurized cow's milk, cheese cultures, salt, enzymes), Oregano.",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2024/01/box-sausage-pepperoni.png",
                'allergens' => "Milk, Wheat, Soy.",
                'nutritional_facts' => [
                    'serving_per_container' => 4,
                    'serving_fraction' => '1/4',
                    'serving_weight' => 129,
                    'calories' => 340,
                    'caloris_from_fat' => 0,
                    'total_fat' => 19,
                    'saturated_fat' => 11,
                    'trans_fat' => 0,
                    'cholesterol' => 50,
                    'sodium' => 940,
                    'total_carbohydrate' => 22,
                    'dietary_fiber' => 2,
                    'total_sugars' => 4,
                    'added_sugars' => 1,
                    'protein' => 16,
                    'vitamin_d' => 0,
                    'calcium' => 242,
                    'iron' => 1,
                    'potassium' => 305,
                ]
            ],
            [
                'name' => "Legit™ Supreme",
                'slug' => "legit-supreme",
                'tags' => ['sausage', 'pepperoni', 'thin-crust', 'mushroom', 'supreme', 'tavern-style'],
                'description' => "This is Legit™ Supreme: Stone-baked, crispy, tavern-style crust, Parlor tomato sauce, whole-milk mozzarella from Wisconsin, cup & char pepperoni, Chicago-made Italian sausage, mushrooms, onions, peppers, black olives, parmesan, and our special spice topping.",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2024/01/legit-supreme-box.png",
                'ingredients' => "Crust (wheat flour, water, palm oil, natural flavor, beta carotene (color), salt, yeast, natural flavor, soy lecithin), Sauce (tomato puree, water, tomato paste, seasoning [salt, sugar, spices]), Extra virgin olive oil, Low moisture whole milk mozzarella cheese (pasteurized milk, cheese cultures, salt, enzymes), Pepperoni (pork, beef, salt, contains 2% or less of dextrose, spices, lactic acid starter culture, sodium ascorbate, oleoresin of paprika, garlic powder, sodium nitrite (preservative), BHA (to protect flavor), BHT (to protect flavor), citric acid (to protect flavor)), Parmesan cheese (pasteurized cow's milk, cheese cultures, salt, enzymes), Powdered cellulose (to prevent caking), Spice. Contains: milk, wheat, soy.",
                'allergens' => "Milk, Wheat, Soy.",
                'nutritional_facts' => [
                    'serving_per_container' => 4,
                    'serving_fraction' => '1/4',
                    'serving_weight' => 125,
                    'caloris_from_fat' => 0,
                    'calories' => 330,
                    'total_fat' => 20,
                    'saturated_fat' => 10,
                    'trans_fat' => 0.5,
                    'cholesterol' => 45,
                    'sodium' => 900,
                    'total_carbohydrate' => 23,
                    'dietary_fiber' => 2,
                    'total_sugars' => 3,
                    'added_sugars' => 1,
                    'protein' => 15,
                    'vitamin_d' => 0.2,
                    'calcium' => 240,
                    'iron' => 0.9,
                    'potassium' => 300,
                ]
            ],
            [
                'name' => "Legit™ Pepperoni",
                'slug' => "legit-pepperoni",
                'tags' => ['pepperoni', 'thin-crust', 'tavern-style'],
                'description' => "This is Legit™ Pepperoni: Stone-baked, crispy, tavern-style crust, Parlor tomato sauce, whole-milk mozzarella from Wisconsin, sizzling cup & char pepperoni, parmesan, and our special spice topping.",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2024/01/legit-pepperoni-box.png",
                'ingredients' => "Crust (wheat flour, water, palm oil, natural flavor, beta carotene (color), salt, yeast, natural flavor, soy lecithin), Sauce (tomato puree, water, tomato paste, seasoning [salt, sugar, spices]), Extra virgin olive oil, Low moisture whole milk mozzarella cheese (pasteurized milk, cheese cultures, salt, enzymes), Pepperoni (pork, beef, salt, contains 2% or less of dextrose, spices, lactic acid starter culture, sodium ascorbate, oleoresin of paprika, garlic powder, sodium nitrite (preservative), BHA (to protect flavor), BHT (to protect flavor), citric acid (to protect flavor)), Parmesan cheese (pasteurized cow's milk, cheese cultures, salt, enzymes), Powdered cellulose (to prevent caking), Spice. Contains: milk, wheat, soy.",
                'allergens' => "Milk, Wheat, Soy.",
                'nutritional_facts' => [
                    'serving_per_container' => 4,
                    'serving_fraction' => '1/4',
                    'serving_weight' => 125,
                    'caloris_from_fat' => 0,
                    'calories' => 330,
                    'total_fat' => 20,
                    'saturated_fat' => 10,
                    'trans_fat' => 0.5,
                    'cholesterol' => 45,
                    'sodium' => 900,
                    'total_carbohydrate' => 23,
                    'dietary_fiber' => 2,
                    'total_sugars' => 3,
                    'added_sugars' => 1,
                    'protein' => 15,
                    'vitamin_d' => 0.2,
                    'calcium' => 240,
                    'iron' => 0.9,
                    'potassium' => 300,
                ]
            ],
            [
                'name' => "Legit™ Three Cheese",
                'slug' => "legit-three-cheese",
                'tags' => ['three-cheese', 'thin-crust', 'tavern-style'],
                'description' => "This is Legit™ Three Cheese: Stone-baked, crispy, tavern-style crust, Parlor tomato sauce, whole-milk mozzarella, Wisconsin Fontina cheese, delicate parmesan, and our special spice topping.",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2024/01/legit-three-cheese-box.png",
                'ingredients' => "Crust (wheat flour, water, palm oil, natural flavor, soy lecithin), Sauce (tomato puree, water, tomato paste, seasoning [salt, sugar, spices]), Low moisture whole milk mozzarella cheese (pasteurized milk, cheese cultures, salt, enzymes), Fontina cheese (pasteurized milk, cheese cultures, salt, enzymes), Parmesan cheese (pasteurized cow's milk, cheese cultures, salt, enzymes), Powdered cellulose (to prevent caking), Spice.",
                'allergens' => "Milk, Wheat, Soy.",
                'nutritional_facts' => [
                    'serving_per_container' => 4,
                    'serving_fraction' => '1/4',
                    'serving_weight' => 125,
                    'caloris_from_fat' => 0,
                    'calories' => 310,
                    'total_fat' => 18,
                    'saturated_fat' => 11,
                    'trans_fat' => 0.5,
                    'cholesterol' => 45,
                    'sodium' => 750,
                    'total_carbohydrate' => 23,
                    'dietary_fiber' => 2,
                    'total_sugars' => 3,
                    'added_sugars' => 1,
                    'protein' => 15,
                    'vitamin_d' => 0.2,
                    'calcium' => 340,
                    'iron' => 0.7,
                    'potassium' => 270,                ]
            ],
            [
                'name' => "Legit™ Sausage & Mushroom",
                'slug' => "legit-sausage-mushroom",
                'tags' => ['sausage', 'mushroom', 'thin-crust', 'tavern-style'],
                'description' => "This is Legit™ Sausage & Mushroom: Stone-baked, crispy, tavern-style crust, Parlor tomato sauce, whole-milk mozzarella from Wisconsin, Chicago-made Italian sausage, sliced mushrooms, parmesan, and our special spice topping.",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2024/01/legit-sausage-mushroom-box.png",
                'ingredients' => "Crust (wheat flour, water, palm oil, natural flavor, beta carotene {color}, salt, yeast, natural flavor, soy lecithin), Low moisture whole milk mozzarella cheese (pasteurized milk, cheese cultures, salt, enzymes), Sauce (tomato puree, water, tomato paste, seasoning [salt, sugar, spices], extra virgin olive oil), Italian sausage (pork, water, spices, salt, corn syrup solids, paprika, granulated garlic, sugar, lemon juice powder [corn syrup solids, lemon juice solids, lemon oil, BHA (to protect flavor), BHT (to protect flavor), citric acid (to protect flavor)]), Mushrooms, Parmesan cheese (pasteurized cow's milk, cheese cultures, salt, enzymes), Powdered cellulose (to prevent caking), Spice. Contains: milk, wheat, soy.",
                'allergens' => "Milk, Wheat, Soy.",
                'nutritional_facts' => [
                    'serving_per_container' => 4,
                    'serving_fraction' => '1/4',
                    'serving_weight' => 125,
                    'caloris_from_fat' => 0,
                    'calories' => 290,
                    'total_fat' => 18,
                    'saturated_fat' => 9,
                    'trans_fat' => 0,
                    'cholesterol' => 40,
                    'sodium' => 730,
                    'total_carbohydrate' => 20,
                    'dietary_fiber' => 2,
                    'total_sugars' => 3,
                    'added_sugars' => 1,
                    'protein' => 14,
                    'vitamin_d' => 0.2,
                    'calcium' => 210,
                    'iron' => 0.8,
                    'potassium' => 320,
                ]
            ],
            [
                'name' => "Drafthaus Five Meat Mash",
                'slug' => "drafthaus-five-meat-mash",
                'tags' => ['meat-lovers', 'hand-tossed', 'bacon', 'pepperoni', 'ham', 'sausage'],
                'description' => "Original 12” Thick Crust Pizza Loaded 1 lb. 13 oz. (29 oz., 822 g) Looking for a true meat lover’s feast? This one has it all. The Five Meat Mash Pizza is LOADED to the max. We start with generous pieces of sweet Italian sausage, adding spicy sausage, pepperoni, ham and (everyone’s favorite) bacon, layered under 100% Real Wisconsin whole milk mozzarella cheese. Then we add a touch of provolone, plus several of our always FRESH Wisconsin mozzarella cheese slices and, finally, sprinkled with savory Italian seasoning. All on our signature hand-tossed crust and Pep’s Secret Recipe Sauce. The Five Meat Mash packs a serious punch with every delicious bite!",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2023/07/5-Meat-Mash-large.jpg",
                'ingredients' => "Crust (enriched wheat flour, niacin, iron, thiamine, mononitrate, riboflavin, folic acid, enzyme, ascorbic acid, water, soybean oil, yeast, bread crumbs wheat flour, yeast, sugar, salt, olive oil, sugar, salt, cultured wheat starch, honey, sodium bicarbonate, sodium aluminum phosphate, L-cysteine, citric acid, soy lecithin), Low moisture mozzarella cheese (pasteurized milk, salt, cheese cultures, enzymes), Sauce (tomato puree, tomato paste, seasoning [salt, spices], dehydrated garlic, soybean), Cooked Italian sausage (pork, spices, water, salt, corn syrup solids, flavoring, disodium phosphate, BHA to protect flavor), Sliced mozzarella cheese (pasteurized milk, vinegar, enzymes, salt), Pepperoni (pork, beef, salt, spices, dextrose, lactic acid starter culture, oleoresin of paprika, sodium ascorbate, sodium nitrite, BHA, BHT, citric acid), Cooked spicy Italian sausage (pork, spices, water, salt, corn syrup solids, flavoring, disodium phosphate, sodium erythorbate, sodium nitrite, preservatives), Bacon (cured with water added [cured with sodium nitrite]), Provolone cheese (provolone cheese [pasteurized milk, salt, enzymes], powdered cellulose to prevent caking). Contains: milk, wheat, soy.",
                'allergens' => "Milk, Wheat, Soy.",
                'nutritional_facts' => [
                    'serving_per_container' => 6,
                    'serving_fraction' => '1/6',
                    'serving_weight' => 144,
                    'caloris_from_fat' => 0,
                    'calories' => 350,
                    'total_fat' => 19,
                    'saturated_fat' => 9,
                    'trans_fat' => 0,
                    'cholesterol' => 50,
                    'sodium' => 920,
                    'total_carbohydrate' => 29,
                    'dietary_fiber' => 2,
                    'total_sugars' => 3,
                    'added_sugars' => 1,
                    'protein' => 17,
                    'vitamin_d' => 0.7,
                    'calcium' => 230,
                    'iron' => 2.3,
                    'potassium' => 310,
                ]
            ],
            [
                'name' => "Drafthaus Prohibition Special",
                'slug' => "drafthaus-prohibition-special",
                'tags' => ['hand-tossed', 'bacon', 'pepperoni', 'mushroom'],
                'description' => "12” Thick Crust Pizza Loaded 1 lb. 14.1 oz. (30.1 oz., 853 g) There’s no legal age required to enjoy The Prohibition Special Pizza, our most popular and best-selling pizza. The foundation starts with the perfect combination of sweet Italian sausage and a second slightly spicier sausage. Then we add generous amounts of pepperoni, mushrooms, peppers (red, green, and yellow), and just the right amount of red onions. Topped off with real Wisconsin shredded mozzarella cheese and sprinkled with fresh Italian seasoning, this Special’s beloved by all bootleggers.",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2023/07/Prohibition-2.jpg",
                'ingredients' => "Crust (enriched wheat flour, niacin, iron, thiamine, mononitrate, riboflavin, folic acid, enzyme, ascorbic acid, water, soybean oil, yeast, bread crumbs wheat flour, yeast, sugar, salt, olive oil, sugar, cultured wheat starch, honey, sodium bicarbonate, sodium aluminum phosphate, L-cysteine, citric acid, soy lecithin), Low moisture mozzarella cheese (pasteurized milk, salt, cheese cultures, enzymes), Sauce (tomato puree, water, tomato paste, seasoning [salt, spices], dehydrated garlic, soybean oil), Cooked Italian sausage (pork, water, salt, spices, dextrose, corn syrup solids, paprika, flavoring, disodium guanylate, BHA to protect flavor), Pepperoni (pork, beef, salt, spices, dextrose, lactic acid starter culture, oleoresin of paprika, flavoring, sodium ascorbate, sodium nitrite, BHA, BHT and citric acid), Cooked spicy Italian sausage (pork, spices, water, salt, corn syrup solids, flavoring, disodium phosphate), Contains less than 2% of yellow bell peppers, green bell peppers, red onion, red pepper, spice.",
                'allergens' => "Milk, Wheat, Soy.",
                'nutritional_facts' => [
                    'serving_per_container' => 6,
                    'serving_fraction' => '1/6',
                    'serving_weight' => 149,
                    'caloris_from_fat' => 0,
                    'calories' => 330,
                    'total_fat' => 17,
                    'saturated_fat' => 8,
                    'trans_fat' => 0,
                    'cholesterol' => 45,
                    'sodium' => 820,
                    'total_carbohydrate' => 29,
                    'dietary_fiber' => 2,
                    'total_sugars' => 3,
                    'added_sugars' => 1,
                    'protein' => 15,
                    'vitamin_d' => 0.5,
                    'calcium' => 220,
                    'iron' => 2.3,
                    'potassium' => 310,                ]
            ],
            [
                'name' => "Drafthaus Taproom Double",
                'slug' => "drafthaus-taproom-double",
                'tags' => ['hand-tossed', 'meat-lovers', 'pepperoni', 'sausage'],
                'description' => "12” Thick Crust Pizza Loaded 1 lb. 12.8 oz. (28.8 oz., 816 g) The only thing better than a single in the taproom is a double. With DOUBLE the sausage and DOUBLE the pepperoni of other pizzas, it’s easy to see why this one is a fan favorite. Sweet Italian sausage balances with traditional spicy sausage, complemented by generous amounts of sliced pepperoni and extra diced pepperoni. The result is a sausage and pepperoni lover’s dream in every single bite! Topped off with real Wisconsin shredded mozzarella cheese, provolone cheese, our signature FRESH Wisconsin mozzarella cheese slices, and then sprinkled with savory Italian seasoning. This is your way to double down on your pizza experience.",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2023/07/Taproom-Dbl.jpg",
                'ingredients' => "Crust (enriched wheat flour, niacin, iron, thiamine, mononitrate, riboflavin, folic acid, enzyme, ascorbic acid, water, soybean oil, yeast, bread crumbs (wheat flour, yeast, sugar, salt), olive oil, sugar, salt, cultured wheat starch, honey, sodium bicarbonate, sodium aluminum phosphate, L-cysteine, citric acid, soy lecithin), Low moisture mozzarella cheese (pasteurized milk, salt, cheese cultures, enzymes), Sauce (tomato puree, water, tomato paste, seasoning [salt, spices, dehydrated garlic, soybean oil]), Cooked Italian sausage (pork, water, salt, spices, dextrose, lactic acid starter culture, oleoresin of paprika, flavoring, sodium ascorbate, sodium nitrite, BHA to protect flavor), Pepperoni (pork, beef, salt, spices, dextrose, lactic acid starter culture, oleoresin of paprika, flavoring, sodium ascorbate, sodium nitrite, BHA, BHT and citric acid), Cooked spicy Italian sausage (pork, spices, water, salt, corn syrup solids, flavoring, disodium phosphate), Contains less than 2% of provolone cheese (cultured pasteurized milk, salt, enzymes), spice. Contains: milk, wheat, soy.",
                'allergens' => "Milk, Wheat, Soy.",
                'nutritional_facts' => [
                    'serving_per_container' => 6,
                    'serving_fraction' => '1/6',
                    'serving_weight' => 143,
                    'caloris_from_fat' => 0,
                    'calories' => 360,
                    'total_fat' => 20,
                    'saturated_fat' => 9,
                    'trans_fat' => 0,
                    'cholesterol' => 55,
                    'sodium' => 910,
                    'total_carbohydrate' => 28,
                    'dietary_fiber' => 2,
                    'total_sugars' => 3,
                    'added_sugars' => 1,
                    'protein' => 17,
                    'vitamin_d' => 0.2,
                    'calcium' => 240,
                    'iron' => 2.4,
                    'potassium' => 300,
                ]
            ],
            [
                'name' => "Drafthaus Sausage Chaser",
                'slug' => "drafthaus-sausage-chaser",
                'tags' => ['hand-tossed', 'sausage', 'mushroom'],
                'description' => "12” Thick Crust Pizza Loaded 1 lb. 13.3 oz. (29.3 oz., 830 g) For the love of sausage! This savory pizza delicately blends sweet Italian sausage with a spicy sausage chaser in every bite. Just the right amount of mushrooms and red onions are combined with nearly a half-pound of real Wisconsin shredded mozzarella, generous provolone, and fresh Italian seasoning for a true pizza masterpiece.",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2023/07/Sausage-Chaser.jpg",
                'ingredients' => "Crust (enriched wheat flour, niacin, iron, thiamine, mononitrate, riboflavin, folic acid, enzyme, ascorbic acid, water, soybean oil, yeast, bread crumbs [wheat flour, yeast, sugar, salt], olive oil, sugar, salt, cultured wheat starch, honey, sodium bicarbonate, sodium aluminum phosphate, L-cysteine, citric acid, soy lecithin), Low moisture mozzarella cheese (pasteurized milk, salt, cheese cultures, enzymes), Sauce (tomato puree, water, tomato paste, seasoning [salt, spices, dehydrated garlic, soybean oil]), Cooked Italian sausage (pork, water, salt, spices, corn syrup solids, paprika, flavoring, disodium inosinate, disodium guanylate, BHA, BHT), Mushrooms (mushrooms, water), Red onion, Cooked spicy Italian sausage (pork, spices, water, salt, corn syrup solids, flavoring, paprika, sodium phosphates), Contains less than 2% of provolone cheese (cultured pasteurized milk, salt, enzymes), Spice. Contains: milk, wheat, soy.",
                'allergens' => "Milk, Wheat, Soy.",
                'nutritional_facts' => [
                    'serving_per_container' => 6,
                    'serving_fraction' => '1/6',
                    'serving_weight' => 146,
                    'caloris_from_fat' => 0,
                    'calories' => 310,
                    'total_fat' => 16,
                    'saturated_fat' => 7,
                    'trans_fat' => 0,
                    'cholesterol' => 45,
                    'sodium' => 770,
                    'total_carbohydrate' => 29,
                    'dietary_fiber' => 2,
                    'total_sugars' => 3,
                    'added_sugars' => 1,
                    'protein' => 15,
                    'vitamin_d' => 0.2,
                    'calcium' => 230,
                    'iron' => 2.3,
                    'potassium' => 300,
                ]
            ],
            [
                'name' => "Drafthaus Double Pepperoni Doppelbock",
                'slug' => "drafthaus-double-pepperoni-doppelbock",
                'tags' => ['hand-tossed', 'pepperoni',],
                'description' => "12” Thick Crust Pizza Loaded 1 lb. 9.9 oz. (25.9 oz., 734 g) Calling all pepperoni lovers: this one has your name ALL over it! Real Wisconsin shredded mozzarella cheese covers a DOUBLE LAYER of sliced and diced pepperoni from edge to edge. Topped with our signature FRESH Wisconsin mozzarella cheese slices and sprinkled with fresh Italian seasoning, this is your ticket to pepperoni paradise.",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2023/08/Dbl-Pep-Doppel.jpg",
                'ingredients' => "Crust (enriched wheat flour, niacin, iron, thiamine, mononitrate, riboflavin, folic acid, enzyme, ascorbic acid, water, soybean oil, yeast, bread crumbs [wheat flour, yeast, sugar, salt], olive oil, sugar, salt, cultured wheat starch, honey, sodium bicarbonate, sodium aluminum phosphate, L-cysteine, citric acid, soy lecithin), Low moisture mozzarella cheese (pasteurized milk, salt, cheese cultures, enzymes), Sauce (tomato puree, water, tomato paste, seasoning [salt, spices, dehydrated garlic, soybean oil]), Pepperoni (pork, beef, salt, spices, dextrose, lactic acid starter culture, oleoresin of paprika, flavoring, sodium ascorbate, sodium nitrite, BHA, and BHT), Sliced mozzarella cheese (pasteurized milk, vinegar, enzymes, salt), Pepperoni (pork, beef, salt, spices, dextrose, lactic acid starter culture, natural spice flavorings, spice extractives, garlic powder, sodium erythorbate, sodium nitrite, BHA, and BHT). Contains: milk, wheat, soy.",
                'allergens' => "Milk, Wheat, Soy.",
                'nutritional_facts' => [
                    'serving_per_container' => 6,
                    'serving_fraction' => '1/6',
                    'serving_weight' => 129,
                    'caloris_from_fat' => 0,
                    'calories' => 320,
                    'total_fat' => 17,
                    'saturated_fat' => 8,
                    'trans_fat' => 0,
                    'cholesterol' => 45,
                    'sodium' => 830,
                    'total_carbohydrate' => 28,
                    'dietary_fiber' => 2,
                    'total_sugars' => 3,
                    'added_sugars' => 1,
                    'protein' => 15,
                    'vitamin_d' => 0,
                    'calcium' => 230,
                    'iron' => 2.2,
                    'potassium' => 260,                ]
            ],
            [
                'name' => "Drafthaus Brawlin' Buffalo Chicken",
                'slug' => "drafthaus-brawlin-buffalo-chicken",
                'tags' => ['hand-tossed', 'chicken', 'buffalo', 'gorgonzola'],
                'description' => "12” Thick Crust Pizza Loaded 1 lb. 9.8 oz. (25.8 oz., 731 g) Ready to kick it up a notch? This pizza packs generous bites of tender chicken drenched in spicy buffalo sauce, balanced with just the right amount of Wisconsin’s best shredded mozzarella cheese, gorgonzola (that’s right, gorgonzola!) cheese, topped off with several or our signature FRESH Wisconsin mozzarella cheese slices and sprinkled with fresh Italian seasoning. The perfect combination, delivering a knockout punch you won’t be able (or want) to resist!",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2023/07/Buffalo-Chicken.jpg",
                'ingredients' => "CRUST (ENRICHED WHEAT FLOUR [FLOUR, NIACIN, IRON, THIAMINE,
MONONITRATE, RIBOFLAVIN, FOLIC ACID, ENZYME, ASCORBIC ACID], WATER, SOYBEAN OIL,
YEAST, BREAD CRUMBS [WHEAT FLOUR, YEAST, SUGAR, SALT], OLIVE OIL, SUGAR, SALT,
CULTURED WHEAT STARCH, HONEY, SODIUM BICARBONATE, SODIUM ALUMINUM PHOSPHATE,
L-CYSTEINE, CITRIC ACID, SOY LECITHIN), LOW MOISTURE MOZZARELLA CHEESE (LOW
MOISTURE MOZZARELLA CHEESE [PASTEURIZED MILK, SALT, CHEESE CULTURES, ENZYMES]),
CHICKEN STRIPS (CHICKEN, WATER, POTATO STARCH, SALT, ROSEMARY EXTRACT), BUFFALO
STYLE SAUCE (ALFREDO SAUCE [CREAM, SKIM MILK, WATER, PARMESAN AND ASIAGO CHEESE
BLEND WITH FLAVOR {PARMESAN AND ASIAGO CHEESES [CULTURED MILK, SALT, ENZYMES],
FLAVOR [ENZYME MODIFIED PARMESAN CHEESE {CULTURED MILK, WATER, SALT, ENZYMES}],
WHEY, SALT}, SOYBEAN OIL, CANOLA OIL, 2% OR LESS OF MODIFIED CORNSTARCH, SALT,
ROMANO CHEESE {PASTEURIZED COW'S MILK, CHEESE CULTURE, SALT, ENZYMES}, CREAM
{CREAM, NONFAT MILK}, LACTOSE, DATEM, MONO AND DIGLYCERIDES, SPICE, XANTHAN GUM,
SEASONING {CORN STARCH, EXTRACTS OF TURMERIC AND ANNATTO [COLOR], NATURAL
FLAVOR}, SEASONING {MALTODEXTRIN, FLAVOR, ENZYME MODIFIED BUTTERFAT}], WING SAUCE
[WATER, AGED RED CAYENNE PEPPER, DISTILLED VINEGAR, SALT, CONTAINS LESS THAN 2% OF
SOYBEAN OIL, XANTHAN GUM, DEHYDRATED GARLIC, NATURAL FLAVORS, SPICE], CAYENNE
PEPPER SAUCE [AGED CAYENNE RED PEPPERS, DISTILLED VINEGAR, WATER, SALT, GARLIC
POWDER]), SLICED MOZZARELLA CHEESE (MOZZARELLA CHEESE [PASTEURIZED MILK,
VINEGAR, ENZYMES, SALT]), GORGONZOLA CHEESE (GORGONZOLA CHEESE [PASTEURIZED
WHOLE MILK, SALT, CHEESE CULTURES, ENZYMES, SELECT PENICILLIUM ROQUEFORTII],
POWDERED CELLULOSE [TO PREVENT CAKING]), CONTAINS LESS THAN 2% OF SPICE.",
                'allergens' => "Milk, Wheat, Soy.",
                'nutritional_facts' => [
                    'serving_per_container' => 6,
                    'serving_fraction' => '1/6',
                    'serving_weight' => 127,
                    'caloris_from_fat' => 0,
                    'calories' => 300,
                    'total_fat' => 14,
                    'saturated_fat' => 7,
                    'trans_fat' => 0,
                    'cholesterol' => 50,
                    'sodium' => 920,
                    'total_carbohydrate' => 26,
                    'dietary_fiber' => 1,
                    'total_sugars' => 1,
                    'added_sugars' => 1,
                    'protein' => 16,
                    'vitamin_d' => 0,
                    'calcium' => 236,
                    'iron' => 2,
                    'potassium' => 151,
                ]
            ],
            [
                'name' => "Drafthaus Chicken Bacon Ranch Mixer",
                'slug' => "drafthaus-chicken-bacon-ranch-mixer",
                'tags' => ['hand-tossed', 'chicken', 'bacon', 'ranch'],
                'description' => "12” Thick Crust Pizza Loaded 1 lb. 10.3 oz. (26.3 oz., 745 g) Nothing beats a perfect mix! Generous bites of tender chicken blended with ranch dressing, combined with just under a half-pound of real Wisconsin shredded mozzarella cheese and our signature FRESH Wisconsin mozzarella cheese slices. Just the right amount of bacon, shredded parmesan cheese, and fresh Italian seasoning and you have the ultimate CBR combo!",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2023/07/Chicken-Bacon-Ranch.jpg",
                'ingredients' => "CRUST (ENRICHED WHEAT FLOUR [FLOUR, NIACIN, IRON,
THIAMINE, MONONITRATE, RIBOFLAVIN, FOLIC ACID, ENZYME, ASCORBIC
ACID], WATER, SOYBEAN OIL, YEAST, BREAD CRUMBS [WHEAT FLOUR, YEAST,
SUGAR, SALT], OLIVE OIL, SUGAR, SALT, CULTURED WHEAT STARCH, HONEY,
SODIUM BICARBONATE, SODIUM ALUMINUM PHOSPHATE, L-CYSTEINE, CITRIC
ACID, SOY LECITHIN), LOW MOISTURE MOZZARELLA CHEESE (LOW MOISTURE
MOZZARELLA CHEESE [PASTEURIZED MILK, SALT, CHEESE CULTURES,
ENZYMES]), WHITE MEAT CHICKEN STRIPS (WHITE MEAT CHICKEN, WATER.
SALT, CONTAINS 2% OR LESS OF DEXTROSE, GARLIC POWDER, MODIFIED
WHEAT STARCH, DEHYDRATED ONION, SODIUM PHOSPHATES, TAPIOCA
DEXTRIN, SPICES [INCLUDING CELERY SEED], DEHYDRATED GARLIC, GRILL
FLAVOR [FROM SUNFLOWER OIL]), RANCH DRESSING (SOYBEAN OIL,
BUTTERMILK [CULTURED LOW-FAT MILK, NONFAT MILK, SALT, VITAMIN A
PALMITATE], EGG YOLKS, DISTILLED VINEGAR, WATER, SUGAR, SALT,
DEHYDRATED ONION, DEHYDRATED GARLIC, DEHYDRATED PARSLEY, SPICES,
XANTHAN GUM), SLICED MOZZARELLA CHEESE (MOZZARELLA CHEESE
[PASTEURIZED MILK, VINEGAR, ENZYMES, SALT]), COOKED BACON CRUMBLES
(CURED WITH WATER, SALT, SUGAR, SMOKE FLAVORING, SODIUM PHOSPHATES,
SODIUM ERYTHROBATE AND/OR SODIUM ASCORBATE, SODIUM NITRATE),
CONTAINS LESS THAN 2% OF PARMESAN CHEESE (PARMESAN CHEESE
[PASTEURIZED PART-SKIM COW'S MILK, CHEESE CULTURES, SALT, ENZYMES],
POWDERED CELLULOSE [TO PREVENT CAKING]), SPICE. ",
                'allergens' => "Milk, Wheat, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 6,
                    'serving_fraction' => '1/6',
                    'serving_weight' => 129,
                    'caloris_from_fat' => 0,
                    'calories' => 370,
                    'total_fat' => 22,
                    'saturated_fat' => 8,
                    'trans_fat' => 0,
                    'cholesterol' => 55,
                    'sodium' => 870,
                    'total_carbohydrate' => 26,
                    'dietary_fiber' => 1,
                    'total_sugars' => 2,
                    'added_sugars' => 1,
                    'protein' => 17,
                    'vitamin_d' => 0.2,
                    'calcium' => 230,
                    'iron' => 2,
                    'potassium' => 150,
                ]
            ],
            [
                'name' => "Drafthaus Five Cheese Growler",
                'slug' => "drafthaus-five-cheese-growler",
                'tags' => ['hand-tossed', 'cheese-lovers','parmesan', 'asiago', 'fontina', 'romano'],
                'description' => "12” Thick Crust Pizza Loaded 1 lb. 8.8 oz. (24.8 oz., 703 g) Are you ready for a new favorite cheese pizza? The Five Cheese Growler Pizza strikes the perfect balance and combination, starting with nearly a half-pound of real Wisconsin shredded mozzarella cheese before we add fontina, asiago, Romano, and parmesan cheeses to the mix! Finally, we add our signature FRESH Wisconsin mozzarella cheese slices over it, then sprinkle on our fresh Italian seasoning for mouthwatering, creamy, cheesy goodness with five times the flavor slice after slice. Cheese pizza isn’t just for the kids anymore!",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2023/07/Five-Cheeze.jpg",
                'ingredients' => "CRUST (ENRICHED WHEAT FLOUR [FLOUR, NIACIN,
IRON, THIAMINE, MONONITRATE, RIBOFLAVIN, FOLIC ACID, ENZYME,
ASCORBIC ACID], WATER, SOYBEAN OIL, YEAST, BREAD CRUMBS
[WHEAT FLOUR, YEAST, SUGAR, SALT], OLIVE OIL, SUGAR, SALT,
CULTURED WHEAT STARCH, HONEY, SODIUM BICARBONATE, SODIUM
ALUMINUM PHOSPHATE, L-CYSTEINE, CITRIC ACID, SOY LECITHIN),
LOW MOISTURE MOZZARELLA CHEESE (LOW MOISTURE MOZZARELLA
CHEESE [PASTEURIZED MILK, SALT, CHEESE CULTURES, ENZYMES]),
SAUCE (TOMATO PUREE [WATER, TOMATO PASTE], SEASONING [SALT,
SPICES, DEHYDRATED GARLIC, SOYBEAN OIL), SLICED MOZZARELLA
CHEESE (MOZZARELLA CHEESE [PASTEURIZED MILK, VINEGAR,
ENZYMES, SALT]), PARMESAN, ASIAGO AND ROMANO CHEESE BLEND
(PARMESAN, ASIAGO AND ROMANO CHEESE [PASTEURIZED COW'S
MILK, CHEESE CULTURE, SALT, ENZYMES], POWDERED CELLULOSE
[TO PREVENT CAKING]), FONTINA CHEESE (FONTINA CHEESE
[CULTURED PASTEURIZED MILK, SALT, ENZYMES, CELLULOSE {TO
PREVENT CAKING}, NATAMYCIN {TO PROTECT FLAVOR}]), CONTAINS
LESS THAN 2% OF SPICE",
                'allergens' => "Milk, Wheat, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 5,
                    'serving_fraction' => '1/5',
                    'serving_weight' => 149,
                    'caloris_from_fat' => 0,
                    'calories' => 350,
                    'total_fat' => 16,
                    'saturated_fat' => 9,
                    'trans_fat' => 0,
                    'cholesterol' => 45,
                    'sodium' => 830,
                    'total_carbohydrate' => 33,
                    'dietary_fiber' => 2,
                    'total_sugars' => 3,
                    'added_sugars' => 1,
                    'protein' => 18,
                    'vitamin_d' => 0.2,
                    'calcium' => 350,
                    'iron' => 2.4,
                    'potassium' => 260,                ]
            ],
            [
                'name' => "Drafthaus Bacon Cheeseburger Bomber",
                'slug' => "drafthaus-bacon-cheeseburger-bomber",
                'tags' => ['hand-tossed', 'beef', 'bacon', 'cheddar'],
                'description' => "12” Thick Crust Pizza Loaded 1 lb. 10.9 oz. (26.9 oz., 762 g) Pure bacon cheeseburger simplicity atop a deliciously chewy crust. This bomber explodes with flavor: perfectly seasoned ground beef, almost a half-pound of real Wisconsin shredded mozzarella, creamy cheddar cheese, and just the right amount of bacon to complete the charge. Ketchup is optional (and recommended).",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2023/07/bacon-Chzburger.jpg",
                'ingredients' => "CRUST (ENRICHED WHEAT FLOUR [FLOUR, NIACIN, IRON, THIAMINE,
MONONITRATE, RIBOFLAVIN, FOLIC ACID, ENZYME, ASCORBIC ACID], WATER, SOYBEAN
OIL, YEAST, BREAD CRUMBS [WHEAT FLOUR, YEAST, SUGAR, SALT], OLIVE OIL, SUGAR,
SALT, CULTURED WHEAT STARCH, HONEY, SODIUM BICARBONATE, SODIUM ALUMINUM
PHOSPHATE, L-CYSTEINE, CITRIC ACID, SOY LECITHIN), LOW MOISTURE MOZZARELLA
CHEESE (LOW MOISTURE MOZZARELLA CHEESE [PASTEURIZED MILK, SALT, CHEESE
CULTURES, ENZYMES]), SAUCE (TOMATO PUREE [WATER, TOMATO PASTE], SEASONING
[SALT, SPICES, DEHYDRATED GARLIC, SOYBEAN OIL), BEEF PIZZA TOPPING (BEEF,
WATER, SOY PROTEIN CONCENTRATE, TEXTURED SOY FLOUR, SALT, HYDROLYZED
SOY PROTEIN, SPICES, DEXTROSE, MONOSODIUM GLUTAMATE, SODIUM PHOSPHATES,
FLAVORING, CARAMEL COLOR, WORCESTERSHIRE SAUCE POWDER [DISTILLED
VINEGAR, MOLASSES, CORN SYRUP, SALT, CARAMEL COLOR, GARLIC POWDER, ONION
POWDER, SUGAR, SPICES, TAMARIND AND NATURAL FLAVOR ON MALTODEXTRIN],
BHA, BHT, CITRIC ACID), COOKED BACON CRUMBLES (CURED WITH WATER, SALT,
SUGAR, SMOKE FLAVORING, SODIUM PHOSPHATES, SODIUM ERYTHROBATE AND/OR
SODIUM ASCORBATE, SODIUM NITRATE), CHEDDAR CHEESE (CHEDDAR CHEESE
[PASTEURIZED MILK, CHEESE CULTURES, SALT, ENZYMES, ANNATTO COLOR], POTATO
STARCH AND POWDERED CELLULOSE [TO PREVENT CAKING], NATAMYCIN [MOLD
INHIBITOR]), CONTAINS LESS THAN 2% OF SPICE. C",
                'allergens' => "Milk, Wheat, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 6,
                    'serving_fraction' => '1/6',
                    'serving_weight' => 134,
                    'caloris_from_fat' => 0,
                    'calories' => 330,
                    'total_fat' => 16,
                    'saturated_fat' => 8,
                    'trans_fat' => 0,
                    'cholesterol' => 45,
                    'sodium' => 950,
                    'total_carbohydrate' => 29,
                    'dietary_fiber' => 2,
                    'total_sugars' => 3,
                    'added_sugars' => 1,
                    'protein' => 18,
                    'vitamin_d' => 0.4,
                    'calcium' => 250,
                    'iron' => 2.6,
                    'potassium' => 280,
                ]
            ],
            [
                'name' => "Drafthaus Fiesta Taco Michelada",
                'slug' => "drafthaus-fiesta-taco-michelada",
                'tags' => ['hand-tossed', 'beef', 'taco', 'mexican', 'cheddar', 'tomato', 'peppers', 'onion', 'olives', 'taco-sauce'],
                'description' => "12” Thick Crust Pizza Loaded 1 lb. 11.8 oz. (27.8 oz., 788 g) A Mexican-style pizza for you true taco lovers. This taco pizza is a flavor fiesta loaded with deliciously seasoned beef, tomatoes, black olives, red bell peppers, and red onion, topped with taco sauce, and covered with nearly half a pound of real Wisconsin shredded mozzarella and creamy cheddar cheeses.",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2023/07/Fiesta-taco.jpg",
                'ingredients' => "CRUST (ENRICHED WHEAT FLOUR [FLOUR, NIACIN, IRON,
THIAMINE, MONONITRATE, RIBOFLAVIN, FOLIC ACID, ENZYME, ASCORBIC
ACID], WATER, SOYBEAN OIL, YEAST, BREAD CRUMBS [WHEAT FLOUR,
YEAST, SUGAR, SALT], OLIVE OIL, SUGAR, SALT, CULTURED WHEAT STARCH,
HONEY, SODIUM BICARBONATE, SODIUM ALUMINUM PHOSPHATE,
L-CYSTEINE, CITRIC ACID, SOY LECITHIN), LOW MOISTURE MOZZARELLA
CHEESE (LOW MOISTURE MOZZARELLA CHEESE [PASTEURIZED MILK,
SALT, CHEESE CULTURES, ENZYMES]), SAUCE (TOMATO PUREE [WATER,
TOMATOES], SEASONING [DEHYDRATED ONION, CHILI PEPPER, SPICES,
SALT, PAPRIKA {COLOR}, DEHYDRATED GARLIC, WHEAT FLOUR, CITRIC
ACID, RED PEPPER, COCOA POWDER PROCESSED WITH ALKALI]), MEXICAN
STYLE BEEF TOPPING (BEEF, WATER, TEXTURED VEGETABLE PROTEIN [SOY
PROTEIN CONCENTRATE, CARAMEL COLOR], CRUSHED TOMATOES
[TOMATOES, SALT, CITRIC ACID], GREEN CHILE PEPPERS, SEASONING
[SALT, SPICES, ONION, PAPRIKA, GARLIC, SPICE EXTRACTIVE], ONIONS,
JALAPENO PEPPERS, SODIUM PHOSPHATES), CHEDDAR CHEESE (CHEDDAR
CHEESE [PASTEURIZED MILK, CHEESE CULTURES, SALT, ENZYMES, ANNATTO
COLOR], POTATO STARCH AND POWDERED CELLULOSE [TO PREVENT
CAKING], NATAMYCIN [MOLD INHIBITOR]), TOMATOES, BLACK OLIVES
(OLIVES, SALT, FERROUS GLUCONATE [TO STABILIZE COLOR]), RED BELL
PEPPER, RED ONION.",
                'allergens' => "Milk, Wheat, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 6,
                    'serving_fraction' => '1/6',
                    'serving_weight' => 138,
                    'caloris_from_fat' => 0,
                    'calories' => 290,
                    'total_fat' => 13,
                    'saturated_fat' => 7,
                    'trans_fat' => 0,
                    'cholesterol' => 40,
                    'sodium' => 780,
                    'total_carbohydrate' => 29,
                    'dietary_fiber' => 2,
                    'total_sugars' => 3,
                    'added_sugars' => 1,
                    'protein' => 14,
                    'vitamin_d' => 0,
                    'calcium' => 237,
                    'iron' => 3,
                    'potassium' => 250,
                ]
            ],
            [
                'name' => "Drafthaus Double Pepperoni Bullseye",
                'slug' => "drafthaus-double-pepperoni-bullseye",
                'tags' => ['thin-crust', 'pepperoni', 'provolone', ],
                'description' => "12” Thin Crust Pizza Loaded 1 lb. 7.7 oz. (23.7 oz., 671 g) We hit the mark for pepperoni lovers everywhere! Nothing goes better with sliced pepperoni  than even more diced pepperoni. Balanced with over half a pound of real Wisconsin shredded mozzarella cheese, shredded provolone, our signature FRESH Wisconsin mozzarella cheese slices, then sprinkled with fresh Italian seasoning, this thin crust pizza has a taste that’s right on target!",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2023/07/Bullseye.jpg",
                'ingredients' => "CRUST (WHEAT FLOUR, WATER, SOYBEAN OIL, PALM OIL, SALT,
YEAST, SUGAR, CALCIUM PROPIONATE [PRESERVATIVE], L-CYSTEINE), LOW
MOISTURE MOZZARELLA CHEESE (LOW MOISTURE MOZZARELLA CHEESE
[PASTEURIZED MILK, SALT, CHEESE CULTURES, ENZYMES]), SAUCE (TOMATO PUREE
[WATER, TOMATO PASTE], SEASONING [SALT, SPICES, DEHYDRATED GARLIC,
SOYBEAN OIL), PEPPERONI (PORK, BEEF, SALT, SPICES, DEXTROSE, LACTIC ACID
STARTER CULTURE, OLEORESIN OF PAPRIKA, FLAVORING, SODIUM ASCORBATE,
SODIUM NITRITE, BHA, BHT AND CITRIC ACID), SLICED MOZZARELLA CHEESE
(MOZZARELLA CHEESE [PASTEURIZED MILK, VINEGAR, ENZYMES, SALT]), PEPPERONI
(PORK, BEEF, SALT, SPICES, CONTAINS 2% OR LESS OF SUGAR, DEXTROSE, WATER,
LACTIC ACID STARTER CULTURE, OLEORESIN OF PAPRIKA, NATURAL SPICE, NATURAL
SMOKE FLAVORINGS, SPICE EXTRACTIVES, GARLIC POWDER, SODIUM ERYTHORBATE,
SODIUM ASCORBATE, DEHYDRATED GARLIC, SODIUM NITRITE, BHA, BHT, TBHQ,
CITRIC ACID), PROVOLONE CHEESE (PROVOLONE CHEESE [CULTURED PASTEURIZED
MILK, SALT, ENZYMES], POTATO STARCH AND POWDERED CELLULOSE [TO PREVENT
CAKING]), CONTAINS LESS THAN 2% OF SPICE. C",
                'allergens' => "Milk, Wheat, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 5,
                    'serving_fraction' => '1/5',
                    'serving_weight' => 139,
                    'caloris_from_fat' => 0,
                    'calories' => 370,
                    'total_fat' => 22,
                    'saturated_fat' => 11,
                    'trans_fat' => 0,
                    'cholesterol' => 65,
                    'sodium' => 850,
                    'total_carbohydrate' => 25,
                    'dietary_fiber' => 2,
                    'total_sugars' => 3,
                    'added_sugars' => 0,
                    'protein' => 18,
                    'vitamin_d' => 0.3,
                    'calcium' => 360,
                    'iron' => 1,
                    'potassium' => 290,
                ]
            ],
            [
                'name' => "Drafthaus Sausage & Pepperoni Toss",
                'slug' => "drafthaus-sausage-and-pepperoni-toss",
                'tags' => ['thin-crust', 'sausage', 'pepperoni', 'provolone', ],
                'description' => "12” Thin Crust Pizza Loaded 1 lb. 10.2 oz. (26.2 oz., 742 g) Double the ingredients for double the flavor! We combine sweet Italian sausage with traditional spicy sausage, then complement with generous amounts of sliced pepperoni with an equal amount of diced pepperoni. The result is a sausage and pepperoni dream in every bite! Topped off with over half a pound of real Wisconsin shredded mozzarella cheese, our signature FRESH Wisconsin mozzarella cheese slices, then sprinkled with fresh Italian seasoning, this is one you’ve been needing in your life!",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2023/07/Sausage-Pep-Toss.jpg",
                'ingredients' => "CRUST (WHEAT FLOUR, WATER, SOYBEAN OIL, PALM OIL, SALT,
YEAST, SUGAR, CALCIUM PROPIONATE [PRESERVATIVE], L-CYSTEINE), LOW
MOISTURE MOZZARELLA CHEESE (LOW MOISTURE MOZZARELLA CHEESE
[PASTEURIZED MILK, SALT, CHEESE CULTURES, ENZYMES]), SAUCE (TOMATO
PUREE [WATER, TOMATO PASTE], SEASONING [SALT, SPICES, DEHYDRATED
GARLIC, SOYBEAN OIL), COOKED ITALIAN SAUSAGE (PORK, WATER, SALT, SPICES,
CORN SYRUP SOLIDS, PAPRIKA, FLAVORING, DISODIUM INOSINATE, DISODIUM
GUANYLATE, BHA, BHT, AND PROPYL GALLATE [TO PROTECT FLAVOR]), SLICED
MOZZARELLA CHEESE (MOZZARELLA CHEESE [PASTEURIZED MILK, VINEGAR,
ENZYMES, SALT]), PEPPERONI (PORK AND BEEF, SALT, CONTAINS 2% OR LESS OF
WATER, DEXTROSE, SPICES, OLEORESIN OF PAPRIKA, LACTIC ACID STARTER
CULTURE, GARLIC POWDER, SODIUM NITRITE [PRESERVATIVE], BHA, BHT, AND
CITRIC ACID), COOKED ITALIAN SAUSAGE (PORK, SEASONING [SPICES,
DEHYDRATED GARLIC], WATER, SALT, FLAVORING), PROVOLONE CHEESE
(PROVOLONE CHEESE [CULTURED PASTEURIZED MILK, SALT, ENZYMES], POTATO
STARCH AND POWDERED CELLULOSE [TO PREVENT CAKING]), PEPPERONI (PORK,
BEEF, SALT, SPICES, CONTAINS 2% OR LESS OF SUGAR, DEXTROSE, WATER,
LACTIC ACID STARTER CULTURE, OLEORESIN OF PAPRIKA, NATURAL SPICE,
NATURAL SMOKE FLAVORINGS, SPICE EXTRACTIVES, GARLIC POWDER, SODIUM
ERYTHORBATE, SODIUM ASCORBATE, DEHYDRATED GARLIC, SODIUM NITRITE,
BHA, BHT, TBHQ, CITRIC ACID), CONTAINS LESS THAN 2% OF SPICE.",
                'allergens' => "Milk, Wheat, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 6,
                    'serving_fraction' => '1/6',
                    'serving_weight' => 130,
                    'caloris_from_fat' => 0,
                    'calories' => 350,
                    'total_fat' => 21,
                    'saturated_fat' => 10,
                    'trans_fat' => 0,
                    'cholesterol' => 60,
                    'sodium' => 760,
                    'total_carbohydrate' => 22,
                    'dietary_fiber' => 1,
                    'total_sugars' => 2,
                    'added_sugars' => 0,
                    'protein' => 17,
                    'vitamin_d' => 0.3,
                    'calcium' => 300,
                    'iron' => 1,
                    'potassium' => 270,
                ]
            ],
            [
                'name' => "Drafthaus Honey Sriracha Chicken Rocker",
                'slug' => "drafthaus-honey-sriracha-chicken-rocker",
                'tags' => ['thin-crust', 'chicken', 'honey', 'sriracha', 'peppers', 'tomato',],
                'description' => "12” Thick Crust Pizza Loaded 1 lb. 6 oz. (22.2 oz., 630 g) Indulge in the sweet heat of honey sriracha sauce accompanied by tender chicken, 100% Real Wisconsin mozzarella, ricotta salata cheese, and roasted veggies (tomatoes plus red, green, and yellow peppers). This is a flavor-packed thin crust pizza that’ll rock your world right out of the oven.",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2024/02/the-honey-sriracha-chicken-rocker.png",
                'ingredients' => "CRUST (WHEAT FLOUR, WATER, SOYBEAN OIL, PALM
OIL, SALT, YEAST, SUGAR, CALCIUM PROPIONATE [PRESERVATIVE],
L-CYSTEINE), LOW MOISTURE MOZZARELLA CHEESE (LOW MOISTURE
MOZZARELLA CHEESE [PASTEURIZED MILK, SALT, CHEESE CULTURES,
ENZYMES]), HONEY SRIRACHA SAUCE (SUGAR, WATER, RED JALAPENO
PEPPER, HONEY, DISTILLED VINEGAR, TOMATO PASTE, CORN STARCH,
SALT, CONTAINS LESS THAN 2% OF LIME JUICE CONCENTRATE, ACETIC
ACID, NATURAL FLAVORS), CHICKEN STRIPS (CHICKEN, WATER, POTATO
STARCH, SALT, ROSEMARY EXTRACT), RICOTTA SALATA CHEESE
(RICOTTA SALATA CHEESE [PASTEURIZED WHEY, PASTEURIZED MILK,
VINEGAR, SALT], POWDERED CELLULOSE [TO PREVENT CAKING],
NATAMYCIN [TO PROTECT FLAVOR]), ROASTED RED BELL PEPPERS,
ROASTED GREEN BELL PEPPERS, ROASTED YELLOW BELL PEPPERS,
TOMATOES (TOMATOES, CALCIUM CHLORIDE).",
                'allergens' => "Milk, Wheat, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 5,
                    'serving_fraction' => '1/5',
                    'serving_weight' => 130,
                    'caloris_from_fat' => 0,
                    'calories' => 290,
                    'total_fat' => 12,
                    'saturated_fat' => 7,
                    'trans_fat' => 0,
                    'cholesterol' => 45,
                    'sodium' => 660,
                    'total_carbohydrate' => 31,
                    'dietary_fiber' => 1,
                    'total_sugars' => 9,
                    'added_sugars' => 7,
                    'protein' => 14,
                    'vitamin_d' => 0,
                    'calcium' => 313,
                    'iron' => 1,
                    'potassium' => 157,
                ]
            ],
            [
                'name' => "Drafthaus 9-Ball Special",
                'slug' => "drafthaus-9-ball-special",
                'tags' => ['thin-crust', 'sausage', 'mushroom', 'pepperoni', 'olives', 'peppers', 'onion',],
                'description' => "12” Thin Crust Pizza Loaded 1 lb. 10.9 oz. (26.9 oz., 762 g) You won’t need any luck to win with this thin crust special! Rack up plenty of taste with nine of the most popular pizza toppings all in one place. Sweet Italian sausage, mushrooms, pepperoni, spicy sausage, black and green olives, green bell peppers, and red onion on a crispy thin crust, covered with real Wisconsin shredded mozzarella cheese and sprinkled with fresh Italian seasoning—your lucky break indeed!",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2023/07/9-Ball-Special.jpg",
                'ingredients' => "CRUST (WHEAT FLOUR, WATER, SOYBEAN OIL, PALM
OIL, SALT, YEAST, SUGAR, CALCIUM PROPIONATE [PRESERVATIVE],
L-CYSTEINE), LOW MOISTURE MOZZARELLA CHEESE (LOW MOISTURE
MOZZARELLA CHEESE [PASTEURIZED MILK, SALT, CHEESE CULTURES,
ENZYMES]), SAUCE (TOMATO PUREE [WATER, TOMATO PASTE],
SEASONING [SALT, SPICES, DEHYDRATED GARLIC, SOYBEAN OIL),
COOKED ITALIAN SAUSAGE (PORK, WATER, SALT, SPICES, CORN SYRUP
SOLIDS, PAPRIKA, FLAVORING, DISODIUM INOSINATE, DISODIUM
GUANYLATE, BHA, BHT, AND PROPYL GALLATE [TO PROTECT FLAVOR]),
MUSHROOMS, PEPPERONI (PORK, BEEF, SALT, SPICES, DEXTROSE,
LACTIC ACID STARTER CULTURE, OLEORESIN OF PAPRIKA, FLAVORING,
SODIUM ASCORBATE, SODIUM NITRITE, BHA, BHT AND CITRIC ACID),
COOKED ITALIAN SAUSAGE (PORK, SEASONING [SPICES, DEHYDRATED
GARLIC], WATER, SALT, FLAVORING), CONTAINS LESS THAN 2% OF
GREEN BELL PEPPERS, RED ONION, BLACK OLIVES (OLIVES, SALT,
FERROUS GLUCONATE [TO STABILIZE COLOR]), GREEN OLIVES (OLIVES,
SALT, LACTIC ACID), SPICE.",
                'allergens' => "Milk, Wheat, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 6,
                    'serving_fraction' => '1/6',
                    'serving_weight' => 133,
                    'caloris_from_fat' => 0,
                    'calories' => 310,
                    'total_fat' => 18,
                    'saturated_fat' => 8,
                    'trans_fat' => 0,
                    'cholesterol' => 50,
                    'sodium' => 730,
                    'total_carbohydrate' => 23,
                    'dietary_fiber' => 2,
                    'total_sugars' => 2,
                    'added_sugars' => 0,
                    'protein' => 14,
                    'vitamin_d' => 0.2,
                    'calcium' => 270,
                    'iron' => 1.1,
                    'potassium' => 290,
                ]
            ],
            [
                'name' => "Drafthaus Twisted Luau",
                'slug' => "drafthaus-twisted-luau",
                'tags' => ['thin-crust', 'pineapple', 'ham', 'bacon', 'peppers', 'olives', 'peppers', 'onion',],
                'description' => "12” Thin Crust Pizza Loaded 1 lb. 8.9 oz. (24.9 oz., 705 g) A classic Hawaiian pizza with a tasty twist! This crowd-pleasing recipe starts with Pep’s sauce and real Wisconsin shredded mozzarella cheese. We add just the right amount of sweet pineapple, plenty of savory ham and bacon, and a dash of spicy, chili-infused oil. Salty, cheesy, and enough sweet heat to get your luau started!",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2023/07/Twisted-Luau.jpg",
                'ingredients' => "CRUST (WHEAT FLOUR, WATER, SOYBEAN OIL, PALM OIL,
SALT, YEAST, SUGAR, CALCIUM PROPIONATE [PRESERVATIVE], L-CYSTEINE),
LOW MOISTURE MOZZARELLA CHEESE (LOW MOISTURE MOZZARELLA
CHEESE [PASTEURIZED MILK, SALT, CHEESE CULTURES, ENZYMES]), SAUCE
(TOMATO PUREE [WATER, TOMATO PASTE], SEASONING [SALT, SPICES,
DEHYDRATED GARLIC, SOYBEAN OIL {ANTI-DUSTING AGENT}], CHILI
INFUSED OIL [CANOLA OIL, CHILI EXTRACTS]), PINEAPPLE, HAM WATER
ADDED (CURED WITH WATER, DEXTROSE, SALT, CONTAINS 2% OR LESS
OF POTASSIUM LACTATE, SODIUM LACTATE, SODIUM PHOSPHATES,
SODIUM DIACETATE, SODIUM ERYTHORBATE, SODIUM NITRITE
[PRESERVATIVE]), COOKED BACON CRUMBLES (CURED WITH WATER, SALT,
SUGAR, SMOKE FLAVORING, SODIUM PHOSPHATES, SODIUM ERYTHROBATE
AND/OR SODIUM ASCORBATE, SODIUM NITRATE), CONTAINS LESS THAN
2% OF CILANTRO. ",
                'allergens' => "Milk, Wheat, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 5,
                    'serving_fraction' => '1/5',
                    'serving_weight' => 149,
                    'caloris_from_fat' => 0,
                    'calories' => 320,
                    'total_fat' => 16,
                    'saturated_fat' => 8,
                    'trans_fat' => 0,
                    'cholesterol' => 50,
                    'sodium' => 760,
                    'total_carbohydrate' => 28,
                    'dietary_fiber' => 2,
                    'total_sugars' => 5,
                    'added_sugars' => 1,
                    'protein' => 17,
                    'vitamin_d' => 1.7,
                    'calcium' => 320,
                    'iron' => 0.9,
                    'potassium' => 300,                ]
            ],
            // drafthaus rising crust pizzas
            [
                'name' => "Drafthaus Rising Bacon Cheeseburger",
                'slug' => "drafthaus-rising-bacon-cheeseburger",
                'tags' => ['rising-crust', 'beef', 'bacon', 'cheddar', 'cheeseburger',],
                'description' => "12” Rising Crust Pizza Loaded 1 lb. 10.2 oz. (26.2 oz., 742 g) Indulge in a Pep’s Drafthaus pizza experience where our rising crust takes center stage. If you love a good cheeseburger, this is the pizza for you. 100% Real Wisconsin mozzarella and cheddar cheeses blend with savory beef topping and just the right amount of bacon. It’s pure cheeseburger simplicity atop a rising crust that bakes and rises to perfection with a smoky cheddar-flavored edge. THIS is the rising crust pizza you’ve been waiting for.",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2023/07/RC_BaconCheeseburgerJokerWHOLE-copy.jpg",
                'ingredients' => "CRUST (ENRICHED FLOUR [WHEAT FLOUR, NIACIN, REDUCED IRON, THIAMINE MONONITRATE, RIBOFLAVIN, FOLIC ACID, ENZYME], WATER, SOYBEAN OIL, PALM OIL, SUGAR,
BREAD CRUMBS [WHEAT FLOUR, SUGAR, YEAST, SALT], HIGH FRUCTOSE CORN SYRUP, YELLOW
CORN MEAL, YEAST, SALT, NATURAL FLAVORED OIL [SOYBEAN OIL, HYDROGENATED SOYBEAN
OIL, NATURAL FLAVORS, BETA CAROTENE], SODIUM BICARBONATE, SODIUM ALUMINUM
PHOSPHATE, SEASONING [WHITE RICE FLOUR, WHEY, CREAM SOLIDS, CHEDDAR CHEESE
[PASTEURIZED MILK, CHEESE CULTURE, SALT, ENZYMES], CELLULOSE, MALTODEXTRIN, SALT,
NATURAL FLAVORS, NONFAT DRY MILK, CONTAINS 2% OR LESS OF: CITRIC ACID, LACTIC ACID
POWDER, BUTTER OIL, ANNATTO EXTRACT AND PAPRIKA EXTRACT ADDED FOR COLOR, SILICON
DIOXIDE [TO REDUCE DUSTING], SODIUM PHOSPHATE, SODIUM CITRATE, XANTHAN GUM],
DOUGH CONDITIONERS [WHEAT FLOUR, DEXTROSE, DIACETYL TARTARIC ACID ESTERS OF
MONO AND DIGLYCERIDES, SOYBEAN OIL, ASCORBIC ACID, ENZYMES, L-CYSTEINE], SOY
LECITHIN), LOW MOISTURE MOZZARELLA CHEESE (LOW MOISTURE MOZZARELLA CHEESE [PASTEURIZED MILK, SALT, CHEESE CULTURES, ENZYMES]), SAUCE (TOMATO PUREE [WATER, TOMATO PASTE], SEASONING [SALT, SPICES, DEHYDRATED GARLIC, SOYBEAN OIL), BEEF
PIZZA TOPPING (BEEF, WATER, SOY PROTEIN CONCENTRATE, TEXTURED SOY FLOUR, SALT, HYDROLYZED SOY PROTEIN, SPICES, DEXTROSE, MONOSODIUM GLUTAMATE, SODIUM
PHOSPHATES, FLAVORING, CARAMEL COLOR, WORCESTERSHIRE SAUCE POWDER [DISTILLED
VINEGAR, MOLASSES, CORN SYRUP, SALT, CARAMEL COLOR, GARLIC POWDER, ONION POWDER,
SUGAR, SPICES, TAMARIND AND NATURAL FLAVOR ON MALTODEXTRIN], BHA, BHT, CITRIC
ACID), CHEDDAR CHEESE (CHEDDAR CHEESE [PASTEURIZED MILK, CHEESE CULTURES, SALT, ENZYMES, ANNATTO COLOR], POTATO STARCH AND POWDERED CELLULOSE [TO PREVENT
CAKING], NATAMYCIN [MOLD INHIBITOR]), CONTAINS LESS THAN 2% OF COOKED BACON
CRUMBLES (CURED WITH WATER, SALT, SUGAR, SMOKE FLAVORING, SODIUM PHOSPHATES, SODIUM ERYTHROBATE AND/OR SODIUM ASCORBATE, SODIUM NITRATE). ",
                'allergens' => "Milk, Wheat, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 6,
                    'serving_fraction' => '1/6',
                    'serving_weight' => 129,
                    'caloris_from_fat' => 0,
                    'calories' => 340,
                    'total_fat' => 13,
                    'saturated_fat' => 6,
                    'trans_fat' => 0,
                    'cholesterol' => 25,
                    'sodium' => 730,
                    'total_carbohydrate' => 41,
                    'dietary_fiber' => 1,
                    'total_sugars' => 5,
                    'added_sugars' => 3,
                    'protein' => 13,
                    'vitamin_d' => 0,
                    'calcium' => 148,
                    'iron' => 3,
                    'potassium' => 191,
                ]
            ],
            [
                'name' => "Drafthaus Rising Three Meat",
                'slug' => "drafthaus-rising-three-meat",
                'tags' => ['rising-crust', 'beef', 'pepperoni', 'sausage', 'parmesan', 'provolone',],
                'description' => "12” Rising Crust Pizza Loaded 1 lb. 10 4oz. (26.4 oz., 748 g) Indulge in a Pep’s Drafthaus pizza experience where our rising crust takes center stage. Enjoy the delicious triple combination of pepperoni, spicy Italian sausage, and beef topping surrounded by 100% Real Wisconsin mozzarella, provolone, and parmesan cheeses. Everything comes together on our rising crust that bakes and rises to perfection with a garlic parmesan-flavored edge. THIS is the rising crust pizza you’ve been waiting for.",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2023/07/RC_ThreeMeatMixerWHOLE-copy.jpg",
                'ingredients' => "CRUST (ENRICHED FLOUR [WHEAT FLOUR, NIACIN, REDUCED IRON, THIAMINE
MONONITRATE, RIBOFLAVIN, FOLIC ACID, ENZYME], WATER, SOYBEAN OIL, PALM OIL, SUGAR, SEASONED
BREAD CRUMBS [ENRICHED WHEAT FLOUR, SALT, SUGAR, YEAST, SPICES, SOYBEAN OIL, DEHYDRATED
PARSELY], HIGH FRUCTOSE CORN SYRUP, YELLOW CORN MEAL, YEAST, SALT, NATURAL FLAVORED OIL
[SOYBEAN OIL, HYDROGRENATED SOYBEAN OIL, NATURAL FLAVORS, BETA CAROTENE], PARMESAN
CHEESE [PASTEURIZED PART-SKIM MILK, CHEESE CULTURE, SALT, ENZYMES], SODIUM BICARBONATE,
SODIUM ALUMINUM PHOSPHATE, DOUGH CONDITIONERS [WHEAT FLOUR, DEXTROSE, DIACETYL
TARTARIC ACID ESTERS OF MONO AND DIGLYCERIDES, SOYBEAN OIL, ASCORBIC ACID, ENZYMES,
L-CYSTEINE], SOY LECITHIN), SAUCE (TOMATO PUREE [WATER, TOMATO PASTE], SEASONING [SALT,
SPICES, DEHYDRATED GARLIC, SOYBEAN OIL), LOW MOISTURE MOZZARELLA CHEESE (LOW MOISTURE
MOZZARELLA CHEESE [PASTEURIZED MILK, SALT, CHEESE CULTURES, ENZYMES]), PEPPERONI (PORK,
BEEF, SALT, SPICES, DEXTROSE, LACTIC ACID STARTER CULTURE, OLEORESIN OF PAPRIKA, FLAVORING,
SODIUM ASCORBATE, SODIUM NITRITE, BHA, BHT AND CITRIC ACID), COOKED ITALIAN SAUSAGE (PORK,
SEASONING [SPICES, DEHYDRATED GARLIC], WATER, SALT, FLAVORING), BEEF PIZZA TOPPING (BEEF,
WATER, SOY PROTEIN CONCENTRATE, TEXTURED SOY FLOUR, SALT, HYDROLYZED SOY PROTEIN, SPICES,
DEXTROSE, MONOSODIUM GLUTAMATE, SODIUM PHOSPHATES, FLAVORING, CARAMEL COLOR,
WORCESTERSHIRE SAUCE POWDER [DISTILLED VINEGAR, MOLASSES, CORN SYRUP, SALT, CARAMEL
COLOR, GARLIC POWDER, ONION POWDER, SUGAR, SPICES, TAMARIND AND NATURAL FLAVOR ON
MALTODEXTRIN], BHA, BHT, CITRIC ACID), CONTAINS LESS THAN 2% OF PROVOLONE CHEESE (PROVOLONE
CHEESE [CULTURED PASTEURIZED MILK, SALT, ENZYMES], POTATO STARCH AND POWDERED CELLULOSE
[TO PREVENT CAKING]), PARMESAN CHEESE (PARMESAN CHEESE [PASTEURIZED PART-SKIM COW'S
MILK, CHEESE CULTURES, SALT, ENZYMES], POWDERED CELLULOSE [TO PREVENT CAKING]).",
                'allergens' => "Milk, Wheat, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 6,
                    'serving_fraction' => '1/6',
                    'serving_weight' => 129,
                    'caloris_from_fat' => 0,
                    'calories' => 340,
                    'total_fat' => 14,
                    'saturated_fat' => 7,
                    'trans_fat' => 0,
                    'cholesterol' => 25,
                    'sodium' => 740,
                    'total_carbohydrate' => 41,
                    'dietary_fiber' => 1,
                    'total_sugars' => 4,
                    'added_sugars' => 0,
                    'protein' => 12,
                    'vitamin_d' => 0.1,
                    'calcium' => 130,
                    'iron' => 2.9,
                    'potassium' => 200,
                ]
            ],
            [
                'name' => "Drafthaus Rising Supreme",
                'slug' => "drafthaus-rising-supreme",
                'tags' => ['rising-crust', 'pepperoni', 'sausage', 'peppers', 'onion', 'olives', 'cheddar', 'supreme',],
                'description' => "12” Rising Crust Pizza Loaded 1 lb. 12 oz. (28 oz., 793 g) Indulge in a Pep’s Drafthaus pizza experience where our rising crust takes center stage. Enjoy a Supreme pizza the way it was meant to be. 100% Real Wisconsin mozzarella and cheddar cheeses with pepperoni and spicy Italian sausage surrounded with plenty of peppers, onions, and black olives.  Everything comes together on our rising crust that bakes and rises to perfection with a smoky cheddar-flavored edge. THIS is the rising crust pizza you’ve been waiting for.",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2023/07/RC_ThreeMeatMixerWHOLE-copy-1.jpg",
                'ingredients' => "CRUST (ENRICHED FLOUR [WHEAT FLOUR, NIACIN, REDUCED IRON, THIAMINE
MONONITRATE, RIBOFLAVIN, FOLIC ACID, ENZYME], WATER, SOYBEAN OIL, PALM OIL, SUGAR,
BREAD CRUMBS [WHEAT FLOUR, SUGAR, YEAST, SALT], HIGH FRUCTOSE CORN SYRUP, YELLOW
CORN MEAL, YEAST, SALT, NATURAL FLAVORED OIL [SOYBEAN OIL, HYDROGENATED SOYBEAN
OIL, NATURAL FLAVORS, BETA CAROTENE], SODIUM BICARBONATE, SODIUM ALUMINUM
PHOSPHATE, SEASONING [WHITE RICE FLOUR, WHEY, CREAM SOLIDS, CHEDDAR CHEESE
[PASTEURIZED MILK, CHEESE CULTURE, SALT, ENZYMES], CELLULOSE, MALTODEXTRIN, SALT,
NATURAL FLAVORS, NONFAT DRY MILK, CONTAINS 2% OR LESS OF: CITRIC ACID, LACTIC ACID
POWDER, BUTTER OIL, ANNATTO EXTRACT AND PAPRIKA EXTRACT ADDED FOR COLOR, SILICON
DIOXIDE [TO REDUCE DUSTING], SODIUM PHOSPHATE, SODIUM CITRATE, XANTHAN GUM], DOUGH
CONDITIONERS [WHEAT FLOUR, DEXTROSE, DIACETYL TARTARIC ACID ESTERS OF MONO AND
DIGLYCERIDES, SOYBEAN OIL, ASCORBIC ACID, ENZYMES, L-CYSTEINE], SOY LECITHIN), LOW
MOISTURE MOZZARELLA CHEESE (LOW MOISTURE MOZZARELLA CHEESE [PASTEURIZED MILK,
SALT, CHEESE CULTURES, ENZYMES]), SAUCE (TOMATO PUREE [WATER, TOMATO PASTE],
SEASONING [SALT, SPICES, DEHYDRATED GARLIC, SOYBEAN OIL), PEPPERONI (PORK, BEEF, SALT,
SPICES, DEXTROSE, LACTIC ACID STARTER CULTURE, OLEORESIN OF PAPRIKA, FLAVORING,
SODIUM ASCORBATE, SODIUM NITRITE, BHA, BHT AND CITRIC ACID), COOKED ITALIAN SAUSAGE
(PORK, SEASONING [SPICES, DEHYDRATED GARLIC], WATER, SALT, FLAVORING), WHITE CHEDDAR
CHEESE (CHEDDAR CHEESE [PASTEURIZED MILK, CHEESE CULTURE, SALT, ENZYMES], POTATO
STARCH [TO PREVENT CAKING], POWDERED CELLULOSE [TO PREVENT CAKING], NATAMYCIN
[MOLD INHIBITOR]), CONTAINS LESS THAN 2% OF GREEN BELL PEPPERS, RED BELL PEPPERS,
RED ONIONS, BLACK OLIVES (OLIVES, SALT, FERROUS GLUCONATE [TO STABILIZE COLOR]), SPICE.",
                'allergens' => "Milk, Wheat, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 6,
                    'serving_fraction' => '1/6',
                    'serving_weight' => 137,
                    'caloris_from_fat' => 0,
                    'calories' => 340,
                    'total_fat' => 15,
                    'saturated_fat' => 7,
                    'trans_fat' => 0,
                    'cholesterol' => 25,
                    'sodium' => 720,
                    'total_carbohydrate' => 41,
                    'dietary_fiber' => 1,
                    'total_sugars' => 5,
                    'added_sugars' => 3,
                    'protein' => 12,
                    'vitamin_d' => 0.1,
                    'calcium' => 130,
                    'iron' => 3,
                    'potassium' => 200,
                ]
            ],
            [
                'name' => "Drafthaus Rising Honey Sriracha Chicken",
                'slug' => "drafthaus-rising-honey-sriracha-chicken",
                'tags' => ['rising-crust', 'chicken', 'honey', 'sriracha','peppers', 'tomato',],
                'description' => "12” Rising Crust Pizza Loaded 1 lb. 11.1 oz. (27.1 oz., 768 g) Indulge in a Pep’s Drafthaus pizza experience where our rising crust takes center stage. Honey sriracha sauce combines with tender chicken and 100% Real Wisconsin mozzarella cheese for a sweet and spicy flavor explosion. Finished with ricotta salata cheese, peppers, and roasted tomatoes, this combination can’t be beat. Everything comes together on our delicious rising crust that bakes and rises to perfection with a ranch-flavored edge. THIS is the rising crust pizza you’ve been waiting for.",
                'image_url' => "https://pepspizzaco.com/wp-content/uploads/2023/07/RC_BaconCheeseburgerJokerWHOLE-copy-1.jpg",
                'ingredients' => "CRUST [ENRICHED FLOUR (WHEAT FLOUR, NIACIN, REDUCED IRON,
THIAMINE MONONITRATE, RIBOFLAVIN, FOLIC ACID, ENZYME), WATER, SOYBEAN
OIL, PALM OIL, SUGAR, BREAD CRUMBS (WHEAT FLOUR, SUGAR, YEAST, SALT), HIGH
FRUCTOSE CORN SYRUP, YELLOW CORN MEAL, YEAST, SALT, NATURAL FLAVORED
OIL (SOYBEAN OIL, HYDROGENATED SOYBEAN OIL, NATURAL FLAVORS, BETA
CAROTENE), SODIUM BICARBONATE, SODIUM ALUMINUM PHOSPHATE, SEASONING
(BUTTERMILK POWDER, ORGANIC WHITE RICE FLOUR, GARLIC POWDER, ONION
POWDER, CELLULOSE, SALT, NATURAL FLAVORS, SPICES, CONTAINS 2% OR LESS
OF LACTIC ACID POWDER, CITRIC ACID, YEAST EXTRACT, DISODIUM INOSINATE,
DISODIUM GUANYLATE, SILICON DIOXIDE {TO PREVENT CAKING}, SOYBEAN OIL {TO
PREVENT DUSTING}, DOUGH CONDITIONERS {WHEAT FLOUR, DEXTROSE, DIACETYL
TARTARIC ACID ESTERS OF MONO AND DIGLYCERIDES, SOYBEAN OIL, ASCORBIC
ACID, ENZYMES, L-CYSTEINE}), SOY LECITHIN], LOW MOISTURE WHOLE MILK
MOZZARELLA CHEESE [LOW MOISTURE WHOLE MILK MOZZARELLA CHEESE
(PASTEURIZED MILK, CHEESE CULTURES, SALT, ENZYMES), POWDERED CELLULOSE
(TO PREVENT CAKING)], HONEY SRIRACHA SAUCE [SUGAR, WATER, RED JALAPENO
PEPPER, HONEY, DISTILLED VINEGAR, TOMATO PASTE, CORN STARCH, SALT, CONTAINS
LESS THAN 2% OF LIME JUICE CONCENTRATE, ACETIC ACID, NATURAL FLAVORS],
CHICKEN BREAST WITH RIB MEAT, RICOTTA SALATA CHEESE [RICOTTA SALATA
CHEESE (PASTEURIZED WHEY, PASTEURIZED MILK, VINEGAR, SALT), POWDERED
CELLULOSE (TO PREVENT CAKING), NATAMYCIN (MOLD INHIBITOR)], ROASTED RED,
GREEN AND YELLOW BELL PEPPERS, ROASTED TOMATOES [TOMATOES, CALCIUM
CHLORIDE].",
                'allergens' => "Milk, Wheat, Soy",
                'nutritional_facts' => [
                    'serving_per_container' => 6,
                    'serving_fraction' => '1/6',
                    'serving_weight' => 133,
                    'caloris_from_fat' => 0,
                    'calories' => 320,
                    'total_fat' => 11,
                    'saturated_fat' => 5,
                    'trans_fat' => 0,
                    'cholesterol' => 25,
                    'sodium' => 640,
                    'total_carbohydrate' => 45,
                    'dietary_fiber' => 0,
                    'total_sugars' => 8,
                    'added_sugars' => 7,
                    'protein' => 11,
                    'vitamin_d' => 0.1,
                    'calcium' => 140,
                    'iron' => 2.6,
                    'potassium' => 130,
                ]
            ],
        ];

        foreach ($pizzas as $pizza) {
            PizzaSeedHandler::seedPizza($brand, $pizza);
        }
    }
}

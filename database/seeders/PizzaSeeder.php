<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pizza;
use App\Models\Brand;
use App\Models\Style;
use App\Models\Tag;
use App\Models\Image;
use App\Handlers\ImageHandler;
use App\Models\NutritionFact;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some brands
        $brands = [
            ['name' => 'American Flatbread', 'slug' => 'american-flatbread', 'image_name' => 'AmericanFlatbread.png', 'website' => 'https://www.americanflatbread.com/', 'description' => 'George Schenk founded American Flatbread in Waitsfield, VT on personal philosophies of food and community. “Food intimately affects the quality and character of our lives,” he says. “Too often food is seen principally as a vehicle for profit, rather than in its historic sense as a giver of nutrition.”

He created the American Flatbread concept in 1985 while working in the kitchen at Tucker Hill Restaurant, where a personal passion for cooking with wood led him to build an outdoor oven. Tuesday nights became Flatbread Nights, and the bread was baked under the stars.

With help, he expanded the concept in 1988 to include a wholesale component as well as a retail outlet, which provided the basis for the current model. George continues to develop his vision for the food at American Flatbread and is very involved in daily operations while becoming increasingly influential in his community and that of the culinary world.'],
            // ['name' => 'DiGiorno', 'slug' => 'digiorno', 'image_name' => 'Digiorno.png', 'description' => 'DiGiorno is known for its rising crust pizzas.'],
            // ['name' => 'Tombstone', 'slug' => 'tombstone', 'image_name' => 'Tombstone.png', 'description' => 'Tombstone offers a variety of classic frozen pizzas.'],
            // ['name' => 'Red Baron', 'slug' => 'red-baron', 'image_name' => 'RedBaron.png', 'description' => 'Red Baron is famous for its classic crust pizzas.'],
            // ['name' => 'Jack\'s', 'slug' => 'jacks', 'image_name' => 'Jacks.png', 'description' => 'Jack\'s is known for its thin crust pizzas.', 'website' => 'https://www.goodnes.com/jacks/'],
        ];

        foreach ($brands as $brandData) {
            $image = ImageHandler::createFromExistingFile('local', "pchron_photos/logos/frozen/{$brandData['image_name']}");
            unset($brandData['image_name']);
            $brandData['image_id'] = $image->id;
            Brand::create($brandData);
        }

        $styles = [
            // all the classics styles of pizza
            ['name' => 'New York', 'slug' => 'new-york', 'description' => "The quintessential New York pie features big, wide slices that encourage folding and often result in grease-stained clothing for the uninitiated. Ordered by the slice or whole, these hand-tossed beauties are most often light on the sauce and heavy on the cheese. Baked in coal or deck ovens, the New York version boasts a crunchy, yet pliable crust."],
            ['name' => 'Neopolitan', 'slug' => 'neopolitan', 'description' => "Over the past decade, Neapolitan-style pizza (authentic Italian and Americanized versions of it) has spread quickly across the country. Doughs that are allowed to ferment anywhere from a few hours to several days result in soft, digestible crusts with beautiful airy pockets that add a delightful crunch when they exit wood-burning ovens. Handled carefully and topped sparingly with fresh tomatoes, herbs and imported cheeses, this style has inspired many trips to Italy."],
            ['name' => 'Tomato Pie', 'slug' => 'tomato-pie', 'description' => "On tomato pies, the sauce is the star of the show. Depending on the region, there are different types of pizza referred to as tomato pie. There’s the \"reverse\" pizza, which is your basic pizza (round or square), but with the placement of sauce and cheese reversed; a Philly tomato pie, which is a thick, square, room-temperature pizza topped with a thick sauce and a sprinkling of Parmesan or Romano cheese; and the hand-tossed Neo-Neapolitan style topped with tomato sauce, oregano, olive oil and just a dusting of cheese."],
            ['name' => 'New Haven', 'slug' => 'new-haven', 'description' => "Assisted by oil or coal-fueled ovens reaching temperatures topping 600 degrees, New Haven-style apizza (pronounced ah-beets by locals) delivers a charred crust reminiscent of a backyard grill. The typically misshapen pies are lightly topped with ingredients such as tomatoes, cheese, and sometimes clams, delivered on wax-covered sheet pans that offer a rewarding crunchy and chewy texture."],
            ['name' => 'Sicilian', 'slug' => 'sicilian', 'description' => "Sicilian pizza is best recognized by its rectangular shape, one-to-two-inch crust, pillowy interior, and thick, crunchy base. Sicilian toppings are minimal, with tomato sauce placed above the cheese to hold it all together and ensure a well-cooked crust. Very similar to the Sicilian (but not as common to find), is the elusive Grandma, which presents itself as a thinner, crunchier version of the Sicilian."],
            ['name' => 'Deep Dish', 'slug' => 'deep-dish', 'description' => "Diving into a deep dish pizza is not an easy undertaking. These one-to-two-inch thick giants of the pizza world are not available by the slice and often require a fork and knife to handle. It’s important to accept a few key facts when facing down a deep-dish pizza: 1) In most cases, you won’t be able to eat a whole one by yourself. 2) It’s best to order some veggies and meat to break up all the cheese. 3) Order ahead so you won\'t have to wait 45 minutes for your pie (and it is a pie). Once you have the hang of it, you’ll appreciate the nuances of the flaky, buttery crust, hearty toppings and historic significance of this Chicago mainstay."],
            ['name' => 'Detroit', 'slug' => 'detroit', 'description' => "What do you get when you take a Sicilian-style pizza recipe and bake it in blue steel pans originally designed for the auto industry? Detroit-Style pizza, that’s what. The square pans act like a cast iron skillet to create a super crisp crunch on the crust, and bakers deliberately push the blend of mozzarella and Brick cheese up the deep interior sides of the pans to form an awesome caramelization. The result is a pan pizza on steroids. Traditionalists bake the pizza twice and put the sauce on last to ensure a perfectly crisp crust."],
            ['name' => 'St. Louis', 'slug' => 'st-louis', 'description' => "The St. Louis-style pizza is cracker thin all the way around, cut into squares (referred to as a party cut), with toppings that stretch all the way to the edge, a sweet sauce, and a regional cheese called Provel (a combination of cheddar, Swiss, provolone and liquid smoke). It’s easy eating—almost like a big plate of cheese and crackers."],
            ['name' => 'California', 'slug' => 'california', 'description' => "Toppings are the big tip off with California-style pizzas. The crust is typically hand-tossed, but the toppings can range from barbecue chicken to Thai to lobster—the more \"gourmet\" the pizza appears, the more you can classify it as Californian."],
            ['name' => 'Ohio Valley', 'slug' => 'ohio-valley', 'description' => "In the Ohio Valley region (which includes Ohio, Indiana, Illinois, West Virginia, Pennsylvania, and Kentucky), toppings are added to square pies after the dough exits the oven, the theory being that the heat from the crust will cook the toppings. You won't find Ohio Valley-style pizza in every pizzeria in all of these states, but you'll have the most luck tracking one down if you're in this region."],
            ['name' => 'Bar/Tavern', 'slug' => 'bar-tavern', 'description' => "Traditionally found in early taverns and bars since they’re easy to hold with your beer and don’t fill you up too fast, bar and tavern pies are super-thin, round pies that are cut into square pieces. This style is found all over the Midwest in cities such as St. Louis, Columbus, Chicago, and Milwaukee."],
            ['name' => 'Grilled', 'slug' => 'grilled', 'description' => "Introduced in 1980 by Johanne Killeen and George German, the chef owners of Al Forno in Providence, Rhode Island, serve pizza dough brushed with oil before taking a turn or two on the grill over hot coals. Cheese and toppings are added after the last flip and allowed to melt, finishing off the pizza."],
            ['name' => 'Pan', 'slug' => 'pan', 'description' => "Mostly found in the southeast United States and at chain pizzerias such as Pizza Hut, this pizza is proofed and cooked in a pan with oil or butter imparting a thick, buttery crust."],
            ['name' => 'Stuffed Crust', 'slug' => 'stuffed-crust', 'description' => "Stuffed crust is pizza whos outer rim of crust is traditionaly stuffed with mozzarella cheese, however pizza scientist have been experimenting with different fillings such as hotdogs, etc. Pizza Hut debuted stuffed crust pizza on March 26, 1995 and then engaged in a $45 million ad campaign promoting the pizza. Pizza Hut hired Donald Trump to advertise the pizza. Trump appeared in a 1995 commercial with Ivana Trump. Pizza Hut was sued by Brooklyn resident, Anthony Mongiello, for $1 billion after he claimed to have invented and patented stuffed crust pizza in 1987. Mongiello lost the case in 1999."],
            ['name' => 'Vesuvio (Bombe)', 'slug' => 'vesuvio', 'description' => "This is the Neapolitan version of a stuffed pizza. The Vesuvio puts two crusts on top of each other, filling the interior with ingredients such as mozzarella, tomatoes, and mushrooms. Some pizzerias deliver the pizza to the table and allow the steam from the joined doughs to escape in front of you, mimicking a volcanic eruption."],
            ['name' => 'Old Forge', 'slug' => 'old-forge', 'description' => "According to residents, Old Forge, Pennsylvania, is \"The Pizza Capital of the World,\" baking Sicilian-style pizzas in trays. Vernacular requires full pies be called \"trays,\" and slices \"cuts.\" The sauce is heavy on onions, and the cheese of choice ranges from mozzarella and cheddar to mozzarella and Parmesan."],
            ['name' => 'Greek', 'slug' => 'greek', 'description' => "Not to be confused with the common \"Greek Pizza\" term, which is basically Greek salad ingredients on top of a regular pizza, a true Greek-style pizza can be found in the New England states at places called \"Pizza House\" or \"House of Pizza\" and in Greek restaurants nationwide. Greek-style pizza features a round, oiled dough that puffs up in the pan. The sauce is normally heavy on the oregano, and the cheese (a mix of mozzarella and cheddar) is laid on thick. Greek pizza isn’t for everyone due to the heavy spices and often-dense dough, but there are some good ones out there if you look around."],
            ['name' => 'Quad Cities', 'slug' => 'quad-cities', 'description' => "Popular in the Quad Cities (Rock Island, Moline, and East Moline in Illinois, and Bettendorf and Davenport in Iowa), this pizza dough gets a heavy dose of brewer’s malt, giving it a nutty, sweet taste and a darker appearance. The sauce is thin and spicy; the signature lean pork sausage is heavy on fennel and spices; and the pizza is cut into strips using giant, razor-sharp scissors."],
            ['name' => 'Colorado Mountain Pie', 'slug' => 'colorado-mountain-pie', 'description' => "So far I only know of one pizzeria chain in Colorado serving the Colorado Mountain Pie, but it’s been wooing locals since 1973 with pizzas listed by weight (one, two, three, or five lbs.), topped with mountains of ingredients and featuring a hand-rolled crust handle that is traditionally dipped in honey for dessert."],
            ['name' => 'DC Jumbo', 'slug' => 'dc-jumbo', 'description' => "Since 1997, several pizzerias in the Washington, D.C. area have been battling it out over who has the largest slices of pizza. Popular with the late-night crowds, slices are cut from pies larger than 30 inches, usually require two plates to transport, and tip the caloric charts at more than 1,000 calories a piece."],
            ['name' => 'Brier Hill', 'slug' => 'brier-hill', 'description' => "This style began in 1974 as a fundraising project for St. Anthony’s Catholic Church in Youngstown, Ohio. The round pies are cooked in pans and covered with a thick sauce before being topped with bell peppers and Romano cheese (a hot variety and another topped with eggs is also available)."],
            ['name' => 'Thin Crust', 'slug' => 'thin-crust', 'description' => "Thin-crust pizza may refer to any pizza baked with especially thin or flattened dough, and, in particular, these types of pizza in the United States: St. Louis-style pizza, New Haven-style pizza or New York-style pizza"],
            ['name' => 'Pizza Strips', 'slug' => 'pizza-strips', 'description' => "A specialty of Rhode Island, pizza strips are bakery bread that’s topped with tomato sauce and cut into strips."],
            ['name' => 'Hand Tossed', 'slug' => 'hand-tossed', 'description' => "Hand Tossed crust dough is kneaded, and stretched until to size. Traditional pizza."],
        ];

        foreach ($styles as $styleData) {
            $image = ImageHandler::createFromExistingFile('local', "pchron_photos/styles/{$styleData['slug']}.png");
            $styleData['image_id'] = $image->id;
            Style::create($styleData);
        }

        Style::create(['name' => 'Other', 'slug' => 'other', 'description' => "Other pizza styles that don't fit into the other categories."]);

        // Create some tags
        $tags = [
            ['name' => 'Spicy', 'slug' => 'spicy'],
            ['name' => 'Cheesy', 'slug' => 'cheesy'],
            ['name' => 'Meaty', 'slug' => 'meaty'],
            ['name' => 'Savory', 'slug' => 'savory'],
            ['name' => 'Classic', 'slug' => 'classic'],
            ['name' => 'Gluten-Free', 'slug' => 'gluten-free'],
            ['name' => 'Low-Carb', 'slug' => 'low-carb'],
            ['name' => 'Keto', 'slug' => 'keto'],
            ['name' => 'Vegan', 'slug' => 'vegan'],
            ['name' => 'Vegetarian', 'slug' => 'vegetarian'],
            ['name' => 'Pesto', 'slug' => 'pesto'],
            ['name' => 'BBQ', 'slug' => 'bbq'],
            ['name' => 'Meat Lovers', 'slug' => 'meat-lovers'],
            ['name' => 'Cheese Lovers', 'slug' => 'cheese-lovers'],
            ['name' => 'Pepperoni', 'slug' => 'pepperoni'],
            ['name' => 'Mushroom', 'slug' => 'mushroom'],
            ['name' => 'Onion', 'slug' => 'onion'],
            ['name' => 'Garlic', 'slug' => 'garlic'],
            ['name' => 'Tomato', 'slug' => 'tomato'],
            ['name' => 'Pineapple', 'slug' => 'pineapple'],
            ['name' => 'Spinach', 'slug' => 'spinach'],
            ['name' => 'Artichoke', 'slug' => 'artichoke'],
            ['name' => 'Parmesan', 'slug' => 'parmesan'],
            ['name' => 'Mozzarella', 'slug' => 'mozzarella'],
            ['name' => 'Provolone', 'slug' => 'provolone'],
            ['name' => 'Ricotta', 'slug' => 'ricotta'],
            ['name' => 'Feta', 'slug' => 'feta'],
            ['name' => 'Bacon', 'slug' => 'bacon'],
            ['name' => 'Sausage', 'slug' => 'sausage'],
            ['name' => 'Ham', 'slug' => 'ham'],
            ['name' => 'Salami', 'slug' => 'salami'],
            ['name' => 'Handmade', 'slug' => 'handmade'],
            ['name' => 'Wood Fired', 'slug' => 'wood-fired'],
            ['name' => 'Thin', 'slug' => 'thin'],
            ['name' => 'Crispy', 'slug' => 'crispy'],
        ];

        foreach ($tags as $tagData) {
            Tag::create($tagData);
        }

        $jacksDescription = "Pizza gimmicks will come and go. Pepperoni Pizza will never fade away. You can't do much better than crispy thin crust pizza with real cheese and scrumptious pepperoni.";
        $americanFlatbreadDescription = "Food remembers the acts of the hands and heart. American Flatbread is a return to bread’s roots, an endeavor to explore the possibilty of how good bread can be. Here, from the union of fire, rock, and the finest all natural ingredients, comes a carefully prepared handmade food that is nutritious, light, crisp, flavorful, and wonderfully convenient. Pizza with integrity.";
        $pizzas = [
            // American Flatbread
            [
                'name' => 'American Flatbread Cheese & Herb',
                'slug' => 'american-flatbread-cheese-herb',
                'description' => $americanFlatbreadDescription,
                'brand_id' => Brand::where('slug', 'american-flatbread')->first()->id,
                'style_id' => Style::where('slug', 'hand-tossed')->first()->id,
                'ingredients' => "Crust: 100% Organically Grown Wheat, Good Mountain Water, Organic Wheat Bran, Kosher Slat, Fresh Yeast. Toppings: Mozzarella Cheese (Whole Milk, Vegetable Rennet, Salt), Vermont's Blythedale Farm Padano Cheese (Whole Milk from Jersey Cows, Vegetable Rennet, Salt), Parmesan Cheese (Cultured Milk, Vegetable Rennet, Salt), Garlic Oil (Extra Virgin Olive Oil, Canola Oil, Fresh Garlic), Fresh Parsley, Herbs, Kosher Salt.",
                'allergens' => "Mile & Dairy, Wheat",
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
            ],
            // [
            //     'name' => 'Jack\'s Original Thin Pepperoni',
            //     'slug' => 'jacks-original-thin-pepperoni',
            //     'description' => $jacksDescription,
            //     'brand_id' => Brand::where('slug', 'jack-s')->first()->id,
            //     'style_id' => Style::where('slug', 'thin-crust')->first()->id,
            //     'ingredients' => "WATER, ENRICHED WHEAT FLOUR (WHEAT FLOUR, NIACIN, REDUCED IRON, THIAMINE MONONITRATE, RIBOFLAVIN, AND FOLIC ACID), LOW-MOISTURE PART-SKIM MOZZARELLA CHEESE (PART-SKIM MILK, CHEESE CULTURE, SALT, ENZYMES), PEPPERONI MADE WITH PORK, CHICKEN AND BEEF (PORK, MECHANICALLY SEPARATED CHICKEN, BEEF, SALT, CONTAINS 2% OR LESS OF SPICES, DEXTROSE, PORK STOCK, LACTIC ACID STARTER CULTURE, OLEORESIN OF PAPRIKA, FLAVORING, SODIUM NITRITE, SODIUM ASCORBATE, PAPRIKA, PROCESSED WITH NATURAL SMOKE FLAVOR, BHA, BHT, CITRIC ACID TO HELP PROTECT FLAVOR), TOMATO PASTE, 2% OR LESS OF VEGETABLE OIL (SOYBEAN OIL AND/OR CORN OIL), SEASONING (MODIFIED CORN STARCH, SALT, SUGAR, SPICES, DRIED GARLIC, CITRIC ACID), SUGAR, CELLULOSE POWDER, SALT, YEAST, L-CYSTEINE.",
            //     'tags' => ['spicy', 'cheesy'],
            //     'website' => 'https://www.goodnes.com/jacks/products/original-thin-pepperoni-pizza/',
            // ],
        ];


        foreach ($pizzas as $pizzaData) {
            $nutritionalFacts = $pizzaData['nutritional_facts'];
            unset($pizzaData['nutritional_facts']);
            $pizza = Pizza::create($pizzaData);
            NutritionFact::create([...$nutritionalFacts, 'pizza_id' => $pizza->id]);
        }
    }
}

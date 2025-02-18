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
            ['name' => 'Amy\'s', 'slug' => 'amys', 'image_name' => 'Amys.png', 'website' => 'https://www.amys.com/', 'description' => 'Amy’s Kitchen is a family-owned company that makes delicious organic and non-GMO convenience foods.'],
            ['name' => 'California Pizza Kitchen', 'slug' => 'california-pizza-kitchen', 'image_name' => 'CaliforniaPizzaKitchen.png', 'website' => 'https://www.cpk.com/', 'description' => 'California Pizza Kitchen is a casual dining restaurant chain that specializes in California-style pizza.'],
            ['name' => 'Digiorno', 'slug' => 'digiorno', 'image_name' => 'Digiorno.png', 'website' => 'https://www.digiorno.com/', 'description' => 'Digiorno is known for its rising crust pizzas.'],
            ['name' => 'Red Baron', 'slug' => 'red-baron', 'image_name' => 'RedBaron.png', 'website' => 'https://www.redbaron.com/', 'description' => 'Red Baron is famous for its classic crust pizzas.'],
            ['name' => 'Tombstone', 'slug' => 'tombstone', 'image_name' => 'Tombstone.png', 'website' => 'https://www.tombstonepizza.com/', 'description' => 'Tombstone offers a variety of classic frozen pizzas.'],
            ['name' => 'Tony\'s', 'slug' => 'tonys', 'image_name' => 'Tonys.png', 'website' => 'https://www.tonyspizza.com/', 'description' => 'Tony’s is known for its delicious frozen pizzas.'],
            ['name' => 'Udi\'s', 'slug' => 'udis', 'image_name' => 'Udis.png', 'website' => 'https://udisglutenfree.com/', 'description' => 'Udi’s offers gluten-free pizzas and other products.'],
            ['name' => 'Whole Foods', 'slug' => 'whole-foods', 'image_name' => 'WholeFoods.png', 'website' => 'https://www.wholefoodsmarket.com/', 'description' => 'Whole Foods Market is known for its organic and natural foods, including frozen pizzas.'],
            ['name' => 'Bellatoria', 'slug' => 'bellatoria', 'image_name' => 'Bellatoria.png', 'website' => 'https://www.bellatoria.com/', 'description' => 'Bellatoria offers a variety of frozen pizzas with gourmet toppings.'],
            ['name' => 'BOLD', 'slug' => 'bold', 'image_name' => 'BOLD.png', 'website' => 'https://www.boldpizzas.com/', 'description' => 'BOLD offers unique and flavorful frozen pizzas.'],
            ['name' => 'Caulipower', 'slug' => 'caulipower', 'image_name' => 'Caulipower.png', 'website' => 'https://www.caulipowerpizza.com/', 'description' => 'Caulipower specializes in cauliflower-based pizzas.'],
            ['name' => 'Celeste', 'slug' => 'celeste', 'image_name' => 'Celeste.png', 'website' => 'https://www.celestepizza.com/', 'description' => 'Celeste offers a variety of frozen pizzas at affordable prices.'],
            ['name' => 'Chopsies', 'slug' => 'chopsies', 'image_name' => 'Chopsies.png', 'website' => 'https://www.chopsies.com/', 'description' => 'Chopsies offers a variety of frozen pizzas with fresh ingredients.'],
            ['name' => 'Freschetta', 'slug' => 'freschetta', 'image_name' => 'Freschetta.png', 'website' => 'https://www.freschetta.com/', 'description' => 'Freschetta offers a variety of frozen pizzas with fresh ingredients.'],
            ['name' => 'Delissio', 'slug' => 'delissio', 'image_name' => 'Delissio.png', 'website' => 'https://www.delissio.com/', 'description' => 'Delissio offers a variety of frozen pizzas with unique flavors.'],
            ['name' => 'Gluseppe', 'slug' => 'gluseppe', 'image_name' => 'Gluseppe.png', 'website' => 'https://www.gluseppe.com/', 'description' => 'Gluseppe specializes in gourmet frozen pizzas.'],
            ['name' => 'Glutino', 'slug' => 'glutino', 'image_name' => 'Glutino.png', 'website' => 'https://www.glutino.com/', 'description' => 'Glutino offers gluten-free frozen pizza options.'],
            ['name' => 'GoodFellas', 'slug' => 'goodfellas', 'image_name' => 'GoodFellas.png', 'website' => 'https://www.goodfellas.com/', 'description' => 'GoodFellas is known for its authentic Italian frozen pizzas.'],
            ['name' => 'Home Run Inn', 'slug' => 'home-run-inn', 'image_name' => 'HomeRunInn.png', 'website' => 'https://www.homeruninn.com/', 'description' => 'Home Run Inn offers a variety of frozen pizzas inspired by their restaurant recipes.'],
            ['name' => 'Jacks', 'slug' => 'jacks', 'image_name' => 'Jacks.png', 'website' => 'https://www.jackspizza.com/', 'description' => 'Jack’s is known for its affordable and delicious frozen pizzas.'],
            ['name' => 'Jenos Pizza', 'slug' => 'jenos-pizza', 'image_name' => 'JenosPizza.png', 'website' => 'https://www.jenospizza.com/', 'description' => 'Jenos Pizza offers a variety of frozen pizza options.'],
            ['name' => 'Kashi', 'slug' => 'kashi', 'image_name' => 'Kashi.png', 'website' => 'https://www.kashi.com/', 'description' => 'Kashi provides healthy frozen pizza options made with wholesome ingredients.'],
            ['name' => 'Newmans', 'slug' => 'newmans', 'image_name' => 'Newmans.png', 'website' => 'https://www.newmansown.com/', 'description' => 'Newmans offers frozen pizzas made with organic ingredients.'],
            ['name' => 'Palermos', 'slug' => 'palermos', 'image_name' => 'Palermos.png', 'website' => 'https://www.palermos.com/', 'description' => 'Palermos specializes in authentic Italian frozen pizzas.'],
            ['name' => 'Sbarro', 'slug' => 'sbarro', 'image_name' => 'Sbarro.png', 'website' => 'https://www.sbarro.com/', 'description' => 'Sbarro is known for its New York-style frozen pizzas.'],
            ['name' => 'Screamin Sicilian', 'slug' => 'screamin-sicilian', 'image_name' => 'ScreaminSicilian.png', 'website' => 'https://www.screamin-sicilian.com/', 'description' => 'Screamin Sicilian offers bold and flavorful frozen pizzas.'],
            ['name' => 'The Take Away', 'slug' => 'the-take-away', 'image_name' => 'TheTakeAway.png', 'website' => 'https://www.thetakeaway.com/', 'description' => 'The Take Away provides a variety of frozen pizza options for quick meals.'],
            ['name' => 'Luiges', 'slug' => 'luiges', 'image_name' => 'Luiges.jpg', 'website' => 'https://www.luigespizza.com/', 'description' => 'Luige’s frozen pizza originated in 1952. After 30 years of making fresh pizzas, the group decided to move into the frozen category. In the local Turner halls people could eat free pizza every Tuesday and
Thursday. What the Luige’s people were doing was developing a taste profile. You could grab a slice of
pizza, but you would always have to vote if you liked it, and this went on for years. The end game was a
great tasting product, but also a product that was developed at a lower cost.
    During the 70s and 80s Luige’s was primarily a fundraising pizza and in the 90s, Luige’s moved into the tavern delivery business. Luige’s was wildly successful, and to this day is the premier brand in Wisconsin. In 2011 Luige’s launched retail distribution in the upper Midwest and was once again very successful. In a meeting in Chicago with some of the largest players in the US, the comment was made Wisconsin has Luige’s and a lot of companies that want to be like them.'],
        ];

        foreach ($brands as $brandData) {
            $image = ImageHandler::createFromExistingFile('public', "images/logos/frozen/{$brandData['image_name']}");
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
            $image = ImageHandler::createFromExistingFile('public', "images/styles/{$styleData['slug']}.png");
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
            ['name' => 'Rising Crust', 'slug' => 'rising-crust'],
            ['name' => 'Deluxe', 'slug' => 'deluxe'],
            ['name' => 'Supreme', 'slug' => 'supreme'],
            ['name' => 'Pub Style', 'slug' => 'pub-style'],
            ['name' => 'Homestyle', 'slug' => 'homestyle'],
        ];

        foreach ($tags as $tagData) {
            Tag::create($tagData);
        }
    }
}

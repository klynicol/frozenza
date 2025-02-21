<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use App\Handlers\PizzaSeedHandler;

class LuigesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pizzas = [
            // Fresh Italian Pizza
            [
                "name" => "Fresh Italian Cheese",
                "slug" => "fresh-italian-cheese",
                "description" => "A Cheese-Lover's pizza covered in Mozzarella Cheese",
                "tags" => ["classic", "cheesy"],
                "image_url" => "https://www.luigespizza.com/files/V20.jpg"
            ],
            [
                "name" => "Fresh Italian Cheese & Sausage",
                "slug" => "fresh-italian-cheese-sausage",
                "description" => "Made with Sausage and Mozzarella Cheese",
                "tags" => ["sausage", "cheesy"],
                "image_url" => "https://www.luigespizza.com/files/V21.jpg"
            ],
            [
                "name" => "Fresh Italian Pepperoni",
                "slug" => "fresh-italian-pepperoni",
                "description" => "A tasty original loaded with Pepperoni and Mozzarella Cheese",
                "tags" => ["pepperoni", "classic"],
                "image_url" => "https://www.luigespizza.com/files/V22.jpg"
            ],
            [
                "name" => "Fresh Italian Sausage & Peppers",
                "slug" => "fresh-italian-sausage-peppers",
                "description" => "Pork Sausage, Pepperoni, and Mozzarella Cheese",
                "tags" => ["sausage", "peppers"],
                "image_url" => "https://www.luigespizza.com/files/V23.jpg"
            ],
            [
                "name" => "Fresh Italian Sausage & Mushroom",
                "slug" => "fresh-italian-sausage-mushroom",
                "description" => "Fully loaded with Sausage, Mushrooms, and Mozzarella Cheese",
                "tags" => ["sausage", "mushroom"],
                "image_url" => "https://www.luigespizza.com/files/V24.jpg"
            ],
            [
                "name" => "Fresh Italian Deluxe",
                "slug" => "fresh-italian-deluxe",
                "description" => "Crafted with Sausage, Pepperoni, Mushrooms, Black Olives, Green Peppers, Onions, and Mozzarella Cheese",
                "tags" => ["deluxe"],
                "image_url" => "https://www.luigespizza.com/files/V25.jpg"
            ],
            [
                "name" => "Fresh Italian Supreme",
                "slug" => "fresh-italian-supreme",
                "description" => "A fan favorite topped with Sausage, Pepperoni, Green Peppers, Onions, and Red Peppers topped with Mozzarella Cheese",
                "tags" => ["supreme"],
                "image_url" => "https://www.luigespizza.com/files/V26.jpg"
            ],
            // Original "Homestyle" Pizza
            [
                "name" => "Original \"Homestyle\" Cheese",
                "slug" => "original-homestyle-cheese",
                "description" => "A Cheese Lover's classic topped with Mozzarella Cheese",
                "tags" => ["cheese"],
                "image_url" => "https://www.luigespizza.com/files/103.jpg"
            ],
            [
                "name" => "Original \"Homestyle\" Cheese & Sausage",
                "slug" => "original-homestyle-cheese-sausage",
                "description" => "Made with Sausage and Mozzarella Cheese",
                "tags" => ["cheese", "sausage"],
                "image_url" => "https://www.luigespizza.com/files/101.jpg"
            ],
            [
                "name" => "Original \"Homestyle\" Pepperoni",
                "slug" => "original-homestyle-pepperoni",
                "description" => "A tasty classic loaded with Pepperoni and Mozzarella Cheese",
                "tags" => ["pepperoni"],
                "image_url" => "https://www.luigespizza.com/files/Pepp.jpg"
            ],
            [
                "name" => "Original \"Homestyle\" Sausage & Pepperoni",
                "slug" => "original-homestyle-sausage-pepperoni",
                "description" => "Pork Sausage, Pepperoni, Topped with Mozzarella Cheese",
                "tags" => ["sausage", "pepperoni"],
                "image_url" => "https://www.luigespizza.com/files/Combo.jpg"
            ],
            [
                "name" => "Original \"Homestyle\" Deluxe",
                "slug" => "original-homestyle-deluxe",
                "description" => "Crafted with Sausage, Pepperoni, Mushrooms, Black Olives, Green Peppers, Onions, and Mozzarella Cheese",
                "tags" => ["deluxe"],
                "image_url" => "https://www.luigespizza.com/files/Deluxe.jpg"
            ],
            [
                "name" => "Original \"Homestyle\" Mighty Meaty",
                "slug" => "original-homestyle-mighty-meaty",
                "description" => "Fully Loaded with Sausage, Ham, Pepperoni, Smokey Bacon Bits, and Mozzarella Cheese",
                "tags" => ["meaty"],
                "image_url" => "https://www.luigespizza.com/files/Mighty%20Meaty.jpg"
            ],
            [
                "name" => "Original \"Homestyle\" Sausage & Mushroom",
                "slug" => "original-homestyle-sausage-mushroom",
                "description" => "Italian Sausage, Onions, Mushrooms, and Mozzarella Cheese",
                "tags" => ["sausage", "mushroom"],
                "image_url" => "https://www.luigespizza.com/files/102.jpg"
            ],
            [
                "name" => "Original \"Homestyle\" Sausage Mushroom & Onion",
                "slug" => "original-homestyle-sausage-mushroom-onion",
                "description" => "Italian Sausage, Onions, Mushrooms, and Mozzarella Cheese",
                "tags" => ["sausage", "mushroom", "onion"],
                "image_url" => "https://www.luigespizza.com/files/104.jpg"
            ],
            [
                "name" => "Original \"Homestyle\" Supreme",
                "slug" => "original-homestyle-supreme",
                "description" => "A fan favorite topped with Sausage, Pepperoni, Green Peppers, Onions, and Red Peppers topped with Mozzarella Cheese",
                "tags" => ["supreme"],
                "image_url" => "https://www.luigespizza.com/files/125.jpg"
            ],
            // Big Daddy Pub Style
            [
                "name" => "Big Daddy Pub Style 2x Pepperoni",
                "slug" => "big-daddy-pub-style-2x-pepperoni",
                "description" => "Pizza covered with double the Pepperoni and Mozzarella Cheese",
                "tags" => ["pepperoni", "cheesy"],
                "image_url" => "https://www.luigespizza.com/files/BD%20DoublePepp.jpg"
            ],
            [
                "name" => "Big Daddy Pub Style 2x Sausage & Pepperoni",
                "slug" => "big-daddy-pub-style-2x-sausage-pepperoni",
                "description" => "Loaded with double Sausage, double Pepperoni, and Mozzarella Cheese",
                "tags" => ["sausage", "pepperoni"],
                "image_url" => "https://www.luigespizza.com/files/BD%20Double%20SausageDouble%20Pepp.jpg"
            ],
            [
                "name" => "Big Daddy Pub Style 2x Sausage & Mushroom",
                "slug" => "big-daddy-pub-style-2x-sausage-mushroom",
                "description" => "A savory favorite with double Sausage, double Mushroom, and Mozzarella Cheese",
                "tags" => ["sausage", "mushroom"],
                "image_url" => "https://www.luigespizza.com/files/BD%20DBLSausageDBLMushroom.jpg"
            ],
            [
                "name" => "Big Daddy Pub Style 3x Sausage",
                "slug" => "big-daddy-pub-style-3x-sausage",
                "description" => "Fully loaded with 3 varieties of Italian Sausage, one of them being spicy.",
                "tags" => ["sausage", "spicy"],
                "image_url" => "https://www.luigespizza.com/files/BD%20TripleSausage.jpg"
            ],
            [
                "name" => "Big Daddy Pub Style Chicken Alfredo",
                "slug" => "big-daddy-pub-style-chicken-alfredo",
                "description" => "Creamy Alfredo Sauce and Chicken Breast smothered in Mozzarella Cheese",
                "tags" => ["chicken", "alfredo"],
                "image_url" => "https://www.luigespizza.com/files/BD%20ChickenAlfredo.jpg"
            ],
            [
                "name" => "Big Daddy Pub Style Mega Meaty",
                "slug" => "big-daddy-pub-style-mega-meaty",
                "description" => "Made with Spicy Italian Sausage, 2 Varieties of Seasoned Italian Sausage, Sliced and Diced Pepperoni",
                "tags" => ["meaty", "spicy"],
                "image_url" => "https://www.luigespizza.com/files/BD%20MegaMeaty.jpg"
            ],
            [
                "name" => "Big Daddy Pub Style 3x Cheese & 3x Meat",
                "slug" => "big-daddy-pub-style-3x-cheese-3x-meat",
                "description" => "Great things come in 3's! Italian Sausage, Pepperoni, and Spicy Italian Sausage topped with Mozzarella Cheese",
                "tags" => ["cheesy", "meaty"],
                "image_url" => "https://www.luigespizza.com/files/BD%20Triple%20Meat.jpg"
            ],
            [
                "name" => "Big Daddy Pub Style Garlic Dipper",
                "slug" => "big-daddy-pub-style-garlic-dipper",
                "description" => "A Garlic and Cheese loaded crust with a Marinara Packet for dipping. Proudly made with Wisconsin Cheese!",
                "tags" => ["garlic", "cheesy"],
                "image_url" => "https://www.luigespizza.com/files/BD%20GarlicDipper.jpg"
            ],
            [
                "name" => "Big Daddy Pub Style X-Tra Special",
                "slug" => "big-daddy-pub-style-x-tra-special",
                "description" => "This fully loaded pizza includes Italian Sausage, Pepperoni, Mushrooms, Green Peppers, Onions, and Black Olives",
                "tags" => ["deluxe", "special"],
                "image_url" => "https://www.luigespizza.com/files/BD%20XtraSpecial.jpg"
            ],
            // Fresh Dough
            [
                "name" => "Fresh Dough Pepperoni",
                "slug" => "fresh-dough-pepperoni",
                "description" => "An Classic Favorite with Pepperonis and Mozzarella Cheese Spread from Edge to Edge",
                "tags" => ["pepperoni", "classic"],
                "image_url" => "https://www.luigespizza.com/images/603.jpg"
            ],
            [
                "name" => "Fresh Dough Sausage & Pepperoni",
                "slug" => "fresh-dough-sausage-pepperoni",
                "description" => "A Tasty Combination of Italian Sausage and Pepperoni",
                "tags" => ["sausage", "pepperoni"],
                "image_url" => "https://www.luigespizza.com/images/605.jpg"
            ],
            [
                "name" => "Fresh Dough Gourmet Deluxe",
                "slug" => "fresh-dough-gourmet-deluxe",
                "description" => "There's a little bit of everything on this pizza! It includes Pepperoni, Sausage, Black Olives, Mushrooms, Red Peppers, Onions, and Green Peppers",
                "tags" => ["deluxe"],
                "image_url" => "https://www.luigespizza.com/images/602.jpg"
            ],
            [
                "name" => "Fresh Dough Sausage & Mushroom",
                "slug" => "fresh-dough-sausage-mushroom",
                "description" => "This Savory Favorite is Covered in Italian Sausage and Mushrooms on a Mozzarella Cheese Base",
                "tags" => ["sausage", "mushroom"],
                "image_url" => "https://www.luigespizza.com/images/601.jpg"
            ],
            [
                "name" => "Fresh Dough Breakfast Scramble",
                "slug" => "fresh-dough-breakfast-scramble",
                "description" => "Start Your Day Off Right with this Breakfast Pizza that's Loaded with Scrambled Eggs, Sausage, Bacon, Sprinkled with Mozzarella and Cheddar Cheese",
                "tags" => ["breakfast", "eggs"],
                "image_url" => "https://www.luigespizza.com/images/680.jpg"
            ],
            [
                "name" => "Fresh Dough Western Omelette",
                "slug" => "fresh-dough-western-omelette",
                "description" => "Add a Little Spice to your morning with this Breakfast Pizza loaded with Scrambled Eggs, Smoked Ham, Green Peppers, Onions, Sprinkled with Mozzarella and Cheddar Cheese",
                "tags" => ["breakfast", "eggs"],
                "image_url" => "https://www.luigespizza.com/images/690.jpg"
            ],
        ];

        $brand = Brand::where('slug', 'luiges')->first();
        foreach ($pizzas as $pizza) {
            PizzaSeedHandler::seedPizza($brand, $pizza);
        }
    }
}

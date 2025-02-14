<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Pizza;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Handlers\ImageHandler;

class LuigesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brand = Brand::where('slug', 'luiges')->first();

        $pizzas = [
            // Fresh Italian Pizza
            [
                "name" => "Fresh Italian Pizza Cheese",
                "slug" => "fresh-italian-pizza-cheese",
                "brand_id" => $brand->id,
                "description" => "A Cheese-Lover's pizza covered in Mozzarella Cheese",
                "tags" => ["classic", "cheesy"],
                "image_url" => "/files/V20.jpg"
            ],
            [
                "name" => "Fresh Italian Pizza Cheese & Sausage",
                "slug" => "fresh-italian-pizza-cheese-sausage",
                "brand_id" => $brand->id,
                "description" => "Made with Sausage and Mozzarella Cheese",
                "tags" => ["sausage", "cheesy"],
                "image_url" => "/files/V21.jpg"
            ],
            [
                "name" => "Fresh Italian Pizza Pepperoni",
                "slug" => "fresh-italian-pizza-pepperoni",
                "brand_id" => $brand->id,
                "description" => "A tasty original loaded with Pepperoni and Mozzarella Cheese",
                "tags" => ["pepperoni", "classic"],
                "image_url" => "/files/V22.jpg"
            ],
            [
                "name" => "Fresh Italian Pizza Sausage & Peppers",
                "slug" => "fresh-italian-pizza-sausage-peppers",
                "brand_id" => $brand->id,
                "description" => "Pork Sausage, Pepperoni, and Mozzarella Cheese",
                "tags" => ["sausage", "peppers"],
                'image_url' => "/files/V23.jpg"
            ],
            [
                "name" => "Fresh Italian Pizza Sausage & Mushroom",
                "slug" => "fresh-italian-pizza-sausage-mushroom",
                "brand_id" => $brand->id,
                "description" => "Fully loaded with Sausage, Mushrooms, and Mozzarella Cheese",
                "tags" => ["sausage", "mushroom"],
                "image_url" => "/files/V24.jpg"
            ],
            [
                "name" => "Fresh Italian Pizza Deluxe",
                "slug" => "fresh-italian-pizza-deluxe",
                "brand_id" => $brand->id,
                "description" => "Crafted with Sausage, Pepperoni, Mushrooms, Black Olives, Green Peppers, Onions, and Mozzarella Cheese",
                "tags" => ["deluxe"],
                "image_url" => "/files/V25.jpg"
            ],
            [
                "name" => "Fresh Italian Pizza Supreme",
                "slug" => "fresh-italian-pizza-supreme",
                "brand_id" => $brand->id,
                "description" => "A fan favorite topped with Sausage, Pepperoni, Green Peppers, Onions, and Red Peppers topped with Mozzarella Cheese",
                "tags" => ["supreme"],
                "image_url" => "/files/V26.jpg"
            ],
            // Original "Homestyle" Pizza
            [
                "name" => "Original \"Homestyle\" Pizza Cheese",
                "slug" => "original-homestyle-pizza-cheese",
                "brand_id" => $brand->id,
                "description" => "A Cheese Lover's classic topped with Mozzarella Cheese",
                "tags" => ["cheese"],
                "image_url" => "/files/103.jpg"
            ],
            [
                "name" => "Original \"Homestyle\" Pizza Cheese & Sausage",
                "slug" => "original-homestyle-pizza-cheese-sausage",
                "brand_id" => $brand->id,
                "description" => "Made with Sausage and Mozzarella Cheese",
                "tags" => ["cheese", "sausage"],
                "image_url" => "/files/101.jpg"
            ],
            [
                "name" => "Original \"Homestyle\" Pizza Pepperoni",
                "slug" => "original-homestyle-pizza-pepperoni",
                "brand_id" => $brand->id,
                "description" => "A tasty classic loaded with Pepperoni and Mozzarella Cheese",
                "tags" => ["pepperoni"],
                "image_url" => "/files/Pepp.jpg"
            ],
            [
                "name" => "Original \"Homestyle\" Pizza Sausage & Pepperoni",
                "slug" => "original-homestyle-pizza-sausage-pepperoni",
                "brand_id" => $brand->id,
                "description" => "Pork Sausage, Pepperoni, Topped with Mozzarella Cheese",
                "tags" => ["sausage", "pepperoni"],
                "image_url" => "/files/Combo.jpg"
            ],
            [
                "name" => "Original \"Homestyle\" Pizza Deluxe",
                "slug" => "original-homestyle-pizza-deluxe",
                "brand_id" => $brand->id,
                "description" => "Crafted with Sausage, Pepperoni, Mushrooms, Black Olives, Green Peppers, Onions, and Mozzarella Cheese",
                "tags" => ["deluxe"],
                "image_url" => "/files/Deluxe.jpg"
            ],
            [
                "name" => "Original \"Homestyle\" Pizza Mighty Meaty",
                "slug" => "original-homestyle-pizza-mighty-meaty",
                "brand_id" => $brand->id,
                "description" => "Fully Loaded with Sausage, Ham, Pepperoni, Smokey Bacon Bits, and Mozzarella Cheese",
                "tags" => ["meaty"],
                "image_url" => "/files/Mighty%20Meaty.jpg"
            ],
            [
                "name" => "Original \"Homestyle\" Pizza Sausage & Mushroom",
                "slug" => "original-homestyle-pizza-sausage-mushroom",
                "brand_id" => $brand->id,
                "description" => "Italian Sausage, Onions, Mushrooms, and Mozzarella Cheese",
                "tags" => ["sausage", "mushroom"],
                "image_url" => "/files/102.jpg"
            ],
            [
                "name" => "Original \"Homestyle\" Pizza Sausage Mushroom & Onion",
                "slug" => "original-homestyle-pizza-sausage-mushroom-onion",
                "brand_id" => $brand->id,
                "description" => "Italian Sausage, Onions, Mushrooms, and Mozzarella Cheese",
                "tags" => ["sausage", "mushroom", "onion"],
                "image_url" => "/files/104.jpg"
            ],
            [
                "name" => "Original \"Homestyle\" Pizza Supreme",
                "slug" => "original-homestyle-pizza-supreme",
                "brand_id" => $brand->id,
                "description" => "A fan favorite topped with Sausage, Pepperoni, Green Peppers, Onions, and Red Peppers topped with Mozzarella Cheese",
                "tags" => ["supreme"],
                "image_url" => "/files/125.jpg"
            ],
            // Big Daddy Pub Style
            [
                "name" => "Big Daddy Pub Style 2x Pepperoni",
                "slug" => "big-daddy-pub-style-2x-pepperoni",
                "brand_id" => $brand->id,
                "description" => "Pizza covered with double the Pepperoni and Mozzarella Cheese",
                "tags" => ["pepperoni", "cheesy"],
                "image_url" => "/files/BD%20DoublePepp.jpg"
            ],
            [
                "name" => "Big Daddy Pub Style 2x Sausage & Pepperoni",
                "slug" => "big-daddy-pub-style-2x-sausage-pepperoni",
                "brand_id" => $brand->id,
                "description" => "Loaded with double Sausage, double Pepperoni, and Mozzarella Cheese",
                "tags" => ["sausage", "pepperoni"],
                "image_url" => "/files/BD%20Double%20Sausage%20Double%20Pepp.jpg"
            ],
            [
                "name" => "Big Daddy Pub Style 2x Sausage & Mushroom",
                "slug" => "big-daddy-pub-style-2x-sausage-mushroom",
                "brand_id" => $brand->id,
                "description" => "A savory favorite with double Sausage, double Mushroom, and Mozzarella Cheese",
                "tags" => ["sausage", "mushroom"],
                "image_url" => "/files/BD%20DBLSausageDBLMushroom.jpg"
            ],
            [
                "name" => "Big Daddy Pub Style 3x Sausage",
                "slug" => "big-daddy-pub-style-3x-sausage",
                "brand_id" => $brand->id,
                "description" => "Fully loaded with 3 varieties of Italian Sausage, one of them being spicy.",
                "tags" => ["sausage", "spicy"],
                "image_url" => "/files/BD%20TripleSausage.jpg"
            ],
            [
                "name" => "Big Daddy Pub Style Chicken Alfredo",
                "slug" => "big-daddy-pub-style-chicken-alfredo",
                "brand_id" => $brand->id,
                "description" => "Creamy Alfredo Sauce and Chicken Breast smothered in Mozzarella Cheese",
                "tags" => ["chicken", "alfredo"],
                "image_url" => "/files/BD%20ChickenAlfredo.jpg"
            ],
            [
                "name" => "Big Daddy Pub Style Mega Meaty",
                "slug" => "big-daddy-pub-style-mega-meaty",
                "brand_id" => $brand->id,
                "description" => "Made with Spicy Italian Sausage, 2 Varieties of Seasoned Italian Sausage, Sliced and Diced Pepperoni",
                "tags" => ["meaty", "spicy"],
                "image_url" => "/files/BD%20MegaMeaty.jpg"
            ],
            [
                "name" => "Big Daddy Pub Style 3x Cheese & 3x Meat",
                "slug" => "big-daddy-pub-style-3x-cheese-3x-meat",
                "brand_id" => $brand->id,
                "description" => "Great things come in 3's! Italian Sausage, Pepperoni, and Spicy Italian Sausage topped with Mozzarella Cheese",
                "tags" => ["cheesy", "meaty"],
                "image_url" => "/files/BD%20Triple%20Meat.jpg"
            ],
            [
                "name" => "Big Daddy Pub Style Garlic Dipper",
                "slug" => "big-daddy-pub-style-garlic-dipper",
                "brand_id" => $brand->id,
                "description" => "A Garlic and Cheese loaded crust with a Marinara Packet for dipping. Proudly made with Wisconsin Cheese!",
                "tags" => ["garlic", "cheesy"],
                "image_url" => "/files/BD%20GarlicDipper.jpg"
            ],
            [
                "name" => "Big Daddy Pub Style X-Tra Special",
                "slug" => "big-daddy-pub-style-x-tra-special",
                "brand_id" => $brand->id,
                "description" => "This fully loaded pizza includes Italian Sausage, Pepperoni, Mushrooms, Green Peppers, Onions, and Black Olives",
                "tags" => ["deluxe", "special"],
                "image_url" => "/files/BD%20XtraSpecial.jpg"
            ],
            // Fresh Dough
            [
                "name" => "Fresh Dough Pepperoni",
                "slug" => "fresh-dough-pepperoni",
                "brand_id" => $brand->id,
                "description" => "An Classic Favorite with Pepperonis and Mozzarella Cheese Spread from Edge to Edge",
                "tags" => ["pepperoni", "classic"],
                "image_url" => "/images/603.jpg"
            ],
            [
                "name" => "Fresh Dough Sausage & Pepperoni",
                "slug" => "fresh-dough-sausage-pepperoni",
                "brand_id" => $brand->id,
                "description" => "A Tasty Combination of Italian Sausage and Pepperoni",
                "tags" => ["sausage", "pepperoni"],
                "image_url" => "/images/605.jpg"
            ],
            [
                "name" => "Fresh Dough Gourmet Deluxe",
                "slug" => "fresh-dough-gourmet-deluxe",
                "brand_id" => $brand->id,
                "description" => "There's a little bit of everything on this pizza! It includes Pepperoni, Sausage, Black Olives, Mushrooms, Red Peppers, Onions, and Green Peppers",
                "tags" => ["deluxe"],
                "image_url" => "/images/602.jpg"
            ],
            [
                "name" => "Fresh Dough Sausage & Mushroom",
                "slug" => "fresh-dough-sausage-mushroom",
                "brand_id" => $brand->id,
                "description" => "This Savory Favorite is Covered in Italian Sausage and Mushrooms on a Mozzarella Cheese Base",
                "tags" => ["sausage", "mushroom"],
                "image_url" => "/images/601.jpg"
            ],
            [
                "name" => "Fresh Dough Breakfast Scramble",
                "slug" => "fresh-dough-breakfast-scramble",
                "brand_id" => $brand->id,
                "description" => "Start Your Day Off Right with this Breakfast Pizza that's Loaded with Scrambled Eggs, Sausage, Bacon, Sprinkled with Mozzarella and Cheddar Cheese",
                "tags" => ["breakfast", "eggs"],
                "image_url" => "/images/680.jpg"
            ],
            [
                "name" => "Fresh Dough Western Omelette",
                "slug" => "fresh-dough-western-omelette",
                "brand_id" => $brand->id,
                "description" => "Add a Little Spice to your morning with this Breakfast Pizza loaded with Scrambled Eggs, Smoked Ham, Green Peppers, Onions, Sprinkled with Mozzarella and Cheddar Cheese",
                "tags" => ["breakfast", "eggs"],
                "image_url" => "/images/690.jpg"
            ],
        ];

        foreach ($pizzas as $pizza) {
            if (isset($pizza['image_url'])) {
                $image = ImageHandler::createFromUrl(
                    "https://www.luigespizza.com" . $pizza['image_url'],
                    'public',
                    'images/pizzas/' . $brand->slug . '/frozen',
                    $pizza['slug']
                );
                if ($image) {
                    $pizza['image_id'] = $image->id;
                }
                unset($pizza['image_url']);
            }
            Pizza::create($pizza);
        }
    }
}

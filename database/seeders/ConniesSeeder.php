<?php

namespace Database\Seeders;

use App\Handlers\ImageHandler;
use App\Handlers\PizzaSeedHandler;
use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brand = Brand::updateOrCreate([
            'slug' => 'connies',
        ], [
            'name' => "Connie's",
            'website' => 'https://www.conniesnaturals.com/',
            'brand_story' => 'Connie’s Pizza began in 1963 when Jim Stolfe traded his 1962 Oldsmobile Starfire for a small pizzeria on Chicago’s South Side. Retaining the name “Connie’s,” Stolfe developed a signature pizza dough recipe inspired by his grandmother and a local baker. His small pizza stand quickly grew in popularity, leading him to open his first freestanding location within a year. During the 1970s and 1980s, Connie’s Pizza expanded across Chicago, becoming a staple at venues such as Soldier Field and McCormick Place. The company also pioneered heated pizza delivery trucks, ensuring fresh, hot pizza reached customers even in the coldest Chicago winters. By the 1990s, Connie’s ventured into the frozen pizza market, supplying hotels and grocery stores with high-quality frozen versions of their famous pizzas. Today, Connie’s Pizza remains a Chicago institution, still family-owned and committed to quality. Their frozen pizzas reflect decades of innovation and tradition, bringing the authentic taste of Chicago-style pizza to homes across the country.',
            'founded_year' => '1963',
            'description' => 'Connie’s Frozen Pizza delivers the same Chicago-style quality and passion found in its iconic restaurants, directly to your home. Crafted with specially formulated recipes, these frozen pizzas offer a premium taste and texture that stays true to the original Connie’s experience. Known for their rich flavors, crispy-yet-chewy crust, and authentic ingredients, Connie’s Frozen Pizzas are designed to go straight from your freezer to the oven, maintaining the same high-quality standards that made the brand famous in Chicago. Headquartered in Chicago, Illinois, with manufacturing facilities at 2455 S. Damen Ave., Suite 100, Chicago, IL 60608, Connie’s continues to innovate while preserving its legacy of great pizza.',
        ]);

        if (!$brand->image) {
            $image = ImageHandler::createFromUrl(
                'https://www.conniesnaturals.com/Theme/Connies/images/logo_new.png', // url
                'public',
                'images/logos/frozen',
                'Connies' // name - no extension
            );
            $brand->image_id = $image->id;
            $brand->save();
        }

        $pizzas = [
        ];

        foreach ($pizzas as $pizza) {
            PizzaSeedHandler::seedPizza($brand, $pizza);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Handlers\ImageHandler;
use App\Handlers\PizzaSeedHandler;
use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CappellosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brand = Brand::updateOrCreate([
            'slug' => '',
        ], [
            'name' => '',
            'website' => '',
            'brand_story' => '',
            'founded_year' => '',
            'description' => '',
        ]);

        if (!$brand->image) {
            $image = ImageHandler::createFromUrl(
                '', // url
                'public',
                'images/logos/frozen',
                '' // name - no extension
            );
            $brand->image_id = $image->id;
            $brand->save();
        }

        $pizzas = [
            [
                'name' => "",
                'slug' => "",
                'tags' => [],
                'description' => "",
                'image_url' => "",
                'ingredients' => "",
                'allergens' => "",
                'nutritional_facts' => [
                    'serving_per_container' => '',
                    'serving_size' => '',
                    'calories' => '',
                    'total_fat' => '',
                    'saturated_fat' => '',
                    'trans_fat' => '',
                    'cholesterol' => '',
                    'sodium' => '',
                    'total_carbohydrate' => '',
                    'dietary_fiber' => '',
                    'total_sugars' => '',
                    'added_sugars' => '',
                    'protein' => '',
                    'vitamin_d' => '',
                    'calcium' => '',
                    'iron' => '',
                    'potassium' => '',
                    'monounsaturated_fat' => '',
                    'polyunsaturated_fat' => '',
                    'vitamin_a' => '',
                    'vitamin_c' => '',
                ]
            ],
        ];

        foreach ($pizzas as $pizza) {
            PizzaSeedHandler::seedPizza($brand, $pizza);
        }
    }
}

<?php

namespace App\Handlers;

use App\Models\Brand;
use App\Models\Pizza;
use App\Handlers\ImageHandler;
use App\Models\NutritionFact;

class PizzaSeedHandler
{
   public static function seedPizza(Brand $brand, array $pizza)
   {
      $nutritionalFacts = $pizza['nutritional_facts'] ?? null;
      if (isset($pizza['nutritional_facts'])) {
         unset($pizza['nutritional_facts']);
      }
      if (isset($pizza['image_url'])) {
         $image = ImageHandler::createFromUrl(
            $pizza['image_url'],
            'public',
            'images/pizzas/' . $brand->slug . '/frozen',
            $pizza['slug']
         );
         if ($image) {
            $pizza['image_id'] = $image->id;
         }
         unset($pizza['image_url']);
      }
      $pizza = Pizza::create([...$pizza, 'brand_id' => $brand->id]);
      if ($nutritionalFacts) {
         NutritionFact::create([...$nutritionalFacts, 'pizza_id' => $pizza->id]);
      }
   }
}

<?php

namespace App\Handlers;

use App\Models\Brand;
use App\Models\Pizza;
use App\Handlers\ImageHandler;
use App\Models\Image;
use App\Models\NutritionFact;
use App\Enums\PizzaImageType;

class PizzaSeedHandler
{
   /**
    * Seed a pizza from the array structure
    *
    * @param Brand $brand
    * @param array $pizza
    * @return void
    */
   public static function seedPizza(Brand $brand, array $pizza): void
   {
      $image = null;
      if (isset($pizza['image_url'])) {
         $path = "images/pizzas/{$brand->slug}/frozen";
         $image = Image::where('path', $path)
            ->where('name', 'like', '%' . $pizza['slug'] . '%')
            ->first()
            ?? ImageHandler::createFromUrl(
               $pizza['image_url'],
               'public',
               'images/pizzas/' . $brand->slug . '/frozen',
               $pizza['slug']
            );
         unset($pizza['image_url']);
      }

      $nutritionalFacts = $pizza['nutritional_facts'] ?? null;
      unset($pizza['nutritional_facts']);

      $pizza = Pizza::updateOrCreate([
         'brand_id' => $brand->id,
         'slug' => $pizza['slug']
      ], [...$pizza]);

      if ($image && !$pizza->images()->where('id', $image->id)->exists()) {
         $pizza->images()->withTimestamps()->attach($image, [
            'image_id' => $image->id,
            'type' => PizzaImageType::MAIN
         ]);
      }

      if ($nutritionalFacts) {
         NutritionFact::updateOrCreate([
            'pizza_id' => $pizza->id
         ], [...$nutritionalFacts]);
      }
   }
}

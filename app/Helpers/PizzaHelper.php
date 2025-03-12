<?php

namespace App\Helpers;

use App\Models\Pizza;

class PizzaHelper
{
   const PIZZAS_PER_PAGE = 12;

   public static function getPizzasPaginated($page = 1)
   {
      return Pizza::orderBy('average_rating', 'desc')
         ->with(['brand.image', 'tags', 'images' => function ($query) {
            $query->withPivot('type', 'created_at');
         }])
         ->paginate(self::PIZZAS_PER_PAGE, ['*'], 'page', $page);
   }
}

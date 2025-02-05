<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailedNutritionFacts extends Model
{
    protected $fillable = [
        'pizza_id',
        'serving_size',
        'serving_unit',
        'calories',
        'total_fat',
        'saturated_fat',
        'trans_fat',
        'cholesterol',
        'sodium',
        'total_carbohydrate',
        'dietary_fiber',
        'total_sugars',
        'added_sugars',
        'protein',
    ];

    public function pizza(): BelongsTo
    {
        return $this->belongsTo(Pizza::class);
    }
} 
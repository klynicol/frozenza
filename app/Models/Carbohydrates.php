<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Carbohydrates extends Model
{
    protected $fillable = [
        'nutrition_facts_id',
        'total_carbohydrate',
        'dietary_fiber',
        'total_sugars',
        'added_sugars',
    ];

    public function nutritionFacts(): BelongsTo
    {
        return $this->belongsTo(NutritionFacts::class);
    }
} 
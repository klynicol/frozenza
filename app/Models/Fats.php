<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fats extends Model
{
    protected $fillable = [
        'nutrition_facts_id',
        'total_fat',
        'saturated_fat',
        'trans_fat',
    ];

    public function nutritionFacts(): BelongsTo
    {
        return $this->belongsTo(NutritionFacts::class);
    }
} 
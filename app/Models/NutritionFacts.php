<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class NutritionFacts extends Model
{
    protected $fillable = [
        'pizza_id',
        'calories',
        'protein',
    ];

    public function pizza(): BelongsTo
    {
        return $this->belongsTo(Pizza::class);
    }

    public function fats(): HasOne
    {
        return $this->hasOne(Fats::class);
    }

    public function carbohydrates(): HasOne
    {
        return $this->hasOne(Carbohydrates::class);
    }
} 
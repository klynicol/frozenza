<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property string $pizza_id
 * @property int|null $serving_size
 * @property string|null $serving_unit
 * @property int $calories
 * @property int $total_fat
 * @property int|null $saturated_fat
 * @property int|null $trans_fat
 * @property int|null $cholesterol
 * @property int|null $sodium
 * @property int $total_carbohydrate
 * @property int|null $dietary_fiber
 * @property int|null $total_sugars
 * @property int|null $added_sugars
 * @property int $protein
 * @property int|null $vitamin_d
 * @property int|null $calcium
 * @property int|null $iron
 * @property int|null $potassium
 * @property int|null $monounsaturated_fat
 * @property int|null $polyunsaturated_fat
 * @property int|null $vitamin_a
 * @property int|null $vitamin_c
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Pizza $pizza
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereAddedSugars($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereCalcium($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereCalories($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereCholesterol($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereDietaryFiber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereIron($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereMonounsaturatedFat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact wherePizzaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact wherePolyunsaturatedFat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact wherePotassium($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereProtein($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereSaturatedFat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereServingSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereServingUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereSodium($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereTotalCarbohydrate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereTotalFat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereTotalSugars($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereTransFat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereVitaminA($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereVitaminC($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereVitaminD($value)
 * @mixin \Eloquent
 */
class NutritionFact extends Model
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
        'vitamin_d',
        'calcium',
        'iron',
        'potassium',
        'monounsaturated_fat',
        'polyunsaturated_fat',
        'vitamin_a',
        'vitamin_c',
    ];

    public function pizza(): BelongsTo
    {
        return $this->belongsTo(Pizza::class);
    }
}

<?php

namespace App\Models;

use App\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * @property string $id
 * @property string $pizza_id
 * @property int|null $serving_per_container
 * @property string|null $serving_fraction
 * @property int|null $serving_weight
 * @property int $calories
 * @property string $total_fat
 * @property string|null $saturated_fat
 * @property string|null $trans_fat
 * @property string|null $cholesterol
 * @property string|null $sodium
 * @property string $total_carbohydrate
 * @property string|null $dietary_fiber
 * @property string|null $total_sugars
 * @property string|null $added_sugars
 * @property string $protein
 * @property string|null $vitamin_d
 * @property string|null $calcium
 * @property string|null $iron
 * @property string|null $potassium
 * @property string|null $monounsaturated_fat
 * @property string|null $polyunsaturated_fat
 * @property string|null $vitamin_a
 * @property string|null $vitamin_c
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereServingPerContainer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereServingFraction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NutritionFact whereServingWeight($value)
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
class NutritionFact extends BaseModel
{
    use HasFactory, HasUuids;
    
    protected $fillable = [
        'pizza_id',
        'serving_per_container',
        'serving_fraction',
        'serving_weight',
        'calories',
        'caloris_from_fat',
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

    protected $casts = [
        'calories' => 'integer',
        'serving_per_container' => 'integer',
        'serving_weight' => 'integer',
    ];

    public function pizza(): BelongsTo
    {
        return $this->belongsTo(Pizza::class);
    }
}

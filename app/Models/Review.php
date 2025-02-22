<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

/**
 * 
 *
 * @property string $id
 * @property string $overall_rating
 * @property string $appearance_rating
 * @property string $texture_rating
 * @property string $flavor_rating
 * @property string|null $average_rating_date Date when this review was used to calculate the average rating
 * @property string|null $review
 * @property string|null $purchase_location
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $pizza_id
 * @property string $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Image> $images
 * @property-read int|null $images_count
 * @property-read \App\Models\Pizza $pizza
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereAppearanceRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereAverageRatingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereFlavorRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereOverallRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review wherePizzaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review wherePurchaseLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereTextureRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Review whereUserId($value)
 * @mixin \Eloquent
 */
class Review extends Model
{
    use HasUuid;

    protected $fillable = [
        'pizza_id',
        'user_id',
        'appearance_rating',
        'texture_rating',
        'flavor_rating',
        'review',
        'purchase_location',
        'purchase_date'
    ];

    protected $casts = [
        'rating' => 'float',
        'purchase_date' => 'date'
    ];

    public function pizza(): BelongsTo
    {
        return $this->belongsTo(Pizza::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'review_images')
            ->withPivot('order')
            ->orderBy('order');
    }

    public static function imageTypes(): array
    {
        return [
            'front' => 'Front of Box',
            'back' => 'Back of Box',
            'side' => 'Side of Box',
            'cooked' => 'Cooked Pizza',
            'slice' => 'Slice of Pizza',
            'ingredients' => 'Ingredients',
            'nutrition_facts' => 'Nutrition Facts',
            'other' => 'Other',
        ];
    }
}

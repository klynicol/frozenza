<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * 
 *
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string|null $ingredients
 * @property float $average_rating
 * @property string $average_appearance_rating
 * @property string $average_texture_rating
 * @property string $average_flavor_rating
 * @property int $total_reviews
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $brand_id
 * @property string|null $website
 * @property string|null $allergens
 * @property-read \App\Models\Brand $brand
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Image> $images
 * @property-read int|null $images_count
 * @property-read \App\Models\NutritionFact|null $nutritionFact
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Review> $reviews
 * @property-read int|null $reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereAllergens($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereAverageAppearanceRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereAverageFlavorRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereAverageRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereAverageTextureRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereIngredients($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereTotalReviews($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereWebsite($value)
 * @mixin \Eloquent
 */
class Pizza extends Model implements Sitemapable
{
    use HasUuid;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'ingredients',
        'average_rating',
        'total_reviews',
        'brand_id',
        'image_url'
    ];

    protected $casts = [
        'tags' => 'array',
        'average_rating' => 'float',
    ];

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'pizza_images');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function nutritionFact(): HasOne
    {
        return $this->hasOne(NutritionFact::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Flags for this pizza (table_name = 'pizzas', flagable_id = id).
     */
    public function flags(): HasMany
    {
        return $this->hasMany(Flag::class, 'flagable_id', 'id')->where('table_name', 'pizzas');
    }

    /**
     * Get the affiliate links for the pizza.
     */
    public function affiliateLinks(): HasMany
    {
        return $this->hasMany(AffiliateLink::class)->where('is_active', true)->orderBy('display_order');
    }

    public function toSitemapTag(): Url
    {
        return Url::create("/pizzas/{$this->brand->slug}/{$this->slug}")
            ->setLastModificationDate(Carbon::parse($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(0.7);
    }

    /**
     * Scope: only pizzas that have a flag with the given value.
     * Defaults to f_value_1; pass column as second argument for f_value_2.
     *
     * @param  string  $value   e.g. 'needs_attention', 'process'
     * @param  string  $column  'f_value_1' or 'f_value_2'
     */
    public function scopeWhereFlag(Builder $query, string $value, string $column = 'f_value_1'): Builder
    {
        return $query->whereHas('flags', fn (Builder $q) => $q->where($column, $value));
    }

    public function updateAverageRating(): void
    {
        $this->average_appearance_rating = $this->calculateAverageRating('appearance_rating');
        $this->average_texture_rating = $this->calculateAverageRating('texture_rating');
        $this->average_flavor_rating = $this->calculateAverageRating('flavor_rating');
        $this->average_rating =
            ($this->average_appearance_rating +
                $this->average_texture_rating +
                $this->average_flavor_rating) / 3;
        $this->total_reviews = $this->reviews()->count();
        $this->save();
    }

    private function calculateAverageRating(string $ratingType): float
    {
        $reviews = $this->reviews()->whereNotNull($ratingType)
            ->whereNull('average_rating_date')
            ->get();
        if ($reviews->isEmpty()) {
            return 0;
        }
        $totalRating = 0;
        $count = 0;
        foreach ($reviews as $review) {
            $totalRating += $review->$ratingType;
            $count++;
        }
        return $totalRating / $count;
    }
}

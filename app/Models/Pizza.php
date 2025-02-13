<?php

namespace App\Models;

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
 * @property string $ingredients
 * @property float $average_rating
 * @property int $total_reviews
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $tags
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $brand_id
 * @property string $style_id
 * @property string|null $image_id
 * @property string|null $website
 * @property string|null $allergens
 * @property-read \App\Models\Brand $brand
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\NutritionFact|null $nutritionFact
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Review> $reviews
 * @property-read int|null $reviews_count
 * @property-read \App\Models\Style $style
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereAllergens($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereAverageRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereIngredients($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereStyleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pizza whereTags($value)
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
        'style_id',
        'image_url'
    ];

    protected $casts = [
        'tags' => 'array',
        'average_rating' => 'float',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function style(): BelongsTo
    {
        return $this->belongsTo(Style::class);
    }

    public function nutritionFact(): HasOne
    {
        return $this->hasOne(NutritionFact::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function toSitemapTag(): Url
    {
        return Url::create("/pizzas/{$this->brand->slug}/{$this->slug}")
            ->setLastModificationDate(Carbon::parse($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(0.7);
    }

    public function updateAverageRating(): void
    {
        $this->average_rating = $this->reviews()->avg('rating') ?? 0;
        $this->total_reviews = $this->reviews()->count();
        $this->save();
    }
} 
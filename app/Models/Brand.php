<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
/**
 * 
 *
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string|null $website
 * @property string|null $image_id
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property string|null $seo_about_content
 * @property array<array-key, mixed>|null $seo_keywords
 * @property string|null $unique_selling_points
 * @property array<array-key, mixed>|null $social_media_handles
 * @property string|null $brand_story
 * @property string|null $founded_year
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Image|null $image
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pizza> $pizzas
 * @property-read int|null $pizzas_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereBrandStory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereFoundedYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereSeoAboutContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereSeoKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereSocialMediaHandles($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereUniqueSellingPoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereWebsite($value)
 * @mixin \Eloquent
 */
class Brand extends Model implements Sitemapable
{
    use HasUuid;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'website',
        'image_id',
        'seo_title',
        'seo_description',
        'seo_about_content',
        'seo_keywords',
        'unique_selling_points',
        'social_media_handles',
        'brand_story',
        'founded_year',
        'store_locator_url',
    ];

    protected $casts = [
        'seo_faq_questions' => 'array',
        'seo_keywords' => 'array',
        'social_media_handles' => 'array',
        'unique_selling_points' => 'array',
    ];

    public function pizzas(): HasMany
    {
        return $this->hasMany(Pizza::class);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }

    public function toSitemapTag(): Url
    {
        return Url::create("/brands/{$this->slug}/pizzas")
            ->setLastModificationDate(Carbon::parse($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.8);
    }
} 
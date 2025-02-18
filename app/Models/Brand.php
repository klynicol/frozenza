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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Image|null $image
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pizza> $pizzas
 * @property-read int|null $pizzas_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Brand whereSlug($value)
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
        'seo_faq_questions',
        'seo_about_content',
        'seo_keywords',
        'cooking_instructions',
        'unique_selling_points',
        'social_media_handles',
        'brand_story',
        'founded_year',
        'headquarters_location'
    ];

    protected $casts = [
        'seo_faq_questions' => 'array',
        'seo_keywords' => 'array',
        'social_media_handles' => 'array',
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
        return Url::create("/brands/{$this->slug}")
            ->setLastModificationDate(Carbon::parse($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.8);
    }

    public function getMetaTitle(): string
    {
        if ($this->seo_title) {
            return $this->seo_title;
        }

        return "{$this->name} Frozen Pizzas | Reviews & Ratings";
    }

    public function getMetaDescription(): string
    {
        if ($this->seo_description) {
            return $this->seo_description;
        }

        return "Discover {$this->name}'s frozen pizza selection. Read reviews, nutritional information, and find your favorite varieties.";
    }

    public function getFAQQuestions(): array
    {
        if ($this->seo_faq_questions) {
            return $this->seo_faq_questions;
        }

        // Default FAQ questions if none are set
        return [
            [
                'question' => "What types of frozen pizzas does {$this->name} make?",
                'answer' => "Browse our comprehensive selection of {$this->name} frozen pizzas, complete with detailed reviews and nutritional information."
            ],
            [
                'question' => "Where can I buy {$this->name} frozen pizzas?",
                'answer' => "{$this->name} frozen pizzas are available at many major grocery stores and supermarkets across the United States."
            ]
        ];
    }

    public function getAboutContent(): string
    {
        if ($this->seo_about_content) {
            return $this->seo_about_content;
        }

        return $this->description;
    }

    public function getSchemaMarkup(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Brand',
            'name' => $this->name,
            'description' => $this->getMetaDescription(),
            'url' => $this->website,
            'logo' => $this->image ? url($this->image->path . '/' . $this->image->name) : null,
            'foundingDate' => $this->founded_year,
            'location' => [
                '@type' => 'Place',
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressLocality' => $this->headquarters_location
                ]
            ],
            'sameAs' => array_values($this->social_media_handles ?? [])
        ];
    }
} 
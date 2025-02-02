<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;

class Brand extends Model implements Sitemapable
{
    protected $fillable = ['name', 'slug', 'description', 'website'];

    public function pizzas(): HasMany
    {
        return $this->hasMany(Pizza::class);
    }

    public function toSitemapTag(): Url
    {
        return Url::create("/brands/{$this->slug}")
            ->setLastModificationDate(Carbon::parse($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.8);
    }
} 
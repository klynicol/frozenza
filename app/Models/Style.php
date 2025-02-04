<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;
use App\Traits\HasUuid;

class Style extends Model implements Sitemapable
{
    use HasUuid;

    protected $fillable = ['name', 'slug', 'description'];

    public function pizzas(): HasMany
    {
        return $this->hasMany(Pizza::class);
    }

    public function toSitemapTag(): Url
    {
        return Url::create("/styles/{$this->slug}")
            ->setLastModificationDate(Carbon::parse($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.8);
    }
}

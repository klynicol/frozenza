<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;
use App\Traits\HasUuid;

/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pizza> $pizzas
 * @property-read int|null $pizzas_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category query()
 * @mixin \Eloquent
 */
class Category extends Model implements Sitemapable
{
    use HasUuid;
    protected $fillable = ['name', 'slug', 'description'];

    public function pizzas(): BelongsToMany
    {
        return $this->belongsToMany(Pizza::class);
    }

    public function toSitemapTag(): Url
    {
        return Url::create("/categories/{$this->slug}")
            ->setLastModificationDate(Carbon::parse($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.8);
    }
} 
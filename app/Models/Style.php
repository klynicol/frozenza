<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;
use App\Traits\HasUuid;

/**
 * 
 *
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string|null $image_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pizza> $pizzas
 * @property-read int|null $pizzas_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Style newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Style newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Style query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Style whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Style whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Style whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Style whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Style whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Style whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Style whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Style extends Model implements Sitemapable
{
    use HasUuid;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_id'
    ];

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Country> $countries
 * @property-read int|null $countries_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subregion> $subregions
 * @property-read int|null $subregions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region query()
 * @mixin \Eloquent
 */
class Region extends Model
{
    protected $fillable = [
        'name',
        'translations',
        'flag',
        'wikiDataId',
    ];

    public function countries(): HasMany
    {
        return $this->hasMany(Country::class);
    }

    public function subregions(): HasMany
    {
        return $this->hasMany(Subregion::class);
    }
}

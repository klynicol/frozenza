<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Country> $countries
 * @property-read int|null $countries_count
 * @property-read \App\Models\Region|null $region
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subregion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subregion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subregion query()
 * @mixin \Eloquent
 */
class Subregion extends Model
{
    protected $fillable = [
        'name',
        'translations',
        'region_id',
        'flag',
        'wikiDataId',
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function countries(): HasMany
    {
        return $this->hasMany(Country::class);
    }
}

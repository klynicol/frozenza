<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\HasUuid;

/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pizza> $pizzas
 * @property-read int|null $pizzas_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StaffPick newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StaffPick newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StaffPick query()
 * @property string $id
 * @property string $slug
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StaffPick whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StaffPick whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StaffPick whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StaffPick whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StaffPick whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StaffPick whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class StaffPick extends Model
{
    use HasUuid;

    protected $fillable = [
        'slug',
        'name',
        'description',
    ];

    public function pizzas(): HasMany
    {
        return $this->hasMany(Pizza::class);
    }
}

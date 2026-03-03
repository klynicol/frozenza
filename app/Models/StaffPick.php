<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\HasUuid;

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Traits\HasUuid;

class Tag extends Model
{
    use HasUuid;

    protected $fillable = ['name', 'slug'];

    public function pizzas(): BelongsToMany
    {
        return $this->belongsToMany(Pizza::class);
    }
} 
<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasUuid;

    protected $fillable = [
        'pizza_id',
        'user_id',
        'rating',
        'review',
        'purchase_location',
        'purchase_date'
    ];

    protected $casts = [
        'rating' => 'float',
        'purchase_date' => 'date'
    ];

    public function pizza(): BelongsTo
    {
        return $this->belongsTo(Pizza::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
} 
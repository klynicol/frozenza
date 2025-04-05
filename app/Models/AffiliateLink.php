<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasUuid;

class AffiliateLink extends Model
{
    use HasUuid;

    protected $fillable = [
        'pizza_id',
        'vendor_name',
        'url',
        'commission_rate',
        'description',
        'is_active',
        'display_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'commission_rate' => 'float',
        'display_order' => 'integer',
    ];

    /**
     * Get the pizza that this affiliate link belongs to.
     */
    public function pizza(): BelongsTo
    {
        return $this->belongsTo(Pizza::class);
    }
}

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
        'affiliate_id',
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

    protected $appends = ['vendor_name'];

    /**
     * Vendor name from the related affiliate (for backward compatibility in API/views).
     */
    public function getVendorNameAttribute(): ?string
    {
        return $this->affiliate?->name;
    }

    /**
     * Get the affiliate (vendor) for this link.
     */
    public function affiliate(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class);
    }

    /**
     * Get the pizza that this affiliate link belongs to.
     */
    public function pizza(): BelongsTo
    {
        return $this->belongsTo(Pizza::class);
    }
}

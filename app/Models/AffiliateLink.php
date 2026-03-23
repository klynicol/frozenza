<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasUuid;

/**
 * 
 *
 * @property string $id
 * @property string $pizza_id
 * @property string|null $affiliate_id
 * @property string $url
 * @property float|null $commission_rate
 * @property string|null $description
 * @property bool $is_active
 * @property int $display_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Affiliate|null $affiliate
 * @property-read string|null $vendor_name
 * @property-read \App\Models\Pizza $pizza
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AffiliateLink newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AffiliateLink newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AffiliateLink query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AffiliateLink whereAffiliateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AffiliateLink whereCommissionRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AffiliateLink whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AffiliateLink whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AffiliateLink whereDisplayOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AffiliateLink whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AffiliateLink whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AffiliateLink wherePizzaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AffiliateLink whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AffiliateLink whereUrl($value)
 * @mixin \Eloquent
 */
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\HasUuid;

/**
 * 
 *
 * @property string $id
 * @property string $name
 * @property string|null $url_base
 * @property float|null $default_commission_rate
 * @property string|null $default_description
 * @property bool $is_active
 * @property int $display_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AffiliateLink> $affiliateLinks
 * @property-read int|null $affiliate_links_count
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\AffiliateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Affiliate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Affiliate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Affiliate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Affiliate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Affiliate whereDefaultCommissionRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Affiliate whereDefaultDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Affiliate whereDisplayOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Affiliate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Affiliate whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Affiliate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Affiliate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Affiliate whereUrlBase($value)
 * @mixin \Eloquent
 */
class Affiliate extends Model
{
    use HasFactory;
    use HasUuid;

    protected $fillable = [
        'name',
        'url_base',
        'default_commission_rate',
        'default_description',
        'is_active',
        'display_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'default_commission_rate' => 'float',
        'display_order' => 'integer',
    ];

    /**
     * Get the affiliate links for this affiliate.
     */
    public function affiliateLinks(): HasMany
    {
        return $this->hasMany(AffiliateLink::class);
    }
}

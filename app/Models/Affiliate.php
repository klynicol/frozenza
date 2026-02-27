<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\HasUuid;

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

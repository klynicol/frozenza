<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Traits\HasUuid;

class UserRole extends Model
{
    use HasUuid;

    protected $fillable = ['code', 'name', 'description'];

    /**
     * Get the users for the role.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_user_roles');
    }
}

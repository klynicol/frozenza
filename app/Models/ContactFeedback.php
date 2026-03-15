<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * 
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $message
 * @property bool $is_read
 * @property string|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactFeedback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactFeedback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactFeedback query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactFeedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactFeedback whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactFeedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactFeedback whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactFeedback whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactFeedback whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactFeedback whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactFeedback whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactFeedback whereUserId($value)
 * @property-read \App\Models\TFactory|null $use_factory
 * @mixin \Eloquent
 */
class ContactFeedback extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'is_read',
        'user_id',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

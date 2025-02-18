<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $message
 * @property int $is_read
 * @property string|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
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

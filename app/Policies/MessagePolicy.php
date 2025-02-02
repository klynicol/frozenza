<?php

namespace App\Policies;

use App\Models\Message;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

    public function update(User $user, Message $message): bool
    {
        return $user->id === $message->to_user_id;
    }

    public function view(User $user, Message $message): bool
    {
        return $user->id === $message->from_user_id || $user->id === $message->to_user_id;
    }
} 
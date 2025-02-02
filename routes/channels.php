<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;

Broadcast::channel('messages.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
}); 
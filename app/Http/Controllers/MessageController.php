<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Events\MessageSent;

class MessageController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $conversations = Message::where('from_user_id', Auth::id())
            ->orWhere('to_user_id', Auth::id())
            ->with(['fromUser', 'toUser'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($message) {
                return $message->from_user_id === Auth::id() 
                    ? $message->to_user_id 
                    : $message->from_user_id;
            });

        return Inertia::render('Messages/Index', [
            'conversations' => $conversations,
            'meta' => [
                'title' => 'Your Messages',
                'description' => 'View and manage your messages with other users.',
            ]
        ]);
    }

    public function show(User $user)
    {
        $messages = Message::where(function ($query) use ($user) {
                $query->where('from_user_id', Auth::id())
                    ->where('to_user_id', $user->id);
            })
            ->orWhere(function ($query) use ($user) {
                $query->where('from_user_id', $user->id)
                    ->where('to_user_id', Auth::id());
            })
            ->with(['fromUser', 'toUser'])
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('Messages/Show', [
            'otherUser' => $user,
            'messages' => $messages,
            'meta' => [
                'title' => "Messages with {$user->name}",
                'description' => "Your conversation with {$user->name}.",
            ]
        ]);
    }

    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'from_user_id' => Auth::id(),
            'to_user_id' => $user->id,
            'message' => $validated['message'],
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return back()->with('success', 'Message sent successfully!');
    }

    public function markAsRead(Message $message)
    {
        $this->authorize('update', $message);

        $message->update(['read_at' => now()]);

        return back();
    }
} 
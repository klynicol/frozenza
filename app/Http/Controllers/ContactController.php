<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use App\Models\ContactFeedback;

class ContactController extends Controller
{
    public function show()
    {
        return Inertia::render('Contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $contactFeedback = ContactFeedback::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'user_id' => $validated['user_id'] ?? null,
        ]);

        // Here you would typically send an email or store the message
        // For now, we'll just return a success response
        // TODO: Implement email sending logic

        return redirect()->back()->with('success', 'Thank you for your message. We will get back to you soon!');
    }
} 
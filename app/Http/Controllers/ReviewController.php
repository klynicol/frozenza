<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ReviewController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function store(Request $request, Pizza $pizza)
    {
        $validated = $request->validate([
            'rating' => 'required|numeric|min:0|max:5',
            'review' => 'required|string|min:10',
            'purchase_location' => 'required|string|max:255',
            'purchase_date' => 'required|date|before_or_equal:today',
        ]);

        $review = $pizza->reviews()->create([
            'user_id' => Auth::id(),
            ...$validated
        ]);

        $pizza->updateAverageRating();

        return back()->with('success', 'Review posted successfully!');
    }

    public function update(Request $request, Review $review)
    {
        $this->authorize('update', $review);

        $validated = $request->validate([
            'rating' => 'required|numeric|min:0|max:5',
            'review' => 'required|string|min:10',
            'purchase_location' => 'required|string|max:255',
            'purchase_date' => 'required|date|before_or_equal:today',
        ]);

        $review->update($validated);
        $review->pizza->updateAverageRating();

        return back()->with('success', 'Review updated successfully!');
    }

    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);
        
        $pizza = $review->pizza;
        $review->delete();
        $pizza->updateAverageRating();

        return back()->with('success', 'Review deleted successfully!');
    }
} 
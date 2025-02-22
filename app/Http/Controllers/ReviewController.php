<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Review;
use App\Handlers\ImageHandler;
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
            'review' => 'nullable|string|min:10',
            'purchase_location' => 'nullable|string|max:255',
            'purchase_date' => 'nullable|date|before_or_equal:today',
            'images' => 'nullable|array',
            'images.*.file' => 'required|image|max:5120', // Max 5MB per image
            'images.*.type' => 'required|string|in:' . implode(',', array_keys(Review::imageTypes())),
            'appearance_rating' => 'nullable|numeric|min:0|max:5',
            'texture_rating' => 'nullable|numeric|min:0|max:5',
            'flavor_rating' => 'nullable|numeric|min:0|max:5',
        ]);

        $review = $pizza->reviews()->create([
            'user_id' => Auth::id(),
            'review' => $validated['review'],
            'purchase_location' => $validated['purchase_location'],
            'appearance_rating' => $validated['appearance_rating'],
            'texture_rating' => $validated['texture_rating'],
            'flavor_rating' => $validated['flavor_rating'],
            'overall_rating' => round(
                ($validated['appearance_rating'] ?? 0 +
                $validated['texture_rating'] ?? 0 +
                $validated['flavor_rating'] ?? 0) / 3,
                2
            ),
        ]);

        if (isset($validated['images'])) {
            $order = 0;
            foreach ($validated['images'] as $imageData) {
                $uploadedImage = ImageHandler::upload($imageData['file']);
                $review->images()->attach($uploadedImage->id, [
                    'order' => $order++,
                    'type' => $imageData['type']
                ]);
            }
        }

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
            'images' => 'nullable|array',
            'images.*.file' => 'required|image|max:5120', // Max 5MB per image
            'images.*.type' => 'required|string|in:' . implode(',', array_keys(Review::imageTypes())),
            'remove_images' => 'nullable|array',
            'remove_images.*' => 'exists:images,id'
        ]);

        $review->update([
            'rating' => $validated['rating'],
            'review' => $validated['review'],
            'purchase_location' => $validated['purchase_location'],
            'purchase_date' => $validated['purchase_date'],
        ]);

        // Remove images if requested
        if ($request->has('remove_images')) {
            $review->images()->detach($request->remove_images);
        }

        // Add new images
        if (isset($validated['images'])) {
            $order = $review->images()->max('order') + 1;
            foreach ($validated['images'] as $imageData) {
                $uploadedImage = ImageHandler::upload($imageData['file']);
                $review->images()->attach($uploadedImage->id, [
                    'order' => $order++,
                    'type' => $imageData['type']
                ]);
            }
        }

        $review->pizza->updateAverageRating();

        return back()->with('success', 'Review updated successfully!');
    }

    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);
        
        $pizza = $review->pizza;
        
        // Images will be automatically detached due to cascade delete
        $review->delete();
        
        $pizza->updateAverageRating();

        return back()->with('success', 'Review deleted successfully!');
    }
} 
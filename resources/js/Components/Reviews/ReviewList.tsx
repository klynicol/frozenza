import React from 'react';
import type { Review } from '@/types/models';
import ReviewCard from '@/Components/Reviews/ReviewCard';

interface ReviewListProps {
    reviews: Review[];
}

export default function ReviewList({ reviews }: ReviewListProps) {
    return (
        <div className="mt-8">
            <h2 className="text-2xl font-bold mb-4">Reviews</h2>
            <div className="space-y-4">
                {reviews.map((review) => (
                    <ReviewCard key={review.id} review={review} />
                ))}
            </div>
        </div>
    );
} 
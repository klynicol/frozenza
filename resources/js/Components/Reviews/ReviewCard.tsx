import React from 'react';
import type { Review } from '@/types/models';

interface ReviewCardProps {
    review: Review;
}

export default function ReviewCard({ review }: ReviewCardProps) {
    return (
        <div className="bg-white rounded-lg shadow p-6">
            <div className="flex items-center justify-between mb-4">
                <div className="flex items-center">
                    <div className="ml-3">
                        <p className="text-sm font-medium text-gray-900">{review.user.name}</p>
                        <p className="text-sm text-gray-500">
                            Purchased at {review.purchase_location}
                        </p>
                    </div>
                </div>
                <div className="flex items-center">
                    <span className="text-yellow-400 mr-1">★</span>
                    <span className="text-gray-900">{review.rating.toFixed(1)}</span>
                </div>
            </div>
            <p className="text-gray-700">{review.review}</p>
            <div className="mt-4 text-sm text-gray-500">
                Purchased on {new Date(review.purchase_date).toLocaleDateString()}
            </div>
        </div>
    );
} 
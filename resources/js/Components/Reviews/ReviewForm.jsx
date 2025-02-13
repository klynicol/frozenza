import React, { useState } from 'react';
import { useForm } from '@inertiajs/react';

export default function ReviewForm({ pizzaId }) {
    const { data, setData, post, processing, errors } = useForm({
        rating: 5,
        review: '',
        purchase_location: '',
        purchase_date: new Date().toISOString().split('T')[0]
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post(`/pizzas/${pizzaId}/reviews`);
    };

    return (
        <form onSubmit={handleSubmit} className="bg-white rounded-lg shadow p-6">
            <h3 className="text-lg font-semibold mb-4">Write a Review</h3>
            
            <div className="mb-4">
                <label className="block text-sm font-medium text-gray-700">Rating</label>
                <select
                    value={data.rating}
                    onChange={e => setData('rating', Number(e.target.value))}
                    className="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                >
                    {[5, 4, 3, 2, 1, 0].map(rating => (
                        <option key={rating} value={rating}>
                            {rating} {rating === 1 ? 'Pizza' : 'Pizzas'}
                        </option>
                    ))}
                </select>
                {errors.rating && (
                    <p className="mt-1 text-sm text-red-600">{errors.rating}</p>
                )}
            </div>

            <div className="mb-4">
                <label className="block text-sm font-medium text-gray-700">Review</label>
                <textarea
                    value={data.review}
                    onChange={e => setData('review', e.target.value)}
                    rows={4}
                    className="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                    placeholder="What did you think about this pizza?"
                />
                {errors.review && (
                    <p className="mt-1 text-sm text-red-600">{errors.review}</p>
                )}
            </div>

            <div className="mb-4">
                <label className="block text-sm font-medium text-gray-700">Purchase Location</label>
                <input
                    type="text"
                    value={data.purchase_location}
                    onChange={e => setData('purchase_location', e.target.value)}
                    className="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                    placeholder="Where did you buy this pizza?"
                />
                {errors.purchase_location && (
                    <p className="mt-1 text-sm text-red-600">{errors.purchase_location}</p>
                )}
            </div>

            <div className="mb-4">
                <label className="block text-sm font-medium text-gray-700">Purchase Date</label>
                <input
                    type="date"
                    value={data.purchase_date}
                    onChange={e => setData('purchase_date', e.target.value)}
                    className="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                    max={new Date().toISOString().split('T')[0]}
                />
                {errors.purchase_date && (
                    <p className="mt-1 text-sm text-red-600">{errors.purchase_date}</p>
                )}
            </div>

            <button
                type="submit"
                disabled={processing}
                className="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 disabled:opacity-50"
            >
                {processing ? 'Submitting...' : 'Submit Review'}
            </button>
        </form>
    );
}

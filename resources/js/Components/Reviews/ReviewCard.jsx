import React, { useState } from 'react';
import { XMarkIcon } from '@heroicons/react/24/outline';
import { usePage } from '@inertiajs/react';
import Modal from '../Modal';
import { getImageUrl } from '@/utils/image';

export default function ReviewCard({ review }) {
    const { imageTypes } = usePage().props;
    const [selectedImage, setSelectedImage] = useState(null);

    // Group images by type (e.g. "whole_pizza", "slice", etc.)
    const groupedImages = review.images?.reduce((acc, image) => {
        if (!acc[image.pivot.type]) {
            acc[image.pivot.type] = [];
        }
        acc[image.pivot.type].push(image);
        return acc;
    }, {});

    const averageRating = (
        (parseFloat(review.appearance_rating) + 
         parseFloat(review.texture_rating) + 
         parseFloat(review.flavor_rating)) / 3
    ).toFixed(1);

    return (
        <div className="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow duration-200">
            {/* Header with user info and overall rating */}
            <div className="flex items-center justify-between mb-6 border-b border-gray-100 pb-4">
                <div className="flex items-center">
                    <div>
                        <p className="font-semibold text-gray-900">{review.user.name}</p>
                        <p className="text-sm text-gray-500 mt-1">
                            Purchased at {review.purchase_location || 'Unknown'}
                        </p>
                    </div>
                </div>
                <div className="flex items-center bg-gray-50 px-4 py-2 rounded-lg">
                    <span className="text-3xl font-bold text-gray-900 mr-2">{averageRating}</span>
                    <span className="text-2xl text-yellow-400">★</span>
                </div>
            </div>

            {/* Review content */}
            <div className="mb-6">
                <p className="text-gray-700 text-lg leading-relaxed">{review.review}</p>
            </div>

            {/* Detailed ratings */}
            <div className="grid grid-cols-3 gap-4 mb-8 bg-gray-50 rounded-lg p-4">
                <div className="flex items-center space-x-2">
                    <span className="text-yellow-400 text-lg">★</span>
                    <div>
                        <p className="text-sm font-medium text-gray-900">{parseFloat(review.appearance_rating).toFixed(1)}</p>
                        <p className="text-xs text-gray-500">Appearance</p>
                    </div>
                </div>
                <div className="flex items-center space-x-2">
                    <span className="text-yellow-400 text-lg">★</span>
                    <div>
                        <p className="text-sm font-medium text-gray-900">{parseFloat(review.texture_rating).toFixed(1)}</p>
                        <p className="text-xs text-gray-500">Texture</p>
                    </div>
                </div>
                <div className="flex items-center space-x-2">
                    <span className="text-yellow-400 text-lg">★</span>
                    <div>
                        <p className="text-sm font-medium text-gray-900">{parseFloat(review.flavor_rating).toFixed(1)}</p>
                        <p className="text-xs text-gray-500">Flavor</p>
                    </div>
                </div>
            </div>
            
            {/* Review Images Grid - Always visible */}
            {review.images && review.images.length > 0 && (
                <div className="space-y-6">
                    {Object.entries(groupedImages).map(([type, images]) => (
                        <div key={type}>
                            <h4 className="text-sm font-medium text-gray-900 mb-3">
                                {imageTypes[type]}
                            </h4>
                            <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                                {images.map((image) => (
                                    <div 
                                        key={image.id} 
                                        className="relative aspect-square rounded-lg overflow-hidden cursor-pointer group"
                                        onClick={() => setSelectedImage(image)}
                                    >
                                        <img
                                            src={getImageUrl(image)}
                                            alt={`${imageTypes[type]} image`}
                                            className="h-full w-full object-cover transition-transform duration-200 group-hover:scale-105"
                                        />
                                        <div className="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-opacity duration-200" />
                                    </div>
                                ))}
                            </div>
                        </div>
                    ))}
                </div>
            )}

            {/* Lightbox Modal - Only shows when an image is clicked */}
            <Modal show={!!selectedImage} onClose={() => setSelectedImage(null)}>
                {selectedImage && (
                    <div className="relative">
                        <div className="absolute top-4 left-4 bg-black bg-opacity-50 text-white px-3 py-1 rounded-full text-sm">
                            {imageTypes[selectedImage.pivot.type]}
                        </div>
                        <button
                            onClick={() => setSelectedImage(null)}
                            className="absolute top-4 right-4 bg-black bg-opacity-50 text-white rounded-full p-2 hover:bg-opacity-75 transition-colors"
                        >
                            <XMarkIcon className="h-6 w-6" />
                        </button>
                        <img
                            src={getImageUrl(selectedImage)}
                            alt={`${imageTypes[selectedImage.pivot.type]} image`}
                            className="max-w-full max-h-[80vh] object-contain"
                        />
                    </div>
                )}
            </Modal>
        </div>
    );
} 
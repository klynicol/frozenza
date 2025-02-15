import React, { useState } from 'react';
import { XMarkIcon } from '@heroicons/react/24/outline';
import { usePage } from '@inertiajs/react';
import Modal from '../Modal';

export default function ReviewCard({ review }) {
    const { imageTypes } = usePage().props;
    const [selectedImage, setSelectedImage] = useState(null);

    // Group images by type
    const groupedImages = review.images?.reduce((acc, image) => {
        if (!acc[image.pivot.type]) {
            acc[image.pivot.type] = [];
        }
        acc[image.pivot.type].push(image);
        return acc;
    }, {});

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
                <div className="flex flex-col items-end space-y-1">
                    <div className="flex items-center">
                        <span className="text-sm text-gray-600 mr-2">Appearance:</span>
                        <span className="text-yellow-400 mr-1">★</span>
                        <span className="text-gray-900">{review.appearance_rating.toFixed(1)}</span>
                    </div>
                    <div className="flex items-center">
                        <span className="text-sm text-gray-600 mr-2">Texture:</span>
                        <span className="text-yellow-400 mr-1">★</span>
                        <span className="text-gray-900">{review.texture_rating.toFixed(1)}</span>
                    </div>
                    <div className="flex items-center">
                        <span className="text-sm text-gray-600 mr-2">Flavor:</span>
                        <span className="text-yellow-400 mr-1">★</span>
                        <span className="text-gray-900">{review.flavor_rating.toFixed(1)}</span>
                    </div>
                </div>
            </div>
            <p className="text-gray-700">{review.review}</p>
            
            {/* Review Images */}
            {review.images && review.images.length > 0 && (
                <div className="mt-4 space-y-4">
                    {Object.entries(groupedImages).map(([type, images]) => (
                        <div key={type} className="space-y-2">
                            <h4 className="text-sm font-medium text-gray-900">
                                {imageTypes[type]}
                            </h4>
                            <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                {images.map((image) => (
                                    <div key={image.id} className="relative">
                                        <img
                                            src={`/storage/images/${image.name}`}
                                            alt={`${imageTypes[type]} image`}
                                            className="h-24 w-full object-cover rounded-lg cursor-pointer hover:opacity-75 transition-opacity"
                                            onClick={() => setSelectedImage(image)}
                                        />
                                    </div>
                                ))}
                            </div>
                        </div>
                    ))}
                </div>
            )}
            
            <div className="mt-4 text-sm text-gray-500">
                Purchased on {new Date(review.purchase_date).toLocaleDateString()}
            </div>

            {/* Image Modal */}
            <Modal show={!!selectedImage} onClose={() => setSelectedImage(null)}>
                {selectedImage && (
                    <div className="relative">
                        <div className="absolute top-2 left-2 bg-black bg-opacity-50 text-white px-2 py-1 rounded">
                            {imageTypes[selectedImage.pivot.type]}
                        </div>
                        <button
                            onClick={() => setSelectedImage(null)}
                            className="absolute top-2 right-2 bg-black bg-opacity-50 text-white rounded-full p-1 hover:bg-opacity-75"
                        >
                            <XMarkIcon className="h-6 w-6" />
                        </button>
                        <img
                            src={`/storage/images/${selectedImage.name}`}
                            alt={`${imageTypes[selectedImage.pivot.type]} image`}
                            className="max-w-full max-h-[80vh] object-contain"
                        />
                    </div>
                )}
            </Modal>
        </div>
    );
} 
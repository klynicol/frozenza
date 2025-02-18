import React, { useState, useRef } from 'react';
import { useForm, usePage } from '@inertiajs/react';
import { XMarkIcon } from '@heroicons/react/24/outline';
import {
    StarOutlineIcon,
    StarFilledIcon
} from '@/Components/Icons';

export default function ReviewForm({ pizzaId, onSuccess, initialData }) {
    const { imageTypes } = usePage().props;
    const fileInputRef = useRef(null);
    const [previews, setPreviews] = useState([]);
    
    const { data, setData, post, processing, errors, reset } = useForm({
        appearance_rating: initialData?.appearance_rating ?? 0,
        texture_rating: initialData?.texture_rating ?? 0,
        flavor_rating: initialData?.flavor_rating ?? 0,
        review: initialData?.review ?? '',
        purchase_location: initialData?.purchase_location ?? '',
        images: [],
        remove_images: []
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        
        // Create FormData and append all fields
        const formData = new FormData();
        formData.append('appearance_rating', data.appearance_rating);
        formData.append('texture_rating', data.texture_rating);
        formData.append('flavor_rating', data.flavor_rating);
        formData.append('review', data.review);
        formData.append('purchase_location', data.purchase_location);
        
        // Append images with their types
        data.images.forEach((image, index) => {
            formData.append(`images[${index}][file]`, image.file);
            formData.append(`images[${index}][type]`, image.type);
        });
        
        if (data.remove_images.length > 0) {
            data.remove_images.forEach(id => {
                formData.append('remove_images[]', id);
            });
        }

        post(`/pizzas/${pizzaId}/reviews`, {
            data: formData,
            forceFormData: true,
            onSuccess: () => {
                reset();
                setPreviews([]);
                if (onSuccess) onSuccess();
            }
        });
    };

    const handleImageChange = (e) => {
        const files = Array.from(e.target.files);
        const newImages = files.map(file => ({
            file,
            type: 'other' // Default type
        }));
        
        setData('images', [...data.images, ...newImages]);
        
        // Create previews for new images
        files.forEach(file => {
            const reader = new FileReader();
            reader.onloadend = () => {
                setPreviews(prev => [...prev, { file, preview: reader.result, type: 'other' }]);
            };
            reader.readAsDataURL(file);
        });
    };

    const removeImage = (index) => {
        const newImages = [...data.images];
        newImages.splice(index, 1);
        setData('images', newImages);

        const newPreviews = [...previews];
        newPreviews.splice(index, 1);
        setPreviews(newPreviews);
    };

    const updateImageType = (index, type) => {
        const newImages = [...data.images];
        newImages[index] = { ...newImages[index], type };
        setData('images', newImages);

        const newPreviews = [...previews];
        newPreviews[index] = { ...newPreviews[index], type };
        setPreviews(newPreviews);
    };

    return (
        <form onSubmit={handleSubmit} className="bg-white rounded-lg shadow p-6">
            <h3 className="text-lg font-semibold mb-4">Write a Review</h3>
            
            <div className="space-y-4 mb-4">
                {/* Appearance Rating */}
                <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">Appearance Rating</label>
                    <div className="flex space-x-1">
                        {[1, 2, 3, 4, 5].map((rating) => (
                            <button
                                key={rating}
                                type="button"
                                onClick={() => setData('appearance_rating', rating)}
                                className="focus:outline-none"
                            >
                                {rating <= data.appearance_rating ? (
                                    <StarFilledIcon className="w-8 h-8 text-yellow-400" />
                                ) : (
                                    <StarOutlineIcon className="w-8 h-8 text-gray-300 hover:text-yellow-400" />
                                )}
                            </button>
                        ))}
                    </div>
                </div>

                {/* Texture Rating */}
                <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">Texture Rating</label>
                    <div className="flex space-x-1">
                        {[1, 2, 3, 4, 5].map((rating) => (
                            <button
                                key={rating}
                                type="button"
                                onClick={() => setData('texture_rating', rating)}
                                className="focus:outline-none"
                            >
                                {rating <= data.texture_rating ? (
                                    <StarFilledIcon className="w-8 h-8 text-yellow-400" />
                                ) : (
                                    <StarOutlineIcon className="w-8 h-8 text-gray-300 hover:text-yellow-400" />
                                )}
                            </button>
                        ))}
                    </div>
                </div>

                {/* Flavor Rating */}
                <div>
                    <label className="block text-sm font-medium text-gray-700 mb-1">Flavor Rating</label>
                    <div className="flex space-x-1">
                        {[1, 2, 3, 4, 5].map((rating) => (
                            <button
                                key={rating}
                                type="button"
                                onClick={() => setData('flavor_rating', rating)}
                                className="focus:outline-none"
                            >
                                {rating <= data.flavor_rating ? (
                                    <StarFilledIcon className="w-8 h-8 text-yellow-400" />
                                ) : (
                                    <StarOutlineIcon className="w-8 h-8 text-gray-300 hover:text-yellow-400" />
                                )}
                            </button>
                        ))}
                    </div>
                </div>
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
                <label className="block text-sm font-medium text-gray-700">Images</label>
                <input
                    type="file"
                    ref={fileInputRef}
                    onChange={handleImageChange}
                    className="hidden"
                    multiple
                    accept="image/*"
                />
                <button
                    type="button"
                    onClick={() => fileInputRef.current?.click()}
                    className="mt-1 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50"
                >
                    Add Images
                </button>
                {errors.images && (
                    <p className="mt-1 text-sm text-red-600">{errors.images}</p>
                )}

                {/* Image Previews */}
                {previews.length > 0 && (
                    <div className="mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        {previews.map((preview, index) => (
                            <div key={index} className="relative bg-gray-50 p-4 rounded-lg">
                                <img
                                    src={preview.preview}
                                    alt={`Preview ${index + 1}`}
                                    className="h-32 w-full object-cover rounded-lg mb-2"
                                />
                                <select
                                    value={preview.type}
                                    onChange={(e) => updateImageType(index, e.target.value)}
                                    className="mt-2 block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                >
                                    {Object.entries(imageTypes).map(([value, label]) => (
                                        <option key={value} value={value}>
                                            {label}
                                        </option>
                                    ))}
                                </select>
                                <button
                                    type="button"
                                    onClick={() => removeImage(index)}
                                    className="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600"
                                >
                                    <XMarkIcon className="h-4 w-4" />
                                </button>
                            </div>
                        ))}
                    </div>
                )}
            </div>

            <div className="flex justify-end">
                <button
                    type="submit"
                    disabled={processing}
                    className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50"
                >
                    {processing ? 'Submitting...' : 'Submit Review'}
                </button>
            </div>
        </form>
    );
}

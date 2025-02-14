import React, { useState } from 'react';
import MainLayout from '@/Layouts/MainLayout';
import ReviewList from '@/Components/Reviews/ReviewList';
import ReviewForm from '@/Components/Reviews/ReviewForm';
import SchemaMarkup from '@/Components/SEO/SchemaMarkup';
import NutritionFact from '@/Components/Common/NutritionFact';
import { Link } from '@inertiajs/react';
import { PlusIcon, MinusIcon } from '@/Components/Icons';
import { getImageUrl } from '@/utils/image';
import Modal from '@/Components/Modal';

export default function PizzaShow({ pizza, meta, auth }) {
    const [isIngredientsOpen, setIngredientsOpen] = useState(false);
    const [isNutritionOpen, setNutritionOpen] = useState(false);
    const [isReviewModalOpen, setReviewModalOpen] = useState(false);

    const toggleAccordion = (setOpen) => {
        setOpen(prevState => !prevState);
    };

    return (
        <MainLayout meta={meta} auth={auth}>
            <Modal show={isReviewModalOpen} onClose={() => setReviewModalOpen(false)}>
                <div className="p-6">
                    <h3 className="text-lg font-semibold mb-4">Write a Review</h3>
                    <ReviewForm pizzaId={pizza.id} onSuccess={() => setReviewModalOpen(false)} />
                </div>
            </Modal>
            <SchemaMarkup type="Pizza" data={pizza} />

            {/* Main content container */}
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div className="grid grid-cols-1 md:grid-cols-12 gap-8">
                    {/* Left column with large image */}
                    <div className="md:col-span-5">
                        {pizza.image && (
                            <div className="relative aspect-square rounded-lg overflow-hidden">
                                <img
                                    className="absolute inset-0 w-full h-full object-cover"
                                    src={getImageUrl(pizza.image)}
                                    alt={pizza.name}
                                />
                            </div>
                        )}
                    </div>

                    {/* Right column with details */}
                    <div className="md:col-span-7">
                        <div className="bg-white rounded-lg shadow-sm p-6">
                            <h1 className="text-3xl font-bold text-gray-900 mb-2">
                                {pizza.name}
                            </h1>

                            <div className="text-sm text-gray-600 mb-4">
                                <Link
                                    href={route('brands.show', pizza.brand.slug)}
                                    className="hover:text-indigo-600"
                                >
                                    By {pizza.brand.name}
                                </Link>
                                {pizza?.style && (
                                    <>
                                        <span className="mx-2">•</span>
                                        <Link
                                            href={route('styles.show', pizza?.style?.slug)}
                                            className="hover:text-indigo-600"
                                        >
                                            {pizza?.style?.name}
                                        </Link>
                                    </>
                                )}
                            </div>

                            <p className="text-gray-700 mb-8">{pizza?.description}</p>

                            {/* Ingredients Accordion */}
                            <div className="border-t border-gray-200 py-4">
                                <button
                                    className="w-full flex items-center justify-between text-left"
                                    onClick={() => toggleAccordion(setIngredientsOpen)}
                                >
                                    <span className="text-lg font-semibold">Ingredients</span>
                                    {isIngredientsOpen ? <MinusIcon /> : <PlusIcon />}
                                </button>
                                <div
                                    className="mt-2 transition-all duration-200 ease-in-out overflow-hidden"
                                    style={{ maxHeight: isIngredientsOpen ? '1000px' : '0px' }}
                                >
                                    <p className="text-gray-600">
                                        {pizza.ingredients || 'No ingredients available'}
                                    </p>
                                </div>
                            </div>

                            {/* Nutrition Accordion */}
                            <div className="border-t border-gray-200 py-4">
                                <button
                                    className="w-full flex items-center justify-between text-left"
                                    onClick={() => toggleAccordion(setNutritionOpen)}
                                >
                                    <span className="text-lg font-semibold">Nutritional Info</span>
                                    {isNutritionOpen ? <MinusIcon /> : <PlusIcon />}
                                </button>
                                <div
                                    className="mt-2 transition-all duration-200 ease-in-out overflow-hidden"
                                    style={{ maxHeight: isNutritionOpen ? '1000px' : '0px' }}
                                >
                                    <NutritionFact nutritionFact={pizza.nutrition_fact} />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Reviews Section */}
                <div className="mt-12">
                    <div className="border-b border-gray-200 mb-8">
                        <h2 className="text-2xl font-bold pb-4">Reviews</h2>
                    </div>

                    {auth.user ? (
                        <>
                            <div className="mb-8">
                                <button
                                    onClick={() => setReviewModalOpen(true)}
                                    className="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors"
                                >
                                    Write a Review
                                </button>
                            </div>
                        </>
                    ) : (
                        <div className="bg-gray-50 rounded-lg p-6 mb-8 text-center">
                            <p className="text-gray-600">
                                Please <Link href={route('login')} className="text-indigo-600 hover:text-indigo-800">login</Link> to write a review
                            </p>
                        </div>
                    )}

                    {pizza.reviews && pizza.reviews.length > 0 ? (
                        <ReviewList reviews={pizza.reviews} />
                    ) : (
                        <p className="text-gray-600 text-center">No reviews yet. Be the first to review this pizza!</p>
                    )}
                </div>
            </div>
        </MainLayout>
    );
} 
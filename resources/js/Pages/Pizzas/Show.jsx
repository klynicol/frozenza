import React, { useState } from 'react';
import MainLayout from '@/Layouts/MainLayout';
import ReviewList from '@/Components/Reviews/ReviewList';
import ReviewForm from '@/Components/Reviews/ReviewForm';
import SchemaMarkup from '@/Components/SEO/SchemaMarkup';
import NutritionFact from '@/Components/Common/NutritionFact';
import AffiliateLinks from '@/Components/Pizza/AffiliateLinks';
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

    const mainImage = pizza?.images?.find(image => image.pivot.type === 'main') ?? null;

    return (
        <MainLayout meta={meta} auth={auth}>
            <Modal show={isReviewModalOpen} onClose={() => setReviewModalOpen(false)}>
                <div className="p-6">
                    <h3 className="text-lg font-semibold mb-4">Write a Review</h3>
                    <ReviewForm
                        pizzaId={pizza.id}
                        onSuccess={() => setReviewModalOpen(false)}
                    />
                </div>
            </Modal>
            <SchemaMarkup type="Pizza" data={pizza} />

            {/* Main content container */}
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div className="grid grid-cols-1 md:grid-cols-12 gap-8">
                    {/* Left column with large image */}
                    <div className="md:col-span-5">
                        <div className="relative aspect-square rounded-lg overflow-hidden">
                            <img
                                className="absolute inset-0 w-full h-full object-cover"
                                src={mainImage ? getImageUrl(mainImage) : '/storage/assets/pizza_placeholder.png'}
                                alt={pizza.name}
                            />
                        </div>
                    </div>

                    {/* Right column with details */}
                    <div className="md:col-span-7">
                        <div className="bg-white rounded-lg shadow-sm p-6">
                            <h1 className="text-3xl font-bold text-gray-900 mb-2">
                                {pizza.name}
                            </h1>

                            <div className="text-sm text-gray-600 mb-4">
                                <Link
                                    href={`/brands/${pizza.brand.slug}`}
                                    className="text-indigo-700 hover:underline text-lg text-bold"
                                >
                                    By {pizza.brand.name}
                                </Link>
                            </div>

                            {/* Review Statistics */}
                            <div className="flex items-center mb-4">
                                <div className="flex items-center bg-yellow-50 px-3 py-1 rounded-lg">
                                    <span className="text-yellow-400 text-xl mr-1">★</span>
                                    <span className="font-semibold text-lg">{pizza.average_rating ? pizza.average_rating.toFixed(1) : 'No ratings'}</span>
                                </div>
                                <div className="ml-4 text-gray-600">
                                    <span>{pizza.total_reviews} {pizza.total_reviews === 1 ? 'Review' : 'Reviews'}</span>
                                </div>
                            </div>

                            <p className="text-gray-700 mb-8">{pizza?.description}</p>

                            {/* Disclaimer */}
                            <div className="bg-gray-50 p-4 rounded-lg mb-8">
                                <p className="text-sm text-gray-600 italic">
                                    Product information or packaging displayed may not be current or complete.
                                    Always refer to the physical product for the most accurate information and warnings.</p>
                            </div>

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

                {/* Affiliate Links Section */}
                <AffiliateLinks affiliateLinks={pizza.affiliate_links} />

                {/* Reviews Section */}
                <div className="mt-12">
                    {/* Giveaway Promotional Banner */}
                    <div className="bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl p-6 mb-8 relative overflow-hidden">
                        <div className="absolute inset-0 bg-black bg-opacity-10"></div>
                        <div className="relative z-10">
                            <div className="flex items-center justify-between">
                                <div className="flex-1">
                                    <div className="flex items-center space-x-3 mb-2">
                                        <span className="text-3xl">🎉</span>
                                        <h3 className="text-xl font-bold">Win a $50 Gift Card!</h3>
                                        <span className="text-3xl">🎉</span>
                                    </div>
                                    <p className="text-lg opacity-90">
                                        Write a review for this pizza and get entered into our monthly giveaway!
                                    </p>
                                </div>
                                <div className="ml-6">
                                    {auth.user ? (
                                        <button
                                            onClick={() => setReviewModalOpen(true)}
                                            className="bg-white text-purple-600 px-6 py-3 rounded-full font-bold hover:bg-gray-100 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
                                        >
                                            Write Review
                                        </button>
                                    ) : (
                                        <Link
                                            href="/login"
                                            className="bg-white text-purple-600 px-6 py-3 rounded-full font-bold hover:bg-gray-100 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 inline-block"
                                        >
                                            Sign In to Review
                                        </Link>
                                    )}
                                </div>
                            </div>
                        </div>
                        
                        {/* Floating elements */}
                        <div className="absolute top-4 right-4 w-16 h-16 bg-white bg-opacity-10 rounded-full animate-bounce"></div>
                        <div className="absolute bottom-4 left-4 w-12 h-12 bg-white bg-opacity-10 rounded-full animate-pulse delay-1000"></div>
                    </div>

                    <div className="border-b border-gray-200 mb-8">
                        <h2 className="text-2xl font-bold pb-4">Reviews</h2>
                    </div>

                    {/* Rating Breakdown */}
                    {pizza.total_reviews > 0 && (
                        <div className="bg-white rounded-lg shadow-sm p-6 mb-8">
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div className="flex items-center justify-center">
                                    <div className="text-center">
                                        <div className="text-5xl font-bold text-gray-900 mb-2">
                                            {pizza.average_rating.toFixed(1)}
                                        </div>
                                        <div className="text-yellow-400 text-2xl mb-1">★★★★★</div>
                                        <div className="text-gray-600">
                                            {pizza.total_reviews} {pizza.total_reviews === 1 ? 'Review' : 'Reviews'}
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div className="space-y-2">
                                        {[5, 4, 3, 2, 1].map((rating) => {
                                            const count = pizza.rating_breakdown?.[rating] || 0;
                                            const percentage = (count / pizza.total_reviews) * 100 || 0;
                                            return (
                                                <div key={rating} className="flex items-center">
                                                    <div className="w-12 text-sm text-gray-600">{rating} stars</div>
                                                    <div className="flex-1 mx-4 h-4 bg-gray-100 rounded-full overflow-hidden">
                                                        <div
                                                            className="h-full bg-yellow-400 rounded-full"
                                                            style={{ width: `${percentage}%` }}
                                                        ></div>
                                                    </div>
                                                    <div className="w-12 text-sm text-gray-600">{count}</div>
                                                </div>
                                            );
                                        })}
                                    </div>
                                </div>
                            </div>
                        </div>
                    )}

                    {auth.user ? (
                        <>
                            {!pizza.hasUserReviewed ? (
                                <div className="mb-8">
                                    <button
                                        onClick={() => setReviewModalOpen(true)}
                                        className="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors"
                                    >
                                        Write a Review
                                    </button>
                                </div>
                            ) : (
                                <div className="mb-8">
                                    <p className="text-gray-600">You have already reviewed this pizza.</p>
                                </div>
                            )}
                        </>
                    ) : (
                        <div className="bg-gray-50 rounded-lg p-6 mb-8 text-center">
                            <p className="text-gray-600">
                                Please <Link 
                                    href={`/login`}
                                    className="text-indigo-600 hover:text-indigo-800">login</Link> to write a review
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
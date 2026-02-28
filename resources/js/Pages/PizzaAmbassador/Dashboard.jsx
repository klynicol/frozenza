import React from 'react';
import { Head, Link } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';

export default function Dashboard({ auth }) {
    return (
        <MainLayout auth={auth} showPromotionalBanner={false}>
            <Head title="Pizza Ambassador Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200">
                            <div className="text-center mb-8">
                                <h1 className="text-3xl font-bold text-gray-900 mb-4">
                                    Pizza Ambassador Dashboard
                                </h1>
                                <p className="text-lg text-gray-600 max-w-2xl mx-auto">
                                    Welcome to your pizza ambassador dashboard! Here you can submit new brands and pizzas to help expand our database.
                                </p>
                            </div>

                            {/* Submission Options */}
                            <div className="grid md:grid-cols-2 gap-8 mb-8">
                                {/* Brand Submission Card */}
                                <div className="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-lg p-6 border border-blue-200">
                                    <div className="text-center">
                                        <div className="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mb-4">
                                            <svg className="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                        </div>
                                        <h3 className="text-xl font-semibold text-gray-900 mb-2">Submit New Brand</h3>
                                        <p className="text-gray-600 mb-4">
                                            Add a new pizza brand to our database. Include brand story, unique selling points, and logo.
                                        </p>
                                        <Link href={route('brand-submissions.create')}>
                                            <PrimaryButton className="w-full">
                                                Submit Brand
                                            </PrimaryButton>
                                        </Link>
                                    </div>
                                </div>

                                {/* Pizza Submission Card */}
                                <div className="bg-gradient-to-br from-green-50 to-emerald-100 rounded-lg p-6 border border-green-200">
                                    <div className="text-center">
                                        <div className="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                                            <svg className="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                        <h3 className="text-xl font-semibold text-gray-900 mb-2">Submit New Pizza</h3>
                                        <p className="text-gray-600 mb-4">
                                            Add a new pizza under an existing brand. Include ingredients, allergens, and images.
                                        </p>
                                        <Link href={route('pizza-submissions.create')}>
                                            <PrimaryButton className="w-full">
                                                Submit Pizza
                                            </PrimaryButton>
                                        </Link>
                                    </div>
                                </div>
                            </div>

                            {/* Guidelines */}
                            <div className="bg-gray-50 rounded-lg p-6">
                                <h3 className="text-lg font-semibold text-gray-900 mb-4">Submission Guidelines</h3>
                                <div className="grid md:grid-cols-2 gap-6">
                                    <div>
                                        <h4 className="font-medium text-gray-900 mb-2">Brand Submissions</h4>
                                        <ul className="text-sm text-gray-600 space-y-1">
                                            <li>• Provide accurate brand information</li>
                                            <li>• Include high-quality logo images</li>
                                            <li>• Add unique selling points</li>
                                            <li>• Include social media handles if available</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h4 className="font-medium text-gray-900 mb-2">Pizza Submissions</h4>
                                        <ul className="text-sm text-gray-600 space-y-1">
                                            <li>• Select the correct brand</li>
                                            <li>• List all ingredients accurately</li>
                                            <li>• Include allergen information</li>
                                            <li>• Add relevant tags</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            {/* Quick Actions */}
                            <div className="mt-8 text-center">
                                <h3 className="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                                <div className="flex flex-col sm:flex-row gap-4 justify-center">
                                    <Link href={route('brands.index')}>
                                        <SecondaryButton>
                                            Browse All Brands
                                        </SecondaryButton>
                                    </Link>
                                    <Link href={route('pizzas.index')}>
                                        <SecondaryButton>
                                            Browse All Pizzas
                                        </SecondaryButton>
                                    </Link>
                                    <Link href={route('home')}>
                                        <SecondaryButton>
                                            Back to Home
                                        </SecondaryButton>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </MainLayout>
    );
}

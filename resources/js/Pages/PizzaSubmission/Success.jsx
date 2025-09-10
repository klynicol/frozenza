import React from 'react';
import { Head, Link } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';

export default function Success({ pizza }) {
    return (
        <MainLayout>
            <Head title="Pizza Submitted Successfully" />

            <div className="py-12">
                <div className="max-w-2xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200 text-center">
                            {/* Success Icon */}
                            <div className="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                                <svg className="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 13l4 4L19 7" />
                                </svg>
                            </div>

                            <h2 className="text-2xl font-bold text-gray-900 mb-4">
                                Pizza Submitted Successfully!
                            </h2>

                            <p className="text-gray-600 mb-6">
                                Thank you for submitting <strong>{pizza.name}</strong> under <strong>{pizza.brand.name}</strong>. Our team will review your submission and get back to you soon.
                            </p>

                            {/* Pizza Details */}
                            <div className="bg-gray-50 rounded-lg p-4 mb-6 text-left">
                                <h3 className="font-semibold text-gray-900 mb-2">Submission Details:</h3>
                                <div className="space-y-2 text-sm text-gray-600">
                                    <div><strong>Pizza Name:</strong> {pizza.name}</div>
                                    <div><strong>Brand:</strong> {pizza.brand.name}</div>
                                    <div><strong>Description:</strong> {pizza.description}</div>
                                    {pizza.website && (
                                        <div><strong>Website:</strong> <a href={pizza.website} target="_blank" rel="noopener noreferrer" className="text-indigo-600 hover:text-indigo-800">{pizza.website}</a></div>
                                    )}
                                </div>
                            </div>

                            <div className="text-sm text-gray-500 mb-6">
                                <p>What happens next?</p>
                                <ul className="list-disc list-inside mt-2 space-y-1">
                                    <li>Our team will review your submission within 2-3 business days</li>
                                    <li>We may contact you for additional information if needed</li>
                                    <li>Once approved, your pizza will be added to our database</li>
                                    <li>You'll receive an email notification when it's live</li>
                                </ul>
                            </div>

                            {/* Action Buttons */}
                            <div className="flex flex-col sm:flex-row gap-4 justify-center">
                                <Link href={route('pizza-submissions.create')}>
                                    <SecondaryButton>
                                        Submit Another Pizza
                                    </SecondaryButton>
                                </Link>
                                
                                <Link href={route('brand-submissions.create')}>
                                    <PrimaryButton>
                                        Submit a Brand
                                    </PrimaryButton>
                                </Link>
                            </div>

                            <div className="mt-6">
                                <Link href={route('home')} className="text-indigo-600 hover:text-indigo-800 text-sm">
                                    ← Back to Home
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </MainLayout>
    );
}

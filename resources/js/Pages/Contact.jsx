import React from 'react';
import { Head, Link } from '@inertiajs/react';
import ContactForm from '@/Components/Contact/ContactForm';
import MainLayout from '@/Layouts/MainLayout';

export default function Contact({ auth }) {
    return (
        <MainLayout auth={auth}>
            <Head title="Contact Us" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {!auth?.user && (
                        <div className="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                            <div className="flex items-center justify-between">
                                <div className="flex-1">
                                    <p className="text-sm text-blue-700">
                                        Have an account? Log in to automatically fill your contact information.
                                    </p>
                                </div>
                                <div className="ml-4">
                                    <Link
                                        href="/login"
                                        className="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                    >
                                        Log in
                                    </Link>
                                </div>
                            </div>
                        </div>
                    )}
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6">
                            <h1 className="text-3xl font-bold text-gray-900 mb-8 text-center">Get in Touch</h1>
                            <p className="text-gray-600 text-center mb-8">
                                Have a question, suggestion, or feedback? We'd love to hear from you!
                            </p>
                            <ContactForm auth={auth} />
                        </div>
                    </div>
                </div>
            </div>
        </MainLayout>
    );
} 
import React from 'react';
import MainLayout from '@/Layouts/MainLayout';

export default function Privacy({ auth }) {
    return (
        <MainLayout auth={auth}>
            <div className="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
                <h1 className="text-3xl font-bold mb-6">Privacy Policy</h1>
                
                <section className="mb-8">
                    <h2 className="text-2xl font-semibold mb-4">Information We Collect</h2>
                    <p className="mb-4">We collect information that you provide directly to us, including:</p>
                    <ul className="list-disc ml-6 mb-4">
                        <li>Name and contact information</li>
                        <li>Order history and preferences</li>
                        <li>Delivery addresses</li>
                        <li>Payment information</li>
                    </ul>
                </section>

                <section className="mb-8">
                    <h2 className="text-2xl font-semibold mb-4">How We Use Your Information</h2>
                    <p className="mb-4">We use the information we collect to:</p>
                    <ul className="list-disc ml-6 mb-4">
                        <li>Process and deliver your orders</li>
                        <li>Send you order confirmations and updates</li>
                        <li>Improve our services and customer experience</li>
                        <li>Communicate with you about promotions and special offers</li>
                    </ul>
                </section>

                <section className="mb-8">
                    <h2 className="text-2xl font-semibold mb-4">Information Sharing</h2>
                    <p className="mb-4">
                        We do not sell or share your personal information with third parties except as necessary to provide our services
                        (such as with delivery partners or payment processors).
                    </p>
                </section>

                <section className="mb-8">
                    <h2 className="text-2xl font-semibold mb-4">Security</h2>
                    <p className="mb-4">
                        We implement appropriate security measures to protect your personal information from unauthorized access,
                        alteration, disclosure, or destruction.
                    </p>
                </section>

                <section>
                    <h2 className="text-2xl font-semibold mb-4">Contact Us</h2>
                    <p>
                        If you have any questions about our Privacy Policy, please contact us through our{' '}
                        <a href="/contact" className="text-blue-600 hover:text-blue-800">contact page</a>.
                    </p>
                </section>
            </div>
        </MainLayout>
    );
} 
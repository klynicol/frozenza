import React from 'react';
import MainLayout from '@/Layouts/MainLayout';

export default function About({ auth }) {
    return (
        <MainLayout auth={auth}>
            <div className="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
                <h1 className="text-3xl font-bold mb-6">About Pizza Kraken</h1>
                
                <section className="mb-8">
                    <h2 className="text-2xl font-semibold mb-4">Our Mission</h2>
                    <p className="mb-4">
                        At Pizza Kraken, we're passionate about helping pizza lovers discover the best frozen pizzas 
                        available in stores. Our mission is to provide honest, comprehensive reviews and ratings 
                        to help you make informed decisions about your pizza purchases.
                    </p>
                </section>

                <section className="mb-8">
                    <h2 className="text-2xl font-semibold mb-4">What We Do</h2>
                    <p className="mb-4">We specialize in:</p>
                    <ul className="list-disc ml-6 mb-4">
                        <li>Comprehensive pizza reviews and ratings</li>
                        <li>Detailed nutritional information and ingredient analysis</li>
                        <li>Brand comparisons and recommendations</li>
                        <li>User-generated reviews and feedback</li>
                        <li>Pizza discovery by brand</li>
                    </ul>
                </section>

                <section className="mb-8">
                    <h2 className="text-2xl font-semibold mb-4">Our Review Process</h2>
                    <p className="mb-4">
                        Every pizza on our platform goes through a thorough evaluation process. We consider factors such as:
                    </p>
                    <ul className="list-disc ml-6 mb-4">
                        <li>Taste and flavor quality</li>
                        <li>Texture and consistency</li>
                        <li>Value for money</li>
                        <li>Ingredient quality</li>
                        <li>Overall cooking experience</li>
                    </ul>
                </section>

                <section className="mb-8">
                    <h2 className="text-2xl font-semibold mb-4">Community Driven</h2>
                    <p className="mb-4">
                        Pizza Kraken is more than just a review site - it's a community of pizza enthusiasts. 
                        We encourage our users to share their own experiences, rate pizzas, and contribute to 
                        our growing database of pizza knowledge.
                    </p>
                </section>

                <section className="mb-8">
                    <h2 className="text-2xl font-semibold mb-4">Transparency</h2>
                    <p className="mb-4">
                        We believe in complete transparency. All our reviews are honest and unbiased, 
                        and we clearly disclose any partnerships or affiliate relationships. Our goal is 
                        to be your trusted source for pizza information.
                    </p>
                </section>

                <section>
                    <h2 className="text-2xl font-semibold mb-4">Get in Touch</h2>
                    <p>
                        Have questions, suggestions, or want to contribute? We'd love to hear from you! 
                        Visit our{' '}
                        <a href="/contact" className="text-blue-600 hover:text-blue-800">contact page</a> 
                        to get in touch with our team.
                    </p>
                </section>
            </div>
        </MainLayout>
    );
}


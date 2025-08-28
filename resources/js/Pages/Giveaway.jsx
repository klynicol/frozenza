import React from 'react';
import { Link } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';

export default function Giveaway({ auth }) {
    const currentMonth = new Date().toLocaleString('default', { month: 'long', year: 'numeric' });
    const nextMonth = new Date(new Date().getFullYear(), new Date().getMonth() + 1, 1).toLocaleString('default', { month: 'long', year: 'numeric' });

    return (
        <MainLayout auth={auth}>
            <div className="max-w-6xl mx-auto">
                {/* Hero Section */}
                <div className="bg-gradient-to-br from-purple-600 via-pink-600 to-red-600 text-white rounded-2xl p-8 mb-8 relative overflow-hidden">
                    <div className="absolute inset-0 bg-black bg-opacity-20"></div>
                    <div className="relative z-10 text-center">
                        <div className="text-6xl mb-4">🎉</div>
                        <h1 className="text-4xl md:text-6xl font-bold mb-4">
                            Monthly $50 Gift Card Giveaway!
                        </h1>
                        <p className="text-xl md:text-2xl opacity-90 mb-6">
                            Review pizzas and win big every month!
                        </p>
                        <div className="flex flex-wrap justify-center gap-4">
                            <Link
                                href="/pizzas"
                                className="bg-white text-purple-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
                            >
                                Browse Pizzas Now
                            </Link>
                            {!auth.user && (
                                <Link
                                    href="/login"
                                    className="bg-yellow-400 text-purple-800 px-8 py-4 rounded-full font-bold text-lg hover:bg-yellow-300 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
                                >
                                    Sign In to Participate
                                </Link>
                            )}
                        </div>
                    </div>
                    
                    {/* Floating elements */}
                    <div className="absolute top-10 right-10 w-20 h-20 bg-white bg-opacity-10 rounded-full animate-bounce"></div>
                    <div className="absolute bottom-10 left-10 w-16 h-16 bg-white bg-opacity-10 rounded-full animate-pulse delay-1000"></div>
                </div>

                {/* How It Works */}
                <div className="grid md:grid-cols-3 gap-8 mb-12">
                    <div className="bg-white rounded-xl p-6 shadow-lg text-center hover:shadow-xl transition-shadow duration-200">
                        <div className="text-4xl mb-4">🍕</div>
                        <h3 className="text-xl font-bold mb-3">1. Review a Pizza</h3>
                        <p className="text-gray-600">
                            Find a pizza you've tried and write an honest review with your rating and thoughts.
                        </p>
                    </div>
                    
                    <div className="bg-white rounded-xl p-6 shadow-lg text-center hover:shadow-xl transition-shadow duration-200">
                        <div className="text-4xl mb-4">🎯</div>
                        <h3 className="text-xl font-bold mb-3">2. Get Entered</h3>
                        <p className="text-gray-600">
                            Each review you submit automatically enters you into that month's drawing.
                        </p>
                    </div>
                    
                    <div className="bg-white rounded-xl p-6 shadow-lg text-center hover:shadow-xl transition-shadow duration-200">
                        <div className="text-4xl mb-4">🏆</div>
                        <h3 className="text-xl font-bold mb-3">3. Win & Repeat</h3>
                        <p className="text-gray-600">
                            Winners are randomly selected at the end of each month. New month, new chance!
                        </p>
                    </div>
                </div>

                {/* Current Month Info */}
                <div className="bg-white rounded-xl p-8 shadow-lg mb-8">
                    <h2 className="text-3xl font-bold mb-6 text-center">🎁 {currentMonth} Giveaway</h2>
                    <div className="grid md:grid-cols-2 gap-8 items-center">
                        <div>
                            <h3 className="text-xl font-semibold mb-4">What You Can Win:</h3>
                            <ul className="space-y-3">
                                <li className="flex items-center">
                                    <span className="text-green-500 mr-3">✓</span>
                                    $50 Gift Card to your choice of major retailers
                                </li>
                                <li className="flex items-center">
                                    <span className="text-green-500 mr-3">✓</span>
                                    Featured reviewer status on our site
                                </li>
                                <li className="flex items-center">
                                    <span className="text-green-500 mr-3">✓</span>
                                    Bragging rights as a pizza expert
                                </li>
                            </ul>
                        </div>
                        <div className="text-center">
                            <div className="bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-full w-32 h-32 flex items-center justify-center mx-auto mb-4">
                                <span className="text-3xl font-bold">$50</span>
                            </div>
                            <p className="text-lg font-semibold">Gift Card Value</p>
                        </div>
                    </div>
                </div>

                {/* Rules & Eligibility */}
                <div className="bg-white rounded-xl p-8 shadow-lg mb-8">
                    <h2 className="text-3xl font-bold mb-6 text-center">📋 Rules & Eligibility</h2>
                    <div className="grid md:grid-cols-2 gap-8">
                        <div>
                            <h3 className="text-xl font-semibold mb-4">Eligibility:</h3>
                            <ul className="space-y-2 text-gray-700">
                                <li>• Must be a registered user</li>
                                <li>• Must submit at least one review during the month</li>
                                <li>• Reviews must be genuine and helpful</li>
                                <li>• One entry per review (multiple reviews = multiple entries)</li>
                            </ul>
                        </div>
                        <div>
                            <h3 className="text-xl font-semibold mb-4">Important Notes:</h3>
                            <ul className="space-y-2 text-gray-700">
                                <li>• Drawing occurs on the 1st of each month</li>
                                <li>• Winners are notified via email</li>
                                <li>• Gift cards are delivered digitally</li>
                                <li>• No purchase necessary to participate</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {/* Next Month Preview */}
                <div className="bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl p-8 shadow-lg mb-8">
                    <h2 className="text-3xl font-bold mb-4 text-center">🚀 {nextMonth} is Coming!</h2>
                    <p className="text-xl text-center mb-6 opacity-90">
                        Don't miss out on next month's giveaway! Start reviewing pizzas now to build up your entries.
                    </p>
                    <div className="text-center">
                        <Link
                            href="/pizzas"
                            className="bg-white text-blue-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 inline-block"
                        >
                            Start Reviewing Today
                        </Link>
                    </div>
                </div>

                {/* FAQ Section */}
                <div className="bg-white rounded-xl p-8 shadow-lg">
                    <h2 className="text-3xl font-bold mb-6 text-center">❓ Frequently Asked Questions</h2>
                    <div className="space-y-6">
                        <div>
                            <h3 className="text-lg font-semibold mb-2">How many times can I enter?</h3>
                            <p className="text-gray-600">You get one entry for each review you submit. The more reviews, the more chances to win!</p>
                        </div>
                        <div>
                            <h3 className="text-lg font-semibold mb-2">When are winners announced?</h3>
                            <p className="text-gray-600">Winners are selected and notified on the 1st of each month for the previous month's entries.</p>
                        </div>
                        <div>
                            <h3 className="text-lg font-semibold mb-2">What can I buy with the gift card?</h3>
                            <p className="text-gray-600">The $50 gift card can be used at major retailers like Amazon, Walmart, Target, or other popular stores.</p>
                        </div>
                        <div>
                            <h3 className="text-lg font-semibold mb-2">Do I need to buy pizzas to participate?</h3>
                            <p className="text-gray-600">No! You can review any pizzas you've tried before, whether you bought them or had them elsewhere.</p>
                        </div>
                    </div>
                </div>
            </div>
        </MainLayout>
    );
}

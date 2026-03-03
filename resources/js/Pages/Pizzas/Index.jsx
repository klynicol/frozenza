import React from 'react';
import MainLayout from '@/Layouts/MainLayout';
import axios from 'axios';
import { useState, useEffect } from 'react';
import PizzaGridWithPromo from '@/Components/Common/PizzaGridWithPromo';
import ApplicationLogo from '@/Components/ApplicationLogo';

export default function PizzasIndex({ pizzasFirstPage, meta, auth }) {
    const [pizzas, setPizzas] = useState(pizzasFirstPage);

    const fetchPizzas = async () => {
        const page = pizzas.current_page + 1;
        const response = await axios.get(`/pizzas/list?page=${page}`);
        setPizzas(response.data);
    };

    // if the user scrolls to the bottom of the page, fetch the next page
    useEffect(() => {
        const handleScroll = () => {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100) {
                fetchPizzas();
            }
        };
        window.addEventListener('scroll', handleScroll);
        return () => window.removeEventListener('scroll', handleScroll);
    }, [pizzas]);

    return (
        <MainLayout meta={meta} auth={auth}>
            <div className="max-w-[1880px] mx-auto px-4 sm:px-5 lg:px-6 py-8">
                <div className="text-center mb-12">
                    <div className="flex justify-center mb-6">
                        <ApplicationLogo className="w-[260px] h-[260px]" />
                    </div>
                    <h1 className="text-4xl font-extrabold text-gray-900 mb-4">Welcome to Pizza Kraken</h1>
                    <p className="text-xl text-gray-600 max-w-3xl mx-auto">
                        Discover the world's most comprehensive frozen pizza database. From DiGiorno to Table 87 (and everything in between),
                        explore thousands of frozen pizzas from brands across the globe. Rate, review, and find your next
                        favorite slice!
                    </p>
                    <a
                        href="https://discord.gg/YOUR-INVITE-LINK"
                        target="_blank"
                        rel="noopener noreferrer"
                        className="inline-block mt-6 px-6 py-3 bg-[#5865F2] hover:bg-[#4752C4] text-white font-semibold rounded-lg transition-colors duration-200"
                    >
                        <div className="flex items-center space-x-2">
                            <svg className="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515a.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0a12.64 12.64 0 0 0-.617-1.25a.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057a19.9 19.9 0 0 0 5.993 3.03a.078.078 0 0 0 .084-.028a14.09 14.09 0 0 0 1.226-1.994a.076.076 0 0 0-.041-.106a13.107 13.107 0 0 1-1.872-.892a.077.077 0 0 1-.008-.128a10.2 10.2 0 0 0 .372-.292a.074.074 0 0 1 .077-.01c3.928 1.793 8.18 1.793 12.062 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127a12.299 12.299 0 0 1-1.873.892a.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028a19.839 19.839 0 0 0 6.002-3.03a.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.03zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.956-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419c0-1.333.955-2.419 2.157-2.419c1.21 0 2.176 1.096 2.157 2.42c0 1.333-.946 2.418-2.157 2.418z"/>
                            </svg>
                            <span>Join our Discord</span>
                        </div>
                    </a>
                </div>

                {/* Giveaway Promotional Banner */}
                <div className="bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl p-8 mb-8 relative overflow-hidden">
                    <div className="absolute inset-0 bg-black bg-opacity-10"></div>
                    <div className="relative z-10 text-center">
                        <div className="flex items-center justify-center space-x-3 mb-4">
                            <span className="text-4xl">🎉</span>
                            <h3 className="text-3xl font-bold">Monthly $50 Gift Card Giveaway!</h3>
                            <span className="text-4xl">🎉</span>
                        </div>
                        <p className="text-xl opacity-90 mb-6 max-w-3xl mx-auto">
                            Review any pizza this month and get entered to win! The more reviews you write, 
                            the more chances you have to win. New month, new opportunity!
                        </p>
                        <div className="flex flex-wrap justify-center gap-4">
                            <a
                                href="/giveaway"
                                className="bg-white text-purple-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
                            >
                                Learn More
                            </a>
                            {auth.user ? (
                                <a
                                    href="/pizzas"
                                    className="bg-yellow-400 text-purple-800 px-8 py-4 rounded-full font-bold text-lg hover:bg-yellow-300 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
                                >
                                    Start Reviewing
                                </a>
                            ) : (
                                <a
                                    href="/login"
                                    className="bg-yellow-400 text-purple-800 px-8 py-4 rounded-full font-bold text-lg hover:bg-yellow-300 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
                                >
                                    Sign In to Participate
                                </a>
                            )}
                        </div>
                    </div>
                    
                    {/* Floating elements */}
                    <div className="absolute top-8 right-8 w-24 h-24 bg-white bg-opacity-10 rounded-full animate-bounce"></div>
                    <div className="absolute bottom-8 left-8 w-20 h-20 bg-white bg-opacity-10 rounded-full animate-pulse delay-1000"></div>
                </div>

                <h2 className="text-2xl font-bold mb-6">Featured Pizzas</h2>
                <PizzaGridWithPromo pizzas={pizzas} />
            </div>
        </MainLayout>
    );
} 
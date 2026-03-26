import React, { useState, useEffect } from 'react';
import { Link } from '@inertiajs/react';

export default function PromotionalBanner({ auth }) {
    const [isVisible, setIsVisible] = useState(true);
    const [timeLeft, setTimeLeft] = useState({
        days: 0,
        hours: 0,
        minutes: 0,
        seconds: 0
    });

    useEffect(() => {
        // Load visibility preference on the client only (SSR has no localStorage).
        try {
            const stored = window?.localStorage?.getItem('promotionalBanner');
            if (stored === 'false') setIsVisible(false);
        } catch {
            // Ignore storage access errors (privacy mode, blocked storage, etc).
        }

        // Calculate time until end of current month
        const now = new Date();
        const endOfMonth = new Date(now.getFullYear(), now.getMonth() + 1, 0, 23, 59, 59);
        const timeDiff = endOfMonth - now;

        const timer = setInterval(() => {
            const now = new Date();
            const diff = endOfMonth - now;
            
            if (diff > 0) {
                setTimeLeft({
                    days: Math.floor(diff / (1000 * 60 * 60 * 24)),
                    hours: Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
                    minutes: Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60)),
                    seconds: Math.floor((diff % (1000 * 60)) / 1000)
                });
            } else {
                clearInterval(timer);
            }
        }, 1000);

        return () => clearInterval(timer);
    }, []);

    function handleSetIsVisible(value) {
        try {
            window?.localStorage?.setItem('promotionalBanner', value);
        } catch {
            // Ignore storage access errors.
        }
        setIsVisible(value);
    }

    if (!isVisible) return null;

    return (
        <div className="bg-gradient-to-r from-purple-600 via-pink-600 to-red-600 text-white relative overflow-hidden">
            {/* Animated background elements */}
            <div className="absolute inset-0 overflow-hidden">
                <div className="absolute -top-40 -right-40 w-80 h-80 bg-white opacity-10 rounded-full animate-pulse"></div>
                <div className="absolute -bottom-40 -left-40 w-60 h-60 bg-white opacity-10 rounded-full animate-pulse delay-1000"></div>
                <div className="absolute top-20 left-20 w-20 h-20 bg-white opacity-10 rounded-full animate-bounce delay-500"></div>
            </div>

            <div className="container mx-auto px-4 py-6 relative z-10">
                <div className="flex flex-col md:flex-row items-center justify-between">
                    <div className="flex-1 text-center md:text-left mb-4 md:mb-0">
                        <div className="flex items-center justify-center md:justify-start space-x-2 mb-2">
                            <span className="text-2xl">🎉</span>
                            <h2 className="text-2xl md:text-3xl font-bold">
                                Monthly $50 Gift Card Giveaway!
                            </h2>
                            <span className="text-2xl">🎉</span>
                        </div>
                        <p className="text-lg md:text-xl opacity-90">
                            Submit a pizza review this month for a chance to win!
                        </p>
                    </div>

                    <div className="flex flex-col items-center space-y-3">
                        <div className="text-center">
                            <p className="text-sm opacity-80 mb-2">Drawing ends in:</p>
                            <div className="flex space-x-2">
                                <div className="bg-white bg-opacity-20 rounded-lg px-3 py-2 min-w-[60px]">
                                    <div className="text-2xl font-bold">{timeLeft.days}</div>
                                    <div className="text-xs opacity-80">Days</div>
                                </div>
                                <div className="bg-white bg-opacity-20 rounded-lg px-3 py-2 min-w-[60px]">
                                    <div className="text-2xl font-bold">{timeLeft.hours}</div>
                                    <div className="text-xs opacity-80">Hours</div>
                                </div>
                                <div className="bg-white bg-opacity-20 rounded-lg px-3 py-2 min-w-[60px]">
                                    <div className="text-2xl font-bold">{timeLeft.minutes}</div>
                                    <div className="text-xs opacity-80">Min</div>
                                </div>
                                <div className="bg-white bg-opacity-20 rounded-lg px-3 py-2 min-w-[60px]">
                                    <div className="text-2xl font-bold">{timeLeft.seconds}</div>
                                    <div className="text-xs opacity-80">Sec</div>
                                </div>
                            </div>
                        </div>
                        
                        <div className="flex space-x-3">
                            <Link
                                href="/pizzas"
                                className="bg-white text-purple-600 px-6 py-3 rounded-full font-bold hover:bg-gray-100 transition-colors duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
                            >
                                Browse Pizzas
                            </Link>
                            {auth.user ? (
                                <Link
                                    href="/pizzas"
                                    className="bg-yellow-400 text-purple-800 px-6 py-3 rounded-full font-bold hover:bg-yellow-300 transition-colors duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
                                >
                                    Write Review
                                </Link>
                            ) : (
                                <Link
                                    href="/login"
                                    className="bg-yellow-400 text-purple-800 px-6 py-3 rounded-full font-bold hover:bg-yellow-300 transition-colors duration-200 shadow-lg hover:shadow-xl transform hover:scale-105"
                                >
                                    Sign In to Review
                                </Link>
                            )}
                        </div>
                    </div>
                </div>

                {/* Close button */}
                <button
                    onClick={() => handleSetIsVisible(false)}
                    className="absolute top-4 right-4 text-white hover:text-gray-200 transition-colors"
                    aria-label="Close promotional banner"
                >
                    <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    );
}

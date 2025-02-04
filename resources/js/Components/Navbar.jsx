import React from 'react';
import { Link } from '@inertiajs/react';

export default function Navbar() {
    return (
        <nav className="bg-white shadow">
            <div className="container mx-auto px-4">
                <div className="flex justify-between h-16">
                    <div className="flex">
                        <Link href="/" className="flex items-center">
                            <span className="text-xl font-bold text-gray-800">
                                FrozenPizzaReviews
                            </span>
                        </Link>
                        <div className="ml-10 flex items-center space-x-4">
                            <Link 
                                href="/top-rated" 
                                className="text-gray-600 hover:text-gray-900"
                            >
                                Top Rated
                            </Link>
                            <Link 
                                href="/brands" 
                                className="text-gray-600 hover:text-gray-900"
                            >
                                Brands
                            </Link>
                            <Link 
                                href="/styles" 
                                className="text-gray-600 hover:text-gray-900"
                            >
                                Styles
                            </Link>
                            <Link 
                                href="/categories" 
                                className="text-gray-600 hover:text-gray-900"
                            >
                                Categories
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    );
} 
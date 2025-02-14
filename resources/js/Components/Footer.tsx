import React from 'react';
import { Link } from '@inertiajs/react';

export default function Footer() {
    return (
        <footer className="bg-gray-800 text-white">
            <div className="container mx-auto px-4 py-8">
                <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 className="text-lg font-bold mb-4">Quick Links</h3>
                        <ul className="space-y-2">
                            <li>
                                <Link href="/top-rated" className="hover:text-gray-300">
                                    Top Rated Pizzas
                                </Link>
                            </li>
                            <li>
                                <Link href="/brands" className="hover:text-gray-300">
                                    Browse Brands
                                </Link>
                            </li>
                            {/* <li>
                                <Link href="/styles" className="hover:text-gray-300">
                                    Pizza Styles
                                </Link>
                            </li> */}
                        </ul>
                    </div>
                </div>
                <div className="mt-8 pt-8 border-t border-gray-700 text-center">
                    <p>&copy; {new Date().getFullYear()} FrozenPizzaReviews. All rights reserved.</p>
                </div>
            </div>
        </footer>
    );
} 
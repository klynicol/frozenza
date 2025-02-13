import React from 'react';
import { Link } from '@inertiajs/react';
import { SearchIcon } from './Icons';
import ApplicationLogo from './ApplicationLogo';

export default function Navbar({ auth }) {
    return (
        <nav className="bg-white shadow">
            <div className="container mx-auto px-4">
                <div className="flex justify-between h-16">
                    <div className="flex">
                        <div className="flex items-center">
                            <span className="text-xl font-bold text-gray-800">
                                <Link href="/">
                                    <ApplicationLogo className="h-10 w-10 fill-current text-gray-500" />
                                </Link>
                            </span>
                        </div>
                        <div className="ml-10 flex items-center space-x-4 w-full">
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
                            {/**Search bar */}
                            {/* <div className="relative">
                                <input
                                    type="text"
                                    placeholder="Search..."
                                    className="w-full rounded-full border-2 border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                />
                                <button className="absolute right-0 top-0 h-full px-2">
                                    <SearchIcon className="h-4 w-4 text-gray-400" />
                                </button>
                            </div> */}
                        </div>
                    </div>
                    <div className="flex items-center">
                        {auth.user ? (
                            <Link
                                href="/logout"
                                className="text-gray-600 hover:text-gray-900"
                            >
                                Logout
                            </Link>
                        ) : (
                            <Link
                                href="/login"
                                className="text-gray-600 hover:text-gray-900"
                            >
                                Login
                            </Link>
                        )}
                    </div>
                </div>
            </div>
        </nav>
    );
} 
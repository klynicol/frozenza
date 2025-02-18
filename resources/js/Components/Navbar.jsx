import React, { useState } from 'react';
import { Link } from '@inertiajs/react';
import { SearchIcon } from './Icons';
import ApplicationLogo from './ApplicationLogo';
import { router } from '@inertiajs/react';
import { FacebookIcon, DiscordIcon } from './Icons';

export default function Navbar({ auth }) {
    const [isOpen, setIsOpen] = useState(false);

    const socialLinks = [
        { icon: FacebookIcon, href: 'https://www.facebook.com/profile.php?id=61573217433128', label: 'Facebook' },
        { icon: DiscordIcon, href: 'https://discord.gg/ccGKZPE76k', label: 'Discord' },
    ];

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
                        
                        {/* Desktop Menu */}
                        <div className="hidden md:ml-10 md:flex md:items-center md:space-x-4">
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
                                href="/contact"
                                className="text-gray-600 hover:text-gray-900"
                            >
                                Contact
                            </Link>
                        </div>
                    </div>

                    {/* Desktop Auth and Social Links */}
                    <div className="hidden md:flex md:items-center md:space-x-4">
                        {/* Social Links */}
                        <div className="flex space-x-3 mr-4">
                            {socialLinks.map((social) => (
                                <a
                                    key={social.label}
                                    href={social.href}
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    className="text-gray-600 hover:text-gray-900 transition-colors"
                                    aria-label={social.label}
                                >
                                    <social.icon className="w-8 h-8" />
                                </a>
                            ))}
                        </div>
                        
                        {/* Auth Menu */}
                        {auth.user ? (
                            <button
                                type="submit"
                                className="text-gray-600 hover:text-gray-900"
                                onClick={() => {
                                    router.post('/logout');
                                }}
                            >
                                Logout
                            </button>
                        ) : (
                            <Link
                                href="/login"
                                className="text-gray-600 hover:text-gray-900"
                            >
                                Login
                            </Link>
                        )}
                    </div>

                    {/* Mobile menu button */}
                    <div className="flex items-center md:hidden">
                        <button
                            onClick={() => setIsOpen(!isOpen)}
                            className="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            aria-expanded="false"
                        >
                            <span className="sr-only">Open main menu</span>
                            {/* Menu icon */}
                            {!isOpen ? (
                                <svg className="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            ) : (
                                <svg className="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            )}
                        </button>
                    </div>
                </div>
            </div>

            {/* Mobile menu */}
            <div className={`${isOpen ? 'block' : 'hidden'} md:hidden`}>
                <div className="px-2 pt-2 pb-3 space-y-1">
                    <Link
                        href="/top-rated"
                        className="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50"
                    >
                        Top Rated
                    </Link>
                    <Link
                        href="/brands"
                        className="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50"
                    >
                        Brands
                    </Link>
                    <Link
                        href="/contact"
                        className="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50"
                    >
                        Contact
                    </Link>
                    
                    {/* Mobile Social Links */}
                    <div className="flex space-x-4 px-3 py-2">
                        {socialLinks.map((social) => (
                            <a
                                key={social.label}
                                href={social.href}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="text-gray-700 hover:text-gray-900"
                                aria-label={social.label}
                            >
                                <social.icon className="w-5 h-5" />
                            </a>
                        ))}
                    </div>

                    {auth.user ? (
                        <button
                            type="submit"
                            className="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50"
                            onClick={() => {
                                router.post('/logout');
                            }}
                        >
                            Logout
                        </button>
                    ) : (
                        <Link
                            href="/login"
                            className="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50"
                        >
                            Login
                        </Link>
                    )}
                </div>
            </div>
        </nav>
    );
} 
import React, { useState, useRef, useEffect } from 'react';
import { Link } from '@inertiajs/react';
import { SearchIcon } from './Icons';
import ApplicationLogo from './ApplicationLogo';
import { router } from '@inertiajs/react';
import {
    FacebookIcon,
    DiscordIcon,
    BlueSkyIcon,
    TwitterIcon,
    InstagramIcon,
    ChevronDownIcon,
    AdminDashboardIcon,
    AmbassadorDashboardIcon,
    SubmitBrandIcon,
    SubmitPizzaIcon,
} from './Icons';
import { hasRole } from '@/utils/roles';

export default function Navbar({ auth }) {
    const [isOpen, setIsOpen] = useState(false);
    const [activeDropdown, setActiveDropdown] = useState(null);
    const dropdownRef = useRef(null);

    const socialLinks = [
        { icon: FacebookIcon, href: 'https://www.facebook.com/profile.php?id=61573217433128', label: 'Facebook' },
        { icon: DiscordIcon, href: 'https://discord.gg/ccGKZPE76k', label: 'Discord' },
        { icon: InstagramIcon, href: 'https://www.instagram.com/pizza.kraken', label: 'Instagram' },
        { icon: TwitterIcon, href: 'https://x.com/pizza_kraken', label: 'Twitter' },
        // { icon: BlueSkyIcon, href: 'https://bsky.app/profile/pizza-kraken.bsky.social', label: 'BlueSky' },
    ];

    // Close dropdown when clicking outside
    useEffect(() => {
        const handleClickOutside = (event) => {
            if (dropdownRef.current && !dropdownRef.current.contains(event.target)) {
                setActiveDropdown(null);
            }
        };

        document.addEventListener('mousedown', handleClickOutside);
        return () => document.removeEventListener('mousedown', handleClickOutside);
    }, []);

    // Close mobile menu when clicking outside
    useEffect(() => {
        const handleClickOutside = (event) => {
            if (isOpen && !event.target.closest('nav')) {
                setIsOpen(false);
            }
        };

        document.addEventListener('mousedown', handleClickOutside);
        return () => document.removeEventListener('mousedown', handleClickOutside);
    }, [isOpen]);

    const toggleDropdown = (dropdownName) => {
        setActiveDropdown(activeDropdown === dropdownName ? null : dropdownName);
    };

    const closeDropdown = () => {
        setActiveDropdown(null);
    };

    const closeMobileMenu = () => {
        setIsOpen(false);
    };

    // Navigation items with submenu support
    const navigationItems = [
        {
            name: 'Top Rated',
            href: '/top-rated',
            hasSubmenu: false
        },
        {
            name: 'Brands',
            href: '/brands',
            hasSubmenu: false
        },
        {
            name: 'Pizzas',
            href: '/pizzas',
            hasSubmenu: false
        },
        // {
        //     name: 'Styles',
        //     href: '/styles',
        //     hasSubmenu: false
        // },
        // {
        //     name: 'Categories',
        //     href: '/categories',
        //     hasSubmenu: false
        // },
        {
            name: 'Contact',
            href: '/contact',
            hasSubmenu: false
        },
        {
            name: 'About',
            href: '/about',
            hasSubmenu: false
        },
        {
            name: 'Giveaway',
            href: '/giveaway',
            hasSubmenu: false
        },
        {
            name: 'Blog',
            href: '/blogs',
            hasSubmenu: false
        }
    ];

    // Admin menu items
    const adminMenuItems = [
        {
            name: 'Dashboard',
            href: '/admin/dashboard',
            icon: <AdminDashboardIcon />
        }
    ];

    // Pizza Ambassador menu items
    const ambassadorMenuItems = [
        {
            name: 'Dashboard',
            href: '/pizza-ambassador/dashboard',
            icon: <AmbassadorDashboardIcon />
        },
        {
            name: 'Submit Brand',
            href: '/brand-submissions/create',
            icon: <SubmitBrandIcon />
        },
        {
            name: 'Submit Pizza',
            href: '/pizza-submissions/create',
            icon: <SubmitPizzaIcon />
        }
    ];

    return (
        <nav className="bg-white shadow relative">
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
                        <div className="hidden lg:ml-10 lg:flex lg:items-center lg:space-x-1">
                            {navigationItems.map((item) => (
                                <div key={item.name} className="relative">
                                    <Link
                                        href={item.href}
                                        className="px-3 py-2 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md text-sm font-medium transition-colors"
                                    >
                                        {item.name}
                                    </Link>
                                </div>
                            ))}

                            {/* Admin Dropdown */}
                            {hasRole(auth.user, 'admin') && (
                                <div className="relative" ref={dropdownRef}>
                                    <button
                                        onClick={() => toggleDropdown('admin')}
                                        className="px-3 py-2 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md text-sm font-medium transition-colors flex items-center space-x-1"
                                    >
                                        <span>Admin</span>
                                        <ChevronDownIcon className={`transition-transform ${activeDropdown === 'admin' ? 'rotate-180' : ''}`} />
                                    </button>
                                    
                                    {activeDropdown === 'admin' && (
                                        <div className="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
                                            {adminMenuItems.map((item) => (
                                                <Link
                                                    key={item.name}
                                                    href={item.href}
                                                    onClick={closeDropdown}
                                                    className="flex items-center space-x-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors"
                                                >
                                                    {item.icon}
                                                    <span>{item.name}</span>
                                                </Link>
                                            ))}
                                        </div>
                                    )}
                                </div>
                            )}

                            {/* Pizza Ambassador Dropdown */}
                            {hasRole(auth.user, 'admin,pizza-ambassador') && (
                                <div className="relative" ref={dropdownRef}>
                                    <button
                                        onClick={() => toggleDropdown('ambassador')}
                                        className="px-3 py-2 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md text-sm font-medium transition-colors flex items-center space-x-1"
                                    >
                                        <span>Ambassador</span>
                                        <ChevronDownIcon className={`transition-transform ${activeDropdown === 'ambassador' ? 'rotate-180' : ''}`} />
                                    </button>
                                    
                                    {activeDropdown === 'ambassador' && (
                                        <div className="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
                                            {ambassadorMenuItems.map((item) => (
                                                <Link
                                                    key={item.name}
                                                    href={item.href}
                                                    onClick={closeDropdown}
                                                    className="flex items-center space-x-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors"
                                                >
                                                    {item.icon}
                                                    <span>{item.name}</span>
                                                </Link>
                                            ))}
                                        </div>
                                    )}
                                </div>
                            )}
                        </div>
                    </div>

                    {/* Desktop Auth and Social Links */}
                    <div className="hidden lg:flex lg:items-center lg:space-x-4">
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
                                className="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-50 transition-colors"
                                onClick={() => {
                                    router.post('/logout');
                                }}
                            >
                                Logout
                            </button>
                        ) : (
                            <Link
                                href="/login"
                                className="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-50 transition-colors"
                            >
                                Login
                            </Link>
                        )}
                    </div>

                    {/* Mobile menu button */}
                    <div className="flex items-center lg:hidden">
                        <button
                            onClick={() => setIsOpen(!isOpen)}
                            className="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 transition-colors"
                            aria-expanded="false"
                        >
                            <span className="sr-only">Open main menu</span>
                            {/* Animated hamburger icon */}
                            <div className="w-6 h-6 flex flex-col justify-center items-center">
                                <span className={`block w-5 h-0.5 bg-current transition-all duration-300 ${isOpen ? 'rotate-45 translate-y-1' : ''}`}></span>
                                <span className={`block w-5 h-0.5 bg-current transition-all duration-300 mt-1 ${isOpen ? 'opacity-0' : ''}`}></span>
                                <span className={`block w-5 h-0.5 bg-current transition-all duration-300 mt-1 ${isOpen ? '-rotate-45 -translate-y-1' : ''}`}></span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            {/* Mobile menu */}
            <div className={`lg:hidden transition-all duration-300 ease-in-out ${isOpen ? 'max-h-screen opacity-100' : 'max-h-0 opacity-0 overflow-hidden'}`}>
                <div className="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-gray-200">
                    {/* Main Navigation Items */}
                    {navigationItems.map((item) => (
                        <Link
                            key={item.name}
                            href={item.href}
                            onClick={closeMobileMenu}
                            className="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 transition-colors"
                        >
                            {item.name}
                        </Link>
                    ))}

                    {/* Admin Section */}
                    {hasRole(auth.user, 'admin') && (
                        <div className="border-t border-gray-200 pt-4 mt-4">
                            <div className="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Admin
                            </div>
                            {adminMenuItems.map((item) => (
                                <Link
                                    key={item.name}
                                    href={item.href}
                                    onClick={closeMobileMenu}
                                    className="flex items-center space-x-2 px-6 py-2 text-sm text-gray-700 hover:text-gray-900 hover:bg-gray-50 rounded-md transition-colors"
                                >
                                    {item.icon}
                                    <span>{item.name}</span>
                                </Link>
                            ))}
                        </div>
                    )}

                    {/* Pizza Ambassador Section */}
                    {hasRole(auth.user, 'admin,pizza-ambassador') && (
                        <div className="border-t border-gray-200 pt-4 mt-4">
                            <div className="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Pizza Ambassador
                            </div>
                            {ambassadorMenuItems.map((item) => (
                                <Link
                                    key={item.name}
                                    href={item.href}
                                    onClick={closeMobileMenu}
                                    className="flex items-center space-x-2 px-6 py-2 text-sm text-gray-700 hover:text-gray-900 hover:bg-gray-50 rounded-md transition-colors"
                                >
                                    {item.icon}
                                    <span>{item.name}</span>
                                </Link>
                            ))}
                        </div>
                    )}

                    {/* Social Links */}
                    <div className="border-t border-gray-200 pt-4 mt-4">
                        <div className="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Follow Us
                        </div>
                        <div className="flex space-x-4 px-6 py-2">
                            {socialLinks.map((social) => (
                                <a
                                    key={social.label}
                                    href={social.href}
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    className="text-gray-700 hover:text-gray-900 transition-colors"
                                    aria-label={social.label}
                                >
                                    <social.icon className="w-6 h-6" />
                                </a>
                            ))}
                        </div>
                    </div>

                    {/* Auth Section */}
                    <div className="border-t border-gray-200 pt-4 mt-4">
                        {auth.user ? (
                            <button
                                type="submit"
                                className="block w-full text-left px-6 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 rounded-md transition-colors"
                                onClick={() => {
                                    router.post('/logout');
                                    closeMobileMenu();
                                }}
                            >
                                Logout
                            </button>
                        ) : (
                            <Link
                                href="/login"
                                onClick={closeMobileMenu}
                                className="block px-6 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 rounded-md transition-colors"
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
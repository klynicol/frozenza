import React from 'react';
import AdminLayout from '@/Layouts/AdminLayout';
import { Head } from '@inertiajs/react';

export default function Dashboard() {
    return (
        <AdminLayout>
            <Head title="Admin Dashboard" />
            
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <h1 className="text-2xl font-semibold mb-6">Admin Dashboard</h1>
                            
                            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                {/* Quick Stats Cards */}
                                <div className="bg-blue-50 p-6 rounded-lg border border-blue-200">
                                    <h3 className="text-lg font-medium text-blue-900 mb-2">Total Pizzas</h3>
                                    <p className="text-3xl font-bold text-blue-600">0</p>
                                    <p className="text-sm text-blue-700 mt-1">Manage pizza listings</p>
                                </div>
                                
                                <div className="bg-green-50 p-6 rounded-lg border border-green-200">
                                    <h3 className="text-lg font-medium text-green-900 mb-2">Total Brands</h3>
                                    <p className="text-3xl font-bold text-green-600">0</p>
                                    <p className="text-sm text-green-700 mt-1">Manage brand information</p>
                                </div>
                                
                                <div className="bg-purple-50 p-6 rounded-lg border border-purple-200">
                                    <h3 className="text-lg font-medium text-purple-900 mb-2">Total Users</h3>
                                    <p className="text-3xl font-bold text-purple-600">0</p>
                                    <p className="text-sm text-purple-700 mt-1">User management</p>
                                </div>
                                
                                <div className="bg-yellow-50 p-6 rounded-lg border border-yellow-200">
                                    <h3 className="text-lg font-medium text-yellow-900 mb-2">Total Reviews</h3>
                                    <p className="text-3xl font-bold text-yellow-600">0</p>
                                    <p className="text-sm text-yellow-700 mt-1">Review moderation</p>
                                </div>
                                
                                <div className="bg-red-50 p-6 rounded-lg border border-red-200">
                                    <h3 className="text-lg font-medium text-red-900 mb-2">Total Messages</h3>
                                    <p className="text-3xl font-bold text-red-600">0</p>
                                    <p className="text-sm text-red-700 mt-1">Customer support</p>
                                </div>
                                
                                <div className="bg-indigo-50 p-6 rounded-lg border border-indigo-200">
                                    <h3 className="text-lg font-medium text-indigo-900 mb-2">Affiliate Links</h3>
                                    <p className="text-3xl font-bold text-indigo-600">0</p>
                                    <p className="text-sm text-indigo-700 mt-1">Manage affiliate program</p>
                                </div>
                            </div>
                            
                            <div className="mt-8">
                                <h2 className="text-xl font-semibold mb-4">Quick Actions</h2>
                                <div className="flex flex-wrap gap-4">
                                    <a
                                        href={route('admin.affiliate-links.index')}
                                        className="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    >
                                        Manage Affiliate Links
                                    </a>
                                    
                                    <a
                                        href={route('blogs.create')}
                                        className="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    >
                                        Create Blog Post
                                    </a>
                                    
                                    <a
                                        href={route('messages.index')}
                                        className="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    >
                                        View Messages
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AdminLayout>
    );
}

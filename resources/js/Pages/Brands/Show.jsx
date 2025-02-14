import React from 'react';
import MainLayout from '@/Layouts/MainLayout';
import { Link } from '@inertiajs/react';
import PizzaListItem from '@/Components/Common/PizzaListItem';
import { getImageUrl } from '@/utils/image';

export default function BrandShow({ brand, meta, auth }) {
    console.log(brand);
    return (
        <MainLayout meta={meta} auth={auth}>
            <div className="bg-white shadow-lg rounded-lg overflow-hidden mb-8">
                <div className="p-6">
                    <div className="flex flex-col sm:flex-row items-center sm:items-start gap-6">
                        {brand?.image && (
                            <div className="flex-shrink-0">
                                <img 
                                    src={getImageUrl(brand.image)} 
                                    alt={`${brand.name} logo`}
                                    className="w-32 h-32 object-contain"
                                />
                            </div>
                        )}
                        <div className="text-center sm:text-left">
                            <h1 className="text-3xl font-bold mb-2">{brand.name}</h1>
                            <p className="text-gray-600 mb-4">{brand.description}</p>
                            {brand.website && (
                                <a
                                    href={brand.website}
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    className="text-blue-600 hover:underline inline-flex items-center gap-1"
                                >
                                    <span>{brand.website}</span>
                                    <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>
                            )}
                        </div>
                    </div>
                </div>
            </div>

            <div className="flex items-center justify-between mb-6">
                <h2 className="text-2xl font-bold">Pizzas by {brand.name} ({brand.pizzas.length})</h2>
            </div>
            
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {brand.pizzas.length > 0 ? (
                    brand.pizzas.map((pizza) => (
                        <PizzaListItem key={pizza.id} pizza={pizza} />
                    ))
                ) : (
                    <p className="text-gray-600">No pizzas found for this brand.</p>
                )}
            </div>
        </MainLayout>
    );
} 
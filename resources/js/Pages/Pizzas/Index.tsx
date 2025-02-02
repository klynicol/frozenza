import React from 'react';
import { Head } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import type { Pizza } from '@/types/models';
import type { PizzaListProps } from '@/types/props';

export default function PizzasIndex({ pizzas, meta, auth }: PizzaListProps) {
    return (
        <MainLayout meta={meta} auth={auth}>
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {pizzas.map((pizza) => (
                    <div key={pizza.id} className="bg-white rounded-lg shadow-md overflow-hidden">
                        {pizza.image_url && (
                            <img 
                                src={pizza.image_url} 
                                alt={pizza.name}
                                className="w-full h-48 object-cover"
                            />
                        )}
                        <div className="p-4">
                            <h2 className="text-xl font-bold mb-2">{pizza.name}</h2>
                            <p className="text-gray-600 mb-2">{pizza.brand.name}</p>
                            <p className="text-sm text-gray-500 mb-4">{pizza.style.name}</p>
                            <div className="flex justify-between items-center">
                                <div className="flex items-center">
                                    <span className="text-yellow-400">★</span>
                                    <span className="ml-1">{pizza.average_rating.toFixed(1)}</span>
                                    <span className="text-gray-500 text-sm ml-2">
                                        ({pizza.total_reviews} reviews)
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                ))}
            </div>
        </MainLayout>
    );
} 
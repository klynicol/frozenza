import React from 'react';
import MainLayout from '@/Layouts/MainLayout';
import { Link } from '@inertiajs/react';
import PizzaListItem from '@/Components/Common/PizzaListItem';

export default function BrandShow({ brand, meta, auth }) {
    return (
        <MainLayout meta={meta} auth={auth}>
            <div className="bg-white shadow-lg rounded-lg overflow-hidden mb-8">
                <div className="p-6">
                    <h1 className="text-3xl font-bold mb-2">{brand.name}</h1>
                    <p className="text-gray-600 mb-4">{brand.description}</p>
                    {brand.website && (
                        <a
                            href={brand.website}
                            target="_blank"
                            rel="noopener noreferrer"
                            className="text-blue-600 hover:underline"
                        >
                            {brand.website}
                        </a>
                    )}
                </div>
            </div>

            <h2 className="text-2xl font-bold mb-4">Pizzas by {brand.name}</h2>
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
import React from 'react';
import MainLayout from '@/Layouts/MainLayout';
import type { Style, Pizza } from '@/types/models';
import type { PageProps } from '@/types/props';
import { Link } from '@inertiajs/react';

interface StyleShowProps extends PageProps {
    style: Style & {
        pizzas: Pizza[];
    };
}

export default function StyleShow({ style, meta, auth }: StyleShowProps) {
    return (
        <MainLayout meta={meta} auth={auth}>
            <div className="bg-white shadow-lg rounded-lg overflow-hidden mb-8">
                <div className="p-6">
                    <h1 className="text-3xl font-bold mb-2">{style.name}</h1>
                    <p className="text-gray-600">{style.description}</p>
                </div>
            </div>

            <h2 className="text-2xl font-bold mb-4">{style.name} Pizzas</h2>
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {style.pizzas.map((pizza) => (
                    <Link 
                        key={pizza.id}
                        href={`/pizzas/${pizza.brand.slug}/${pizza.slug}`}
                        className="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow"
                    >
                        {pizza.image_url && (
                            <img 
                                src={pizza.image_url} 
                                alt={pizza.name}
                                className="w-full h-48 object-cover"
                            />
                        )}
                        <div className="p-4">
                            <h3 className="text-xl font-bold mb-2">{pizza.name}</h3>
                            <p className="text-gray-600 mb-2">{pizza.brand.name}</p>
                            <div className="flex items-center">
                                <span className="text-yellow-400">★</span>
                                <span className="ml-1">{pizza.average_rating.toFixed(1)}</span>
                                <span className="text-gray-500 text-sm ml-2">
                                    ({pizza.total_reviews} reviews)
                                </span>
                            </div>
                        </div>
                    </Link>
                ))}
            </div>
        </MainLayout>
    );
} 
import React from 'react';
import MainLayout from '@/Layouts/MainLayout';
import type { Brand, Pizza } from '@/types/models';
import type { PageProps } from '@/types/props';
import { Link } from '@inertiajs/react';

interface BrandShowProps extends PageProps {
    brand: Brand & {
        pizzas: Pizza[];
    };
}

export default function BrandShow({ brand, meta, auth }: BrandShowProps) {
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
                            Visit Website
                        </a>
                    )}
                </div>
            </div>

            <h2 className="text-2xl font-bold mb-4">Pizzas by {brand.name}</h2>
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {brand.pizzas.map((pizza) => (
                    <Link 
                        key={pizza.id}
                        href={`/pizzas/${pizza.slug}`}
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
                            <p className="text-sm text-gray-500 mb-4">{pizza.style.name}</p>
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
import React from 'react';
import MainLayout from '@/Layouts/MainLayout';
import { Link } from '@inertiajs/react';
import { PizzaIcon, ExternalLinkIcon } from '@/Components/Icons';
export default function BrandsIndex({ brands, meta, auth }) {
    console.log(brands);
    return (
        <MainLayout meta={meta} auth={auth}>
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {brands.map((brand) => (
                    <div 
                        key={brand.id}
                        className="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow"
                    >
                        <div className="p-6">
                            <img 
                                src={`/${brand.image.path}/${brand.image.name}`} 
                                alt={brand.name} 
                                className="w-full h-48 object-cover mb-4"
                            />
                            <h2 className="text-xl font-bold mb-2">{brand.name}</h2>
                            <p className="text-gray-600 mb-4">
                                {brand.description.length > 150
                                    ? `${brand.description.substring(0, 150)}...`
                                    : brand.description}
                            </p>
                            <Link 
                                href={`/brands/${brand.slug}`}
                                className="text-blue-600 hover:underline mt-2 block flex items-center"
                            >
                                <PizzaIcon className="mr-2 w-6 h-6" />
                                View Pizzas From {brand.name}
                            </Link>
                            {brand.website && (
                                <a 
                                    href={brand.website}
                                    target="_blank"
                                    className="text-blue-600 hover:underline flex items-center"
                                >
                                    <ExternalLinkIcon className="mr-2 w-6 h-6" />
                                    {brand.website}
                                </a>
                            )}
                        </div>
                    </div>
                ))}
            </div>
        </MainLayout>
    );
} 
import React from 'react';
import MainLayout from '@/Layouts/MainLayout';
import type { Brand } from '@/types/models';
import type { PageProps } from '@/types/props';
import { Link } from '@inertiajs/react';

interface BrandsIndexProps extends PageProps {
    brands: Brand[];
}

export default function BrandsIndex({ brands, meta, auth }: BrandsIndexProps) {
    return (
        <MainLayout meta={meta} auth={auth}>
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {brands.map((brand) => (
                    <Link 
                        key={brand.id} 
                        href={`/brands/${brand.slug}`}
                        className="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow"
                    >
                        <div className="p-6">
                            <h2 className="text-xl font-bold mb-2">{brand.name}</h2>
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
                    </Link>
                ))}
            </div>
        </MainLayout>
    );
} 
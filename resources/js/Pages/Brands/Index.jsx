import React from 'react';
import MainLayout from '@/Layouts/MainLayout';
import BreadcrumbSchema from '@/Components/SEO/BreadcrumbSchema';
import BrandListItem from '@/Components/Common/BrandListItem';

export default function BrandsIndex({ brands, meta, auth }) {
    return (
        <MainLayout meta={meta} auth={auth}>
            <BreadcrumbSchema
                items={[
                    { name: 'Home', url: '/' },
                    { name: 'Frozen Pizza Brands', url: '/brands' }
                ]}
            />

            <div className="max-w-7xl mx-auto">
                <h1 className="text-4xl font-bold mb-6">The Worlds Frozen Pizza Brands</h1>
                <div className="prose max-w-none mb-8">
                    <p className="text-lg">
                        Discover the best frozen pizza brands, from artisanal wood-fired pizzas to classic favorites.
                        We provide detailed reviews, nutritional information, and honest feedback from real pizza lovers.
                    </p>
                </div>

                {/* All Other Brands Section */}
                <div>
                    <h2 className="text-2xl font-semibold mb-6">All Brands</h2>
                    <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
                        {brands.map((brand) => (
                            <BrandListItem
                                key={brand.id}
                                brand={brand}
                            />
                        ))}
                    </div>
                </div>
            </div>
        </MainLayout>
    );
} 
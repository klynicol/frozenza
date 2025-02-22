import React from 'react';
import MainLayout from '@/Layouts/MainLayout';
import PizzaListItem from '@/Components/Common/PizzaListItem';
import { getImageUrl } from '@/utils/image';
import SchemaMarkup from '@/Components/SEO/SchemaMarkup';
import BreadcrumbSchema from '@/Components/SEO/BreadcrumbSchema';
import { ExternalLinkIcon } from '@/Components/Icons';

export default function BrandShow({ brand, meta, auth }) {
    console.log(brand);
    return (
        <MainLayout meta={meta} auth={auth}>
            <SchemaMarkup 
                type="Brand"
                data={brand}
            />
            <BreadcrumbSchema
                items={[
                    { name: 'Home', url: '/' },
                    { name: 'Brands', url: '/brands' },
                    { name: brand.name, url: `/brands/${brand.slug}` }
                ]}
            />
            
            <div className="bg-white shadow-lg rounded-lg overflow-hidden mb-8">
                <div className="p-6">
                    <div className="flex flex-col sm:flex-row items-center sm:items-start gap-6">
                        {brand?.image && (
                            <div className="flex-shrink-0">
                                <img
                                    title={brand.name + ' logo'}
                                    src={getImageUrl(brand.image)} 
                                    alt={`${brand.name} logo`}
                                    className="w-32 h-32 object-contain"
                                    width={brand.image.width}
                                    height={brand.image.height}
                                    loading="lazy"
                                />
                            </div>
                        )}
                        <div className="text-center sm:text-left flex-1">
                            <h1 className="text-3xl font-bold mb-2">{`${brand.name} - Frozen Pizza`}</h1>
                            <div className="prose prose-sm sm:prose lg:prose-lg max-w-none">
                                <div className="text-gray-600 mb-4 whitespace-pre-wrap">
                                    {brand.description}
                                </div>
                                
                                {brand.brand_story && (
                                    <>
                                        <h2 className="text-xl font-semibold mt-4 mb-2">About {brand.name}</h2>
                                        <div className="text-gray-600 whitespace-pre-wrap">
                                            {brand.brand_story}
                                        </div>
                                    </>
                                )}
                            </div>
                            {brand.website && (
                                <a
                                    href={brand.website}
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    className="text-blue-600 hover:underline inline-flex items-center gap-1"
                                >
                                    <span>{brand.website}</span>
                                    <ExternalLinkIcon className="w-4 h-4" />
                                </a>
                            )}
                        </div>
                    </div>
                </div>
            </div>

            <div className="flex items-center justify-between mb-6">
                <h2 className="text-2xl font-bold">
                    {brand.name} Frozen Pizza Selection ({brand.pizzas.length} Varieties)
                </h2>
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

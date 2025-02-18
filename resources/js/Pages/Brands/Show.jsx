import React from 'react';
import MainLayout from '@/Layouts/MainLayout';
import { Link } from '@inertiajs/react';
import PizzaListItem from '@/Components/Common/PizzaListItem';
import { getImageUrl } from '@/utils/image';
import SchemaMarkup from '@/Components/SEO/SchemaMarkup';
import BreadcrumbSchema from '@/Components/SEO/BreadcrumbSchema';
import FAQSchema from '@/Components/SEO/FAQSchema';
import OrganizationSchema from '@/Components/SEO/OrganizationSchema';

export default function BrandShow({ brand, meta, auth }) {
    // Enhanced meta using brand's SEO fields
    const enhancedMeta = {
        ...meta,
        title: brand.seo_title || `${brand.name} Frozen Pizzas | Reviews & Ratings`,
        description: brand.seo_description || `Discover ${brand.name}'s frozen pizza selection. Read reviews, nutritional information, and find your favorite varieties.`,
        canonicalUrl: `/brands/${brand.slug}`,
        imageUrl: brand?.image ? getImageUrl(brand.image) : null,
        keywords: brand.seo_keywords || []
    };

    return (
        <MainLayout meta={enhancedMeta} auth={auth}>
            <SchemaMarkup 
                type="Brand"
                data={brand.schema_markup}
            />
            <BreadcrumbSchema
                items={[
                    { name: 'Home', url: '/' },
                    { name: 'Brands', url: '/brands' },
                    { name: brand.name, url: `/brands/${brand.slug}` }
                ]}
            />
            {brand.seo_faq_questions && (
                <FAQSchema questions={brand.seo_faq_questions} />
            )}
            {brand.social_media_handles && (
                <OrganizationSchema
                    name={brand.name}
                    url={brand.website}
                    logo={brand?.image ? getImageUrl(brand.image) : null}
                    description={brand.seo_description || brand.description}
                    socialMediaHandles={brand.social_media_handles}
                />
            )}
            
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
                            <div className="prose max-w-none">
                                <div className="text-gray-600 mb-4" 
                                     dangerouslySetInnerHTML={{ __html: brand.seo_about_content || brand.description }} 
                                />
                                
                                {brand.brand_story && (
                                    <>
                                        <h2 className="text-xl font-semibold mt-4 mb-2">About {brand.name}</h2>
                                        <div className="text-gray-600"
                                             dangerouslySetInnerHTML={{ __html: brand.brand_story }}
                                        />
                                    </>
                                )}

                                {brand.unique_selling_points && (
                                    <>
                                        <h2 className="text-xl font-semibold mt-4 mb-2">What Makes {brand.name} Special</h2>
                                        <div className="text-gray-600"
                                             dangerouslySetInnerHTML={{ __html: brand.unique_selling_points }}
                                        />
                                    </>
                                )}

                                {brand.cooking_instructions && (
                                    <>
                                        <h2 className="text-xl font-semibold mt-4 mb-2">Cooking Instructions</h2>
                                        <div className="text-gray-600"
                                             dangerouslySetInnerHTML={{ __html: brand.cooking_instructions }}
                                        />
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
                                    <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>
                            )}
                            
                            {brand.social_media_handles && Object.keys(brand.social_media_handles).length > 0 && (
                                <div className="mt-4 flex gap-4">
                                    {Object.entries(brand.social_media_handles).map(([platform, url]) => (
                                        <a
                                            key={platform}
                                            href={url}
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            className="text-gray-600 hover:text-gray-900"
                                        >
                                            {platform}
                                        </a>
                                    ))}
                                </div>
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
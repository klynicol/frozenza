import React from 'react';
import MainLayout from '@/Layouts/MainLayout';
import { Link } from '@inertiajs/react';
import { PizzaIcon, ExternalLinkIcon } from '@/Components/Icons';
import SchemaMarkup from '@/Components/SEO/SchemaMarkup';
import BreadcrumbSchema from '@/Components/SEO/BreadcrumbSchema';
import FAQSchema from '@/Components/SEO/FAQSchema';
import OrganizationSchema from '@/Components/SEO/OrganizationSchema';

export default function BrandsIndex({ brands, meta, auth }) {
    // Find featured brands (like American Flatbread) that have rich SEO content
    const featuredBrands = brands.filter(brand => brand.seo_about_content || brand.brand_story);
    const regularBrands = brands.filter(brand => !brand.seo_about_content && !brand.brand_story);

    // Generate aggregated FAQ from all brands with FAQ content
    const allFAQs = brands
        .filter(brand => brand.seo_faq_questions)
        .flatMap(brand => brand.seo_faq_questions)
        .slice(0, 10); // Limit to top 10 FAQs

    return (
        <MainLayout meta={meta} auth={auth}>
            {/* Schema Markup for Organization List */}
            <SchemaMarkup 
                type="ItemList"
                data={{
                    itemListElement: brands.map((brand, index) => ({
                        '@type': 'ListItem',
                        'position': index + 1,
                        'item': {
                            '@type': 'Brand',
                            'name': brand.name,
                            'description': brand.seo_description || brand.description,
                            'url': `/brands/${brand.slug}`,
                            'image': brand?.image ? `/${brand.image.path}/${brand.image.name}` : null
                        }
                    }))
                }}
            />
            <BreadcrumbSchema
                items={[
                    { name: 'Home', url: '/' },
                    { name: 'Frozen Pizza Brands', url: '/brands' }
                ]}
            />
            {allFAQs.length > 0 && (
                <FAQSchema questions={allFAQs} />
            )}
            
            <div className="max-w-7xl mx-auto">
                <h1 className="text-4xl font-bold mb-6">Frozen Pizza Brands</h1>
                <div className="prose max-w-none mb-8">
                    <p className="text-lg">
                        Discover the best frozen pizza brands, from artisanal wood-fired pizzas to classic favorites. 
                        We provide detailed reviews, nutritional information, and honest feedback from real pizza lovers.
                    </p>
                </div>

                {/* Featured Brands Section */}
                {featuredBrands.length > 0 && (
                    <div className="mb-12">
                        <h2 className="text-2xl font-semibold mb-6">Featured Brands</h2>
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                            {featuredBrands.map((brand) => (
                                <div 
                                    key={brand.id}
                                    className="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow"
                                >
                                    <div className="p-6">
                                        <div className="flex items-start gap-4">
                                            {brand?.image && (
                                                <img 
                                                    src={`/${brand.image.path}/${brand.image.name}`} 
                                                    alt={brand.name} 
                                                    className="w-64 h-64 object-contain flex-shrink-0"
                                                />
                                            )}
                                            <div>
                                                <h3 className="text-xl font-bold mb-2">{brand.name}</h3>
                                                <p className="text-gray-600 mb-4">
                                                    {(brand.seo_about_content || brand.description).substring(0, 200)}...
                                                </p>
                                                {brand.unique_selling_points && (
                                                    <div className="mb-4">
                                                        <h4 className="font-semibold mb-2">What Makes Them Special:</h4>
                                                        <div className="text-sm text-gray-600" 
                                                             dangerouslySetInnerHTML={{ 
                                                                 __html: brand.unique_selling_points.split('\n').slice(0, 3).join('<br>') 
                                                             }} 
                                                        />
                                                    </div>
                                                )}
                                                <div className="flex flex-wrap gap-2">
                                                    <Link 
                                                        href={`/brands/${brand.slug}`}
                                                        className="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors"
                                                    >
                                                        <PizzaIcon className="mr-2 w-5 h-5" />
                                                        View {brand.pizzas_count} Pizzas
                                                    </Link>
                                                    {brand.website && (
                                                        <a 
                                                            href={brand.website}
                                                            target="_blank"
                                                            rel="noopener noreferrer"
                                                            className="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors"
                                                        >
                                                            <ExternalLinkIcon className="mr-2 w-5 h-5" />
                                                            Website
                                                        </a>
                                                    )}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                )}

                {/* All Other Brands Section */}
                <div>
                    <h2 className="text-2xl font-semibold mb-6">All Brands</h2>
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {regularBrands.map((brand) => (
                            <div 
                                key={brand.id}
                                className="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow"
                            >
                                <div className="p-6">
                                    {brand?.image && (
                                        <img 
                                            src={`/${brand.image.path}/${brand.image.name}`} 
                                            alt={brand.name} 
                                            className="w-full h-48 object-contain mb-4"
                                        />
                                    )}
                                    <h3 className="text-xl font-bold mb-2">{brand.name}</h3>
                                    <p className="text-gray-600 mb-4">
                                        {brand.description.length > 150
                                            ? `${brand.description.substring(0, 150)}...`
                                            : brand.description}
                                    </p>
                                    <div className="flex flex-wrap gap-2">
                                        <Link 
                                            href={`/brands/${brand.slug}`}
                                            className="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors"
                                        >
                                            <PizzaIcon className="mr-2 w-5 h-5" />
                                            View {brand.pizzas_count} Pizzas
                                        </Link>
                                        {brand.website && (
                                            <a 
                                                href={brand.website}
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                className="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors"
                                            >
                                                <ExternalLinkIcon className="mr-2 w-5 h-5" />
                                                Website
                                            </a>
                                        )}
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </MainLayout>
    );
} 
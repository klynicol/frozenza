import React from 'react';
import { Head } from '@inertiajs/react';
import type { Pizza, Brand, Review } from '@/types/models';

interface SchemaMarkupProps {
    type: 'Pizza' | 'Review' | 'Brand';
    data: Pizza | Brand | Review;
}

export default function SchemaMarkup({ type, data }: SchemaMarkupProps) {
    const generatePizzaSchema = (pizza: Pizza) => ({
        '@context': 'https://schema.org',
        '@type': 'Product',
        name: pizza.name,
        description: pizza.description,
        image: pizza.image_url,
        brand: {
            '@type': 'Brand',
            name: pizza.brand.name,
        },
        aggregateRating: pizza.total_reviews > 0 ? {
            '@type': 'AggregateRating',
            ratingValue: pizza.average_rating,
            reviewCount: pizza.total_reviews,
        } : undefined,
        nutrition: {
            '@type': 'NutritionInformation',
            calories: `${pizza.nutritional_info.calories} calories`,
            proteinContent: `${pizza.nutritional_info.protein}g`,
            carbohydrateContent: `${pizza.nutritional_info.carbs}g`,
            fatContent: `${pizza.nutritional_info.fat}g`,
        },
    });

    const generateBrandSchema = (brand: Brand) => ({
        '@context': 'https://schema.org',
        '@type': 'Brand',
        name: brand.name,
        description: brand.description,
        url: brand.website,
    });

    const generateReviewSchema = (review: Review) => ({
        '@context': 'https://schema.org',
        '@type': 'Review',
        reviewRating: {
            '@type': 'Rating',
            ratingValue: review.rating,
        },
        author: {
            '@type': 'Person',
            name: review.user.name,
        },
        datePublished: review.created_at,
        reviewBody: review.review,
    });

    const schemaGenerators = {
        Pizza: generatePizzaSchema,
        Brand: generateBrandSchema,
        Review: generateReviewSchema,
    };

    const generator = schemaGenerators[type];
    if (!generator) {
        console.error(`Unknown schema type: ${type}`);
        return null;
    }

    return (
        <Head>
            <script 
                type="application/ld+json"
                dangerouslySetInnerHTML={{
                    __html: JSON.stringify(generator(data as any))
                }}
            />
        </Head>
    );
} 
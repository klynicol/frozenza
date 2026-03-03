import React from 'react';
import { Head } from '@inertiajs/react';
import { getImageUrl } from '@/utils/image';

export default function SchemaMarkup({ type, data }) {
    const generatePizzaSchema = (pizza) => {
        const productUrl =
            typeof window !== 'undefined' && pizza.brand?.slug && pizza.slug
                ? `${window.location.origin}/pizzas/${pizza.brand.slug}/${pizza.slug}`
                : undefined;
        return {
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
            offers: {
                '@type': 'Offer',
                availability: 'https://schema.org/InStock',
                ...(productUrl && { url: productUrl }),
            },
            nutrition: pizza?.nutrition_fact ? {
            '@type': 'NutritionInformation',
            calories: pizza.nutrition_fact.calories != null ? `${pizza.nutrition_fact.calories} calories` : undefined,
            proteinContent: pizza.nutrition_fact.protein ?? undefined,
            carbohydrateContent: pizza.nutrition_fact.total_carbohydrate ?? undefined,
            fatContent: pizza.nutrition_fact.total_fat ?? undefined,
            saturatedFatContent: pizza.nutrition_fact.saturated_fat ?? undefined,
            transFatContent: pizza.nutrition_fact.trans_fat ?? undefined,
            cholesterolContent: pizza.nutrition_fact.cholesterol ?? undefined,
            sodiumContent: pizza.nutrition_fact.sodium ?? undefined,
            dietaryFiberContent: pizza.nutrition_fact.dietary_fiber ?? undefined,
            sugarContent: pizza.nutrition_fact.total_sugars ?? undefined,
            addedSugarContent: pizza.nutrition_fact.added_sugars ?? undefined,
            vitaminDContent: pizza.nutrition_fact.vitamin_d ?? undefined,
            calciumContent: pizza.nutrition_fact.calcium ?? undefined,
            ironContent: pizza.nutrition_fact.iron ?? undefined,
            potassiumContent: pizza.nutrition_fact.potassium ?? undefined,
            monounsaturatedFatContent: pizza.nutrition_fact.monounsaturated_fat ?? undefined,
            polyunsaturatedFatContent: pizza.nutrition_fact.polyunsaturated_fat ?? undefined,
            vitaminAContent: pizza.nutrition_fact.vitamin_a ?? undefined,
            vitaminCContent: pizza.nutrition_fact.vitamin_c ?? undefined,
        } : undefined,
        };
    };

    const generateBrandSchema = (brand) => ({
        '@context': 'https://schema.org',
        '@type': 'Brand',
        name: brand.name,
        description: brand.description,
        url: brand.website,
        image: brand?.image ? getImageUrl(brand.image) : undefined,
    });

    const generateReviewSchema = (review) => ({
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
        itemReviewed: {
            '@type': 'Product',
            name: review.pizza.name,
        },
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
                    __html: JSON.stringify(generator(data))
                }}
            />
        </Head>
    );
}

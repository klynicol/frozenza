import React from 'react';
import { Head } from '@inertiajs/react';
import { getImageUrl } from '@/utils/image';

export default function SchemaMarkup({ type, data }) {
    const generatePizzaSchema = (pizza) => ({
        '@context': 'https://schema.org',
        '@type': 'Product',
        name: pizza.name,
        description: pizza.description,
        image: pizza.image_url,
        brand: {
            '@type': 'Brand',
            name: pizza.brand.name,
        },
        style: {
            '@type': 'ProductModel',
            name: pizza?.style?.name || undefined,
        },
        aggregateRating: pizza.total_reviews > 0 ? {
            '@type': 'AggregateRating',
            ratingValue: pizza.average_rating,
            reviewCount: pizza.total_reviews,
        } : undefined,
        nutrition: pizza?.nutrition_fact ? {
            '@type': 'NutritionInformation',
            calories: `${pizza.nutrition_fact.calories} calories`,
            proteinContent: pizza.nutrition_fact.protein,
            carbohydrateContent: pizza.nutrition_fact.total_carbohydrate,
            fatContent: pizza.nutrition_fact.total_fat,
            saturatedFatContent: pizza.nutrition_fact.saturated_fat,
            transFatContent: pizza.nutrition_fact.trans_fat,
            cholesterolContent: pizza.nutrition_fact.cholesterol,
            sodiumContent: pizza.nutrition_fact.sodium,
            dietaryFiberContent: pizza.nutrition_fact.dietary_fiber,
            sugarContent: pizza.nutrition_fact.total_sugars,
            addedSugarContent: pizza.nutrition_fact.added_sugars,
            vitaminDContent: pizza.nutrition_fact.vitamin_d,
            calciumContent: pizza.nutrition_fact.calcium,
            ironContent: pizza.nutrition_fact.iron,
            potassiumContent: pizza.nutrition_fact.potassium,
            monounsaturatedFatContent: pizza.nutrition_fact.monounsaturated_fat || undefined,
            polyunsaturatedFatContent: pizza.nutrition_fact.polyunsaturated_fat || undefined,
            vitaminAContent: pizza.nutrition_fact.vitamin_a || undefined,
            vitaminCContent: pizza.nutrition_fact.vitamin_c || undefined,
        } : undefined,
    });

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

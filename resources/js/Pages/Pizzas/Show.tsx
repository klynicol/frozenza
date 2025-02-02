import React from 'react';
import MainLayout from '@/Layouts/MainLayout';
import type { Pizza } from '@/types/models';
import type { PageProps } from '@/types/props';
import ReviewList from '@/Components/Reviews/ReviewList';
import ReviewForm from '@/Components/Reviews/ReviewForm';
import SchemaMarkup from '@/Components/SEO/SchemaMarkup';

interface PizzaShowProps extends PageProps {
    pizza: Pizza;
}

export default function PizzaShow({ pizza, meta, auth }: PizzaShowProps) {
    return (
        <MainLayout meta={meta} auth={auth}>
            <SchemaMarkup type="Pizza" data={pizza} />
            <div className="bg-white shadow-lg rounded-lg overflow-hidden">
                <div className="md:flex">
                    {pizza.image_url && (
                        <div className="md:flex-shrink-0">
                            <img
                                className="h-48 w-full object-cover md:w-48"
                                src={pizza.image_url}
                                alt={pizza.name}
                            />
                        </div>
                    )}
                    <div className="p-8">
                        <h1 className="text-2xl font-bold text-gray-900 mb-2">
                            {pizza.name}
                        </h1>
                        <div className="text-sm text-gray-600 mb-4">
                            <span>By {pizza.brand.name}</span>
                            <span className="mx-2">•</span>
                            <span>{pizza.style.name}</span>
                        </div>
                        <p className="text-gray-700 mb-6">{pizza.description}</p>
                        
                        <div className="mb-6">
                            <h2 className="text-lg font-semibold mb-2">Ingredients</h2>
                            <div className="flex flex-wrap gap-2">
                                {pizza.ingredients.map((ingredient, index) => (
                                    <span
                                        key={index}
                                        className="px-3 py-1 bg-gray-100 rounded-full text-sm"
                                    >
                                        {ingredient}
                                    </span>
                                ))}
                            </div>
                        </div>

                        <div className="mb-6">
                            <h2 className="text-lg font-semibold mb-2">Nutritional Info</h2>
                            <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div>
                                    <span className="block text-gray-500">Calories</span>
                                    <span className="text-lg">{pizza.nutritional_info.calories}</span>
                                </div>
                                <div>
                                    <span className="block text-gray-500">Protein</span>
                                    <span className="text-lg">{pizza.nutritional_info.protein}g</span>
                                </div>
                                <div>
                                    <span className="block text-gray-500">Carbs</span>
                                    <span className="text-lg">{pizza.nutritional_info.carbs}g</span>
                                </div>
                                <div>
                                    <span className="block text-gray-500">Fat</span>
                                    <span className="text-lg">{pizza.nutritional_info.fat}g</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {auth.user && (
                <div className="mt-8">
                    <ReviewForm pizzaId={pizza.id} />
                </div>
            )}
            
            {pizza.reviews && pizza.reviews.length > 0 && (
                <ReviewList reviews={pizza.reviews} />
            )}
        </MainLayout>
    );
} 
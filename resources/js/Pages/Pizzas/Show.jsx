import React, { useState } from 'react';
import MainLayout from '@/Layouts/MainLayout';
import ReviewList from '@/Components/Reviews/ReviewList';
import ReviewForm from '@/Components/Reviews/ReviewForm';
import SchemaMarkup from '@/Components/SEO/SchemaMarkup';
import NutritionFact from '@/Components/Common/NutritionFact';
import { Link } from '@inertiajs/react';
import { PlusIcon, MinusIcon } from '@/Components/Icons';

export default function PizzaShow({ pizza, meta, auth }) {
    const [isIngredientsOpen, setIngredientsOpen] = useState(false);
    const [isNutritionOpen, setNutritionOpen] = useState(false);

    const toggleAccordion = (setOpen) => {
        setOpen(prevState => !prevState);
    };

    console.log(pizza);
    return (
        <MainLayout meta={meta} auth={auth}>
            <SchemaMarkup type="Pizza" data={pizza} />
            <div className="bg-white shadow-lg rounded-lg overflow-hidden">
                <div className="md:flex">
                    {pizza.image && (
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
                            <span><Link href={route('brands.show', pizza.brand.slug)}>By {pizza.brand.name}</Link></span>
                            <span className="mx-2">•</span>
                            {pizza?.style &&
                                <span><Link href={route('styles.show', pizza?.style?.slug)}>{pizza?.style?.name}</Link></span>
                            }
                        </div>
                        <p className="text-gray-700 mb-6">{pizza?.description}</p>


                    </div>
                    <div className="p-8">
                        <div className="mb-6 transition hover:bg-indigo-50">
                            <div
                                className="accordion-header cursor-pointer transition flex space-x-5 px-5 items-center h-16"
                                onClick={() => toggleAccordion(setIngredientsOpen)}
                            >
                                {isIngredientsOpen ? <MinusIcon /> : <PlusIcon />}
                                <h2 className="text-lg font-semibold">Ingredients</h2>
                            </div>
                            <div
                                className="accordion-content px-5 pt-0 overflow-hidden"
                                style={{ maxHeight: isIngredientsOpen ? '1000px' : '0px' }}
                            >
                                <div className="flex flex-wrap gap-2">
                                    {pizza.ingredients}
                                </div>
                            </div>
                        </div>

                        <div className="mb-6 transition hover:bg-indigo-50">
                            <div
                                className="accordion-header cursor-pointer transition flex space-x-5 px-5 items-center h-16"
                                onClick={() => toggleAccordion(setNutritionOpen)}
                            >
                                {isNutritionOpen ? <MinusIcon /> : <PlusIcon />}
                                <h2 className="text-lg font-semibold">Nutritional Info</h2>
                            </div>
                            <div
                                className="accordion-content px-5 pt-0 overflow-hidden"
                                style={{ maxHeight: isNutritionOpen ? '1000px' : '0px' }}
                            >
                                <NutritionFact nutritionFact={pizza.nutrition_fact} />
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
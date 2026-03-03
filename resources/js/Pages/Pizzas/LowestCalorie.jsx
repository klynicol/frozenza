import React from 'react';
import MainLayout from '@/Layouts/MainLayout';
import { Link } from '@inertiajs/react';
import NutritionFact from '@/Components/Common/NutritionFact';
import { getImageUrl } from '@/utils/image';

export default function LowestCalorie({ pizzas, meta, auth }) {
    return (
        <MainLayout meta={meta} auth={auth}>
            <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <article>
                    <h1 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        Lowest Calorie Frozen Pizza – Our Top Picks
                    </h1>
                    <p className="text-lg text-gray-600 mb-6">
                        If you’re searching for the <strong>lowest calorie frozen pizza</strong>, you’re in the right place.
                        We used our nutrition facts database to rank frozen pizzas by calories per serving.
                        Here are the top low-calorie frozen pizzas you can buy right now.
                    </p>
                    <p className="text-gray-600 mb-8">
                        Each pick below includes full nutrition facts so you can compare serving size, calories, and other key nutrients.
                    </p>

                    {!pizzas || pizzas.length === 0 ? (
                        <p className="text-gray-600">We’re still adding nutrition data. Check back soon for our lowest-calorie frozen pizza picks.</p>
                    ) : (
                        <ol className="space-y-10 list-none pl-0">
                            {pizzas.map((pizza, index) => (
                                <li key={pizza.id} className="border-b border-gray-200 pb-10 last:border-0">
                                    <div className="flex flex-col md:flex-row gap-6">
                                        <div className="md:w-1/3 flex-shrink-0">
                                            <Link href={`/pizzas/${pizza.brand?.slug}/${pizza.slug}`} className="block">
                                                <img
                                                    src={(() => {
                                                        const main = pizza?.images?.find((i) => i?.pivot?.type === 'main');
                                                        return main ? getImageUrl(main) : '/storage/assets/pizza_placeholder.png';
                                                    })()}
                                                    alt={pizza.name}
                                                    className="w-full aspect-square object-cover rounded-lg"
                                                />
                                            </Link>
                                        </div>
                                        <div className="md:flex-1">
                                            <span className="text-sm font-semibold text-indigo-600">
                                                #{index + 1} – {pizza.nutrition_fact?.calories ?? '—'} cal per serving
                                            </span>
                                            <h2 className="text-xl font-bold mt-1">
                                                <Link
                                                    href={`/pizzas/${pizza.brand?.slug}/${pizza.slug}`}
                                                    className="text-gray-900 hover:text-indigo-600"
                                                >
                                                    {pizza.name}
                                                </Link>
                                            </h2>
                                            {pizza.brand && (
                                                <p className="text-gray-600 mb-4">
                                                    <Link href={`/brands/${pizza.brand.slug}`} className="hover:underline">
                                                        {pizza.brand.name}
                                                    </Link>
                                                </p>
                                            )}
                                            <div className="flex flex-wrap gap-4">
                                                <Link
                                                    href={`/pizzas/${pizza.brand?.slug}/${pizza.slug}`}
                                                    className="text-indigo-600 font-medium hover:underline"
                                                >
                                                    View full review & nutrition →
                                                </Link>
                                            </div>
                                            {pizza.nutrition_fact && (
                                                <div className="mt-6">
                                                    <NutritionFact nutritionFact={pizza.nutrition_fact} />
                                                </div>
                                            )}
                                        </div>
                                    </div>
                                </li>
                            ))}
                        </ol>
                    )}

                    <div className="mt-12 pt-8 border-t border-gray-200">
                        <h2 className="text-xl font-bold text-gray-900 mb-2">How we picked the lowest calorie frozen pizzas</h2>
                        <p className="text-gray-600">
                            We ranked frozen pizzas that have nutrition facts in our database by <strong>calories per serving</strong>.
                            Serving size varies by product (e.g. 1/3 pizza or 1/4 pizza), so we use each brand’s stated serving to compare fairly.
                            For more options, browse our full <Link href="/pizzas" className="text-indigo-600 hover:underline">frozen pizza list</Link> and filter by brands that share nutrition info.
                        </p>
                    </div>
                </article>
            </div>
        </MainLayout>
    );
}

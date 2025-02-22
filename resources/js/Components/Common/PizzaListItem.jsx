import { Link } from '@inertiajs/react';
import { getImageUrl } from '@/utils/image';
import SchemaMarkup from '@/Components/SEO/SchemaMarkup';

export default function PizzaListItem({ pizza }) {

    const mainImage = pizza?.images?.find(image => image.pivot.type === 'main') ?? null;

    return (
        <>
            <SchemaMarkup type="Pizza" data={pizza} />
            <Link href={route('pizzas.show', { brand: pizza.brand.slug, pizza: pizza.slug })} className="block">
                <div className="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <div className="relative aspect-square">
                        <img
                            src={mainImage ? getImageUrl(mainImage) : '/storage/assets/pizza_placeholder.png'}
                            alt={pizza.name}
                            className="w-full h-full object-cover p-3"
                        />
                    </div>
                    <div className="p-4">
                        <h3 className="font-semibold text-lg mb-2">{pizza.name}</h3>
                        <div className="flex items-center justify-end mb-2">
                            <div className="flex items-center">
                                <span className="text-yellow-400">★</span>
                                <span className="ml-1">{pizza.average_rating || 'No reviews'}</span>
                            </div>
                        </div>
                        {pizza.tags && pizza.tags.length > 0 && (
                            <div className="flex flex-wrap gap-2 mt-2">
                                {pizza.tags.map((tag, index) => (
                                    <span
                                        key={index}
                                        className="px-2 py-1 bg-gray-100 text-sm rounded-full text-gray-600"
                                    >
                                        {tag.slug}
                                    </span>
                                ))}
                            </div>
                        )}
                    </div>
                </div>
            </Link>
        </>
    );
}

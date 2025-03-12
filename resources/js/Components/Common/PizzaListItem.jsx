import { Link } from '@inertiajs/react';
import { getImageUrl } from '@/utils/image';
import SchemaMarkup from '@/Components/SEO/SchemaMarkup';

export default function PizzaListItem({ pizza }) {
    const mainImage = pizza?.images?.find(image => image.pivot.type === 'main') ?? null;
    const brandLogo = pizza?.brand?.image ? getImageUrl(pizza.brand.image) : '/storage/assets/brand_placeholder.png';
    const pizzaUrl = `/pizzas/${pizza.brand.slug}/${pizza.slug}`

    return (
        <>
            <SchemaMarkup type="Pizza" data={pizza} />
            <Link href={pizzaUrl} className="block h-full">
                <div className="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow h-full flex flex-col">
                    <div className="relative aspect-square">
                        <img
                            src={mainImage ? getImageUrl(mainImage) : '/storage/assets/pizza_placeholder.png'}
                            alt={pizza.name}
                            title={pizza.name}
                            className="w-full h-full object-cover p-3"
                            width={mainImage?.width}
                            height={mainImage?.height}
                            loading="lazy"
                        />
                    </div>
                    <div className="p-4 flex-grow flex flex-col">
                        <div className="flex items-center gap-3 mb-2">
                            <img
                                src={brandLogo}
                                alt={`${pizza.brand.name} logo`}
                                className="w-16 h-16 rounded-full object-contain bg-gray-50"
                                loading="lazy"
                            />
                            <div>
                                <h3 className="font-semibold text-lg leading-tight">{pizza.name}</h3>
                                <p className="text-gray-600 text-sm">{pizza.brand.name}</p>
                            </div>
                        </div>
                        <div className="flex items-center justify-end mb-2">
                            <div className="flex items-center">
                                <span className="text-yellow-400">★</span>
                                <span className="ml-1">{pizza.average_rating || 'No reviews'}</span>
                            </div>
                        </div>
                        {pizza.tags && pizza.tags.length > 0 && (
                            <div className="flex flex-wrap gap-2 mt-auto pt-2">
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

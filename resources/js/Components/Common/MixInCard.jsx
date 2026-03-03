import { Link } from '@inertiajs/react';

/**
 * A card for mixed-in content (e.g. promos, guides) in pizza grids.
 * Matches the approximate height and style of PizzaListItem for a consistent grid.
 */
export default function MixInCard({ href, title, description, ctaText = 'Learn more', className = '' }) {
    return (
        <Link href={href} className={`block h-full ${className}`}>
            <div className="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow h-full flex flex-col border border-gray-100">
                <div className="relative aspect-square bg-gradient-to-br from-indigo-50 to-purple-50 flex items-center justify-center p-6">
                    <span className="text-5xl" aria-hidden>🍕</span>
                </div>
                <div className="p-4 flex-grow flex flex-col">
                    <h3 className="font-semibold text-lg leading-tight text-gray-900 mb-2">{title}</h3>
                    {description && (
                        <p className="text-gray-600 text-sm flex-grow line-clamp-3">{description}</p>
                    )}
                    <span className="mt-3 inline-flex items-center text-indigo-600 font-medium text-sm hover:underline">
                        {ctaText}
                        <span className="ml-1">→</span>
                    </span>
                </div>
            </div>
        </Link>
    );
}

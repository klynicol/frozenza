import { getImageUrl } from '@/utils/image';
import SchemaMarkup from '@/Components/SEO/SchemaMarkup';
import { Link } from '@inertiajs/react';
import { PizzaIcon, ExternalLinkIcon } from '@/Components/Icons';


export default function BrandListItem({ brand }) {
   return (
      <>
         <SchemaMarkup type="Brand" data={brand} />
         <div
            className="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow"
         >
            <div className="p-6">
               {brand?.image && (
                  <img
                     src={getImageUrl(brand.image)}
                     alt={brand.name}
                     title={brand.name}
                     className="w-full h-48 object-contain mb-4"
                     width={brand.image.width}
                     height={brand.image.height}
                     loading="lazy"
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
                     href={`/brands/${brand.slug}/pizzas`}
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
      </>
   )
}
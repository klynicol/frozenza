import { getImageUrl } from '@/utils/image';
import SchemaMarkup from '@/Components/SEO/SchemaMarkup';
import { Link } from '@inertiajs/react';
import { PizzaIcon } from '@/Components/Icons';

export default function BrandListItem({ brand }) {
   return (
      <>
         <SchemaMarkup type="Brand" data={brand} />
         <Link
            href={`/brands/${brand.slug}/pizzas`}
            className="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-all hover:translate-y-[-2px] h-full"
         >
            <div className="p-4 flex flex-col items-center justify-between h-full">
               {brand?.image && (
                  <img
                     src={getImageUrl(brand.image)}
                     alt={brand.name}
                     title={brand.name}
                     className="w-full h-32 object-contain mb-4"
                     width={brand.image.width}
                     height={brand.image.height}
                     loading="lazy"
                  />
               )}
               <div className="flex items-center justify-center mt-auto bg-gradient-to-r from-red-500 to-orange-500 text-white py-2 px-4 rounded-full shadow-sm">
                  <PizzaIcon className="w-5 h-5 text-white mr-2" />
                  <span className="font-semibold">{brand.pizzas_count} Pizzas</span>
               </div>
            </div>
         </Link>
      </>
   )
}
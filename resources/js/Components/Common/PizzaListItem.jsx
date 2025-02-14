import { Link } from '@inertiajs/react';
import { getImageUrl } from '@/utils/image';


export default function PizzaListItem({ pizza }) {
   console.log(pizza);
   return (
      <Link href={`/pizzas/${pizza.brand.slug}/${pizza.slug}`} key={pizza.id} className="bg-white rounded-lg shadow-md overflow-hidden">
         <div key={pizza.id} className="bg-white rounded-lg shadow-md overflow-hidden">
            {pizza?.image && (
               <img
                  src={getImageUrl(pizza.image)}
                  alt={`Primary image for ${pizza.name} from ${pizza.brand.name}`}
                  className="max-w-[300px] m-auto object-cover p-6"
               />
            )}
            <div className="p-4">
               <h2 className="text-xl font-bold mb-2">{pizza?.name || 'No name'}</h2>
               <p className="text-gray-600 mb-2">{pizza?.brand?.name || 'No brand'}</p>
               <p className="text-sm text-gray-500 mb-4">{pizza?.style?.name || 'No style'}</p>
               <div className="flex justify-between items-center">
                  <div className="flex items-center">
                     <span className="text-yellow-400">★</span>
                     <span className="ml-1">{pizza?.average_rating?.toFixed(1) || 'No rating'}</span>
                     <span className="text-gray-500 text-sm ml-2">
                        ({pizza?.total_reviews || 'No reviews'} reviews)
                     </span>
                  </div>
               </div>
            </div>
         </div>
      </Link>
   );
}

import React from 'react';
import MainLayout from '@/Layouts/MainLayout';
import PizzaGridWithPromo from '@/Components/Common/PizzaGridWithPromo';
import ItemListSchema from '@/Components/SEO/ItemListSchema';

export default function TopRated({ pizzas, meta, auth }) {
   return (
      <MainLayout meta={meta} auth={auth}>
         <ItemListSchema
            name="Top Rated Frozen Pizzas"
            items={pizzas}
            itemUrl={(pizza) => `/pizzas/${pizza.brand.slug}/${pizza.slug}`}
         />
         <div className="max-w-[1880px] mx-auto px-4 sm:px-5 lg:px-6 py-8">
            <h1 className="text-2xl font-bold mb-6">Top Rated Frozen Pizzas In The World</h1>
            <PizzaGridWithPromo pizzas={pizzas} />
         </div>
      </MainLayout>
   );
}

import React from 'react';
import { Head } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import axios from 'axios';
import { useState, useEffect } from 'react';
import { Link } from '@inertiajs/react';
import PizzaListItem from '@/Components/Common/PizzaListItem';

export default function TopRated({ pizzas, meta, auth }) {

   return (
      <MainLayout meta={meta} auth={auth}>
         <h1 className="text-2xl font-bold mb-4">Top Rated Frozen Pizzas In The World</h1>
         <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {pizzas.map((pizza) => (
               <PizzaListItem key={pizza.id} pizza={pizza} />
            ))}
         </div>
      </MainLayout>
   );
} 
import React from 'react';
import { Head } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import axios from 'axios';
import { useState, useEffect } from 'react';
import { Link } from '@inertiajs/react';

export default function PizzasIndex({ pizzasFirstPage, meta, auth }) {

    const [pizzas, setPizzas] = useState(pizzasFirstPage);

    const fetchPizzas = async () => {
        const page = pizzas.current_page + 1;
        const response = await axios.get(`/pizzas/list?page=${page}`);
        setPizzas(response.data);
    };

    // if the user scrolls to the bottom of the page, fetch the next page
    useEffect(() => {
        const handleScroll = () => {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100) {
                fetchPizzas();
            }
        };
        window.addEventListener('scroll', handleScroll);
        return () => window.removeEventListener('scroll', handleScroll);
    }, [pizzas]);

    return (
        <MainLayout meta={meta} auth={auth}>
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {pizzas.data.map((pizza) => (
                    <Link href={`/pizzas/${pizza.brand.slug}/${pizza.slug}`} key={pizza.id} className="bg-white rounded-lg shadow-md overflow-hidden">
                        <div key={pizza.id} className="bg-white rounded-lg shadow-md overflow-hidden">
                            {pizza.image_url && (
                                <img
                                    src={pizza.image_url}
                                    alt={pizza.name}
                                    className="w-full h-48 object-cover"
                                />
                            )}
                            <div className="p-4">
                                <h2 className="text-xl font-bold mb-2">{pizza.name}</h2>
                                <p className="text-gray-600 mb-2">{pizza.brand.name}</p>
                                <p className="text-sm text-gray-500 mb-4">{pizza.style.name}</p>
                                <div className="flex justify-between items-center">
                                    <div className="flex items-center">
                                        <span className="text-yellow-400">★</span>
                                        <span className="ml-1">{pizza.average_rating.toFixed(1)}</span>
                                        <span className="text-gray-500 text-sm ml-2">
                                            ({pizza.total_reviews} reviews)
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </Link>
                ))}
            </div>
        </MainLayout>
    );
} 
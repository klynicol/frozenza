import React from 'react';
import { Head } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import axios from 'axios';
import { useState, useEffect } from 'react';
import { Link } from '@inertiajs/react';
import PizzaListItem from '@/Components/Common/PizzaListItem';
import ApplicationLogo from '@/Components/ApplicationLogo';

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
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div className="text-center mb-12">
                    <div className="flex justify-center mb-6">
                        <ApplicationLogo className="w-[260px] h-[260px]" />
                    </div>
                    <h1 className="text-4xl font-extrabold text-gray-900 mb-4">Welcome to Pizza Kraken</h1>
                    <p className="text-xl text-gray-600 max-w-3xl mx-auto">
                        Discover the world's most comprehensive frozen pizza database. From DiGiorno to Table 87 (and everything in between),
                        explore thousands of frozen pizzas from brands across the globe. Rate, review, and find your next
                        favorite slice!
                    </p>
                </div>

                <h2 className="text-2xl font-bold mb-6">Featured Pizzas</h2>
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {pizzas.data.map((pizza) => (
                        <PizzaListItem key={pizza.id} pizza={pizza} />
                    ))}
                </div>
            </div>
        </MainLayout>
    );
} 
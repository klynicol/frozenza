import React from 'react';
import { Head } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import axios from 'axios';
import { useState, useEffect } from 'react';
import { Link } from '@inertiajs/react';
import PizzaListItem from '@/Components/Common/PizzaListItem';

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
            <h1 className="text-2xl font-bold mb-4">All Pizzas</h1>
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {pizzas.data.map((pizza) => (
                    <PizzaListItem key={pizza.id} pizza={pizza} />
                ))}
            </div>
        </MainLayout>
    );
} 
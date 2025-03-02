import React from 'react';
import MainLayout from '@/Layouts/MainLayout';
import { Link } from '@inertiajs/react';
import './blog.css';
import useAxios from 'axios-hooks';
import PizzaListItem from '@/Components/Common/PizzaListItem';

export default function BlogShow({ post, content, meta, auth }) {

    const [{ data: pizzas, loading, error }, refetch] = useAxios('/pizzas/list');

    return (
        <MainLayout meta={meta} auth={auth}>
            <div className="blog max-w-7xl mx-auto flex">
                <article className="bg-white rounded-lg shadow-lg overflow-hidden flex-1 flex">
                    {post.featured_image && (
                        <img
                            src={post.featured_image}
                            alt={post.title}
                            className="w-full h-64 object-cover"
                        />
                    )}
                    <div className="p-6">
                        <h1 className="text-3xl font-bold mb-4">{post.title}</h1>
                        <div className="flex justify-between items-center text-sm text-gray-500 mb-8">
                            <span>By Charles Gilchrist</span>
                            <span>{new Date(post.published_at).toLocaleDateString()}</span>
                        </div>
                        <div
                            className="prose max-w-none"
                            dangerouslySetInnerHTML={{ __html: content }}
                        />
                        {post.tags?.length > 0 && (
                            <div className="mt-8 pt-4 border-t">
                                <div className="flex gap-2">
                                    {post.tags.map((tag, index) => (
                                        <span
                                            key={index}
                                            className="px-3 py-1 bg-gray-100 rounded-full text-sm"
                                        >
                                            {tag}
                                        </span>
                                    ))}
                                </div>
                            </div>
                        )}
                    </div>
                    <div className="hidden md:block max-w-[310px]">
                        <h2 className="text-xl font-bold mb-4 text-center">Top-Rated Pizzas</h2>
                        <ul className="space-y-4 px-2">
                            {pizzas?.data && pizzas.data.map((pizza) => (
                                <PizzaListItem key={pizza.id} pizza={pizza} />
                            ))}
                            {/* Add more pizzas as needed */}
                        </ul>
                    </div>
                </article>
            </div>
        </MainLayout>
    );
} 
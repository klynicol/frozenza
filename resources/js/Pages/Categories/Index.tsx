import React from 'react';
import MainLayout from '@/Layouts/MainLayout';
import type { Category } from '@/types/models';
import type { PageProps } from '@/types/props';
import { Link } from '@inertiajs/react';

interface CategoriesIndexProps extends PageProps {
    categories: Category[];
}

export default function CategoriesIndex({ categories, meta, auth }: CategoriesIndexProps) {
    return (
        <MainLayout meta={meta} auth={auth}>
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {categories.map((category) => (
                    <Link 
                        key={category.id} 
                        href={`/categories/${category.slug}`}
                        className="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow"
                    >
                        <div className="p-6">
                            <h2 className="text-xl font-bold mb-2">{category.name}</h2>
                            <p className="text-gray-600">{category.description}</p>
                        </div>
                    </Link>
                ))}
            </div>
        </MainLayout>
    );
} 
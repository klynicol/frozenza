import React from 'react';
import MainLayout from '@/Layouts/MainLayout';
import type { Style } from '@/types/models';
import type { PageProps } from '@/types/props';
import { Link } from '@inertiajs/react';

interface StylesIndexProps extends PageProps {
    styles: Style[];
}

export default function StylesIndex({ styles, meta, auth }: StylesIndexProps) {
    return (
        <MainLayout meta={meta} auth={auth}>
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {styles.map((style) => (
                    <Link 
                        key={style.id} 
                        href={`/styles/${style.slug}`}
                        className="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow"
                    >
                        <div className="p-6">
                            <h2 className="text-xl font-bold mb-2">{style.name}</h2>
                            <p className="text-gray-600">{style.description}</p>
                        </div>
                    </Link>
                ))}
            </div>
        </MainLayout>
    );
} 
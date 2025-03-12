import React from 'react';
import { Head } from '@inertiajs/react';

export default function BreadcrumbSchema({ items }) {
    const schema = {
        '@context': 'https://schema.org',
        '@type': 'BreadcrumbList',
        'itemListElement': items.map((item, index) => ({
            '@type': 'ListItem',
            'position': index + 1,
            'item': {
                '@id': `${import.meta.env.VITE_APP_URL}${item.url}`,
                'name': item.name,
            },
        })),
    };

    return (
        <Head>
            <script 
                type="application/ld+json"
                dangerouslySetInnerHTML={{
                    __html: JSON.stringify(schema)
                }}
            />
        </Head>
    );
} 
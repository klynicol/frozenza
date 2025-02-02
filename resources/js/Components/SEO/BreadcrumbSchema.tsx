import React from 'react';
import { Head } from '@inertiajs/react';

interface Breadcrumb {
    name: string;
    url: string;
}

interface BreadcrumbSchemaProps {
    items: Breadcrumb[];
}

export default function BreadcrumbSchema({ items }: BreadcrumbSchemaProps) {
    const schema = {
        '@context': 'https://schema.org',
        '@type': 'BreadcrumbList',
        'itemListElement': items.map((item, index) => ({
            '@type': 'ListItem',
            'position': index + 1,
            'item': {
                '@id': `${window.location.origin}${item.url}`,
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
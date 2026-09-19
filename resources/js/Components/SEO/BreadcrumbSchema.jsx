import React from 'react';
import { Head, usePage } from '@inertiajs/react';
import { absoluteUrl } from '@/utils/seo';

export default function BreadcrumbSchema({ items }) {
    const { site = {} } = usePage().props;
    const schema = {
        '@context': 'https://schema.org',
        '@type': 'BreadcrumbList',
        'itemListElement': items.map((item, index) => ({
            '@type': 'ListItem',
            'position': index + 1,
            'item': {
                '@id': absoluteUrl(item.url, site.url),
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

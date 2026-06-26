import React from 'react';
import { Head, usePage } from '@inertiajs/react';
import { absoluteUrl } from '@/utils/seo';

export default function ItemListSchema({ name, items, itemUrl }) {
    const { site = {} } = usePage().props;
    const list = Array.isArray(items) ? items : [];

    if (list.length === 0) {
        return null;
    }

    const schema = {
        '@context': 'https://schema.org',
        '@type': 'ItemList',
        name,
        itemListElement: list.map((item, index) => ({
            '@type': 'ListItem',
            position: index + 1,
            url: absoluteUrl(itemUrl(item), site.url),
            name: item.name,
        })),
    };

    return (
        <Head>
            <script
                type="application/ld+json"
                dangerouslySetInnerHTML={{
                    __html: JSON.stringify(schema),
                }}
            />
        </Head>
    );
}

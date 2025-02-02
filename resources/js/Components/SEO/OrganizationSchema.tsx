import React from 'react';
import { Head } from '@inertiajs/react';

interface OrganizationSchemaProps {
    name: string;
    url: string;
    logo?: string;
    description?: string;
    socialMediaHandles?: {
        [key: string]: string;
    };
}

export default function OrganizationSchema({ 
    name, 
    url, 
    logo, 
    description,
    socialMediaHandles 
}: OrganizationSchemaProps) {
    const schema = {
        '@context': 'https://schema.org',
        '@type': 'Organization',
        name,
        url,
        ...(logo && { logo }),
        ...(description && { description }),
        ...(socialMediaHandles && { sameAs: Object.values(socialMediaHandles) }),
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
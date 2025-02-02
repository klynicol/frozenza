import React from 'react';
import { Head } from '@inertiajs/react';
import type { MetaProps } from '@/types/props';

interface MetaTagsProps extends MetaProps {
    canonicalUrl?: string;
    imageUrl?: string;
}

export default function MetaTags({ title, description, canonicalUrl, imageUrl }: MetaTagsProps) {
    const baseUrl = window.location.origin;
    const fullCanonicalUrl = canonicalUrl ? `${baseUrl}${canonicalUrl}` : window.location.href;

    return (
        <Head>
            <title>{title}</title>
            <meta name="description" content={description} />
            
            {/* Open Graph */}
            <meta property="og:title" content={title} />
            <meta property="og:description" content={description} />
            <meta property="og:type" content="website" />
            <meta property="og:url" content={fullCanonicalUrl} />
            {imageUrl && <meta property="og:image" content={imageUrl} />}
            
            {/* Twitter */}
            <meta name="twitter:card" content="summary_large_image" />
            <meta name="twitter:title" content={title} />
            <meta name="twitter:description" content={description} />
            {imageUrl && <meta name="twitter:image" content={imageUrl} />}
            
            {/* Canonical URL */}
            <link rel="canonical" href={fullCanonicalUrl} />
        </Head>
    );
} 
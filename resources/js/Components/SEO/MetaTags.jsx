import React from 'react';
import { Head } from '@inertiajs/react';

export default function MetaTags({ title, description, canonicalUrl, imageUrl }) {
    const baseUrl = window.location.origin;
    const fullCanonicalUrl = canonicalUrl ? `${baseUrl}${canonicalUrl}` : window.location.href;

    return (
        <Head>
            <title>{title}</title>
            <meta name="description" content={description} />

            <meta property="og:title" content={title} />
            <meta property="og:description" content={description} />
            <meta property="og:image" content={`${baseUrl}/storage/assets/social_image.png`} />
            <meta property="og:type" content="website" />

            <meta name="twitter:card" content="summary_large_image" />
            <meta name="twitter:title" content={title} />
            <meta name="twitter:description" content={description} />
            <meta name="twitter:image" content={`${baseUrl}/storage/assets/social_image.png`} />

            {/* Open Graph - Facebook */}
            <meta property="og:url" content={fullCanonicalUrl} />

            {/* Canonical URL */}
            <link rel="canonical" href={fullCanonicalUrl} />
        </Head>
    );
} 
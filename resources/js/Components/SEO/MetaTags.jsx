import React from 'react';
import { Head } from '@inertiajs/react';

export default function MetaTags({ title, description, canonicalUrl, imageUrl }) {
    const baseUrl = window.location.origin;
    const fullCanonicalUrl = canonicalUrl ? `${baseUrl}${canonicalUrl}` : window.location.href;

    return (
        <Head>
            {/* Open Graph - Facebook */}
            <meta property="og:url" content={fullCanonicalUrl} />

            {/* Canonical URL */}
            <link rel="canonical" href={fullCanonicalUrl} />
        </Head>
    );
} 
import React from 'react';
import { Head } from '@inertiajs/react';

export default function MetaTags({ title, description, canonicalUrl, keywords }) {
    const baseUrl = import.meta.env.VITE_APP_URL || '';
    const fullCanonicalUrl = canonicalUrl ? `${baseUrl}${canonicalUrl}` : '';

    // Render the same output on server and client to avoid hydration mismatches (e.g. when using Inertia SSR).
    return (
        <Head>
            <title>{title}</title>
            {/* flexoffers.com verification */}
            <meta name="fo-verify" content="2ca802a6-3183-4cdc-b8b5-1540534e5ddc" />
            <meta name="description" content={description} />
            <meta name="keywords" content={keywords} />
            <meta property="og:title" content={title} />
            <meta property="og:description" content={description} />
            <meta property="og:image" content={`${baseUrl}/storage/assets/social_image.png`} />
            <meta property="og:type" content="website" />
            <meta property="og:url" content={fullCanonicalUrl} />

            <meta name="twitter:card" content="summary_large_image" />
            <meta name="twitter:title" content={title} />
            <meta name="twitter:description" content={description} />
            <meta name="twitter:image" content={`${baseUrl}/storage/assets/social_image.png`} />

            <link rel="canonical" href={fullCanonicalUrl} />

            <link rel="preconnect" href="https://fonts.googleapis.com" />
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
            <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet" />
        </Head>
    );
} 
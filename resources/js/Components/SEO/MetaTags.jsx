import React from 'react';
import { Head, usePage } from '@inertiajs/react';
import { absoluteUrl } from '@/utils/seo';

export default function MetaTags({ title, description, canonicalUrl, keywords, robots = 'index,follow' }) {
    const { site = {} } = usePage().props;
    const fullCanonicalUrl = canonicalUrl ? absoluteUrl(canonicalUrl, site.url) : undefined;
    const socialImageUrl = absoluteUrl('/storage/assets/social_image.png', site.url);

    // Render the same output on server and client to avoid hydration mismatches (e.g. when using Inertia SSR).
    return (
        <Head>
            {title && <title>{title}</title>}
            {/* flexoffers.com verification */}
            <meta name="fo-verify" content="2ca802a6-3183-4cdc-b8b5-1540534e5ddc" />
            <meta name="robots" content={robots} />
            {description && <meta name="description" content={description} />}
            {keywords && <meta name="keywords" content={keywords} />}
            {title && <meta property="og:title" content={title} />}
            {description && <meta property="og:description" content={description} />}
            <meta property="og:image" content={socialImageUrl} />
            <meta property="og:type" content="website" />
            {fullCanonicalUrl && <meta property="og:url" content={fullCanonicalUrl} />}

            <meta name="twitter:card" content="summary_large_image" />
            {title && <meta name="twitter:title" content={title} />}
            {description && <meta name="twitter:description" content={description} />}
            <meta name="twitter:image" content={socialImageUrl} />

            {fullCanonicalUrl && <link rel="canonical" href={fullCanonicalUrl} />}
        </Head>
    );
} 

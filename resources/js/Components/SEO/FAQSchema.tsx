import React from 'react';
import { Head } from '@inertiajs/react';

interface FAQItem {
    question: string;
    answer: string;
}

interface FAQSchemaProps {
    questions: FAQItem[];
}

export default function FAQSchema({ questions }: FAQSchemaProps) {
    const schema = {
        '@context': 'https://schema.org',
        '@type': 'FAQPage',
        'mainEntity': questions.map(item => ({
            '@type': 'Question',
            'name': item.question,
            'acceptedAnswer': {
                '@type': 'Answer',
                'text': item.answer
            }
        }))
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
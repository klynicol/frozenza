<?php
return [
    'ssr' => [
        // Set to true only when you run the SSR server (e.g. in production). Leave false for local dev to avoid hydration errors.
        'enabled' => env('INERTIA_SSR_ENABLED', false),
        'url' => env('INERTIA_SSR_URL', 'http://localhost:13714/render'),
    ],
    // ... other config options ...
]; 
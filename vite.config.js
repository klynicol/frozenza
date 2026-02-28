import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.jsx',
            refresh: true,
            // SSR disabled for local dev. To use SSR in production, add back: ssr: 'resources/js/ssr.js'
        }),
        react(),
    ],
});

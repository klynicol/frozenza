import './bootstrap';
import '../css/app.css';

import { createRoot, hydrateRoot } from 'react-dom/client';
import { createInertiaApp } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

createInertiaApp({
    resolve: (name) => resolvePageComponent(`./Pages/${name}.jsx`, 
        import.meta.glob('./Pages/**/*.jsx')
    ),
    setup({ el, App, props }) {
        // Hydrate when the root has server-rendered content (production SSR); otherwise mount client-only (local dev).
        const hasServerContent = el.hasChildNodes();
        if (hasServerContent) {
            hydrateRoot(el, <App {...props} />);
        } else {
            createRoot(el).render(<App {...props} />);
        }
    },
    progress: {
        color: '#4B5563',
    },
});

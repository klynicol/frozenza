/// <reference types="vite/client" />

interface ImportMetaEnv {
    readonly VITE_APP_NAME: string;
}

declare module '@inertiajs/core' {
    interface PageProps {
        auth: {
            user: import('./models').User;
        };
    }
}

declare global {
    interface ImportMeta {
        readonly env: ImportMetaEnv;
    }
}

export {}; 
import tailwindcss from '@tailwindcss/vite';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            publicDirectory: '../public',
            buildDirectory: 'build/marketing',
            hotFile: '../storage/hot/marketing',
            input: ['resources/css/app.css', 'resources/js/app.tsx'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        port: 5174,
    },
});

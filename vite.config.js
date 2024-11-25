import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app-theme-1.css',
                'resources/css/app-theme-2.css',
                'resources/js/app.js',
                'resources/css/filament/dashboard/theme.css',
            ],
            refresh: true,
        }),
    ],
});
1
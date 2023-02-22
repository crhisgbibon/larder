import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/vh.js',
                'resources/js/foods.js',
                'resources/js/log.js',
                'resources/js/profile.js',
                'resources/js/recipes.js',
            ],
            refresh: true,
        }),
    ],
});

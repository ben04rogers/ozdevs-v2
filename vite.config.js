import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            purge: [
                './resources/**/*.{js,ts,jsx,tsx,php,blade.php}', // Include JavaScript, TypeScript, PHP, and Blade files within the resources directory
            ],
            refresh: true
        }),
    ],
});

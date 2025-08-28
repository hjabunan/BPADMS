import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    // server: {
    //     host: '0.0.0.0',
    //     port: 8104, // or your port
    //     hmr: {
    //         host: '192.168.20.245', // e.g. 192.168.1.10
    //     }
    // }
});

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    
    define: {
        'process.env': {
            VITE_REVERB_APP_KEY: JSON.stringify(process.env.REVERB_APP_KEY),
            VITE_REVERB_HOST: JSON.stringify(process.env.REVERB_SERVER_HOST),
            VITE_REVERB_PORT: JSON.stringify(process.env.REVERB_SERVER_PORT),
        }
    }
});



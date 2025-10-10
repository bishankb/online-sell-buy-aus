import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/frontend-app.js', // your main JS file
            ],
            refresh: true, // live reload in dev
        }),
    ],
    build: {
        outDir: 'public/build',
        manifest: true,
        rollupOptions: {
            input: {
                frontend: path.resolve(__dirname, 'resources/js/frontend-app.js'),
            },
            output: {
                entryFileNames: '[name].js',      // ensure it stays frontend-app.js
                chunkFileNames: '[name].js',
                assetFileNames: '[name].[ext]',
            },
        },
    },
    server: {
        host: true,
        cors: true,
        hmr: {
            protocol: 'ws',
            host: '127.0.0.1',
        },
    },
});
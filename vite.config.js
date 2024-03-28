import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import basicSsl from '@vitejs/plugin-basic-ssl'

export default defineConfig({
    define: {
        __VUE_PROD_DEVTOOLS__: false, // Optional: Disables Vue DevTools in production
        __VUE_PROD_HYDRATION_MISMATCH_DETAILS__: false,
    },
    plugins: [
        basicSsl(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
                refresh: true
            },
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources/js',
        },
    },
    server: {
        host: '0.0.0.0',
        hmr: {
            host: 'localhost'
        },
    },
});



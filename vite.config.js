import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
const path = require("path");

export default defineConfig({
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "./resources/js"),
        },
    },
    plugins: [
        laravel({
            input: "resources/js/app.js",
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    server: {
        https: false,
        host: false,
        port: 3009,
        cors: true,
        hmr: {
            protocol: "ws",
            host: "localhost",
        },
    },
});

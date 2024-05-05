import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from 'ziggy-js';
import { Ziggy } from './ziggy.js';
import store from "./Store/search.js";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
const appName = window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";
import PrimeVue from 'primevue/config';
import Lara from '../js/presets/lara';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        return resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob("./Pages/**/*.vue"));
    },

    setup({ el, app, props, plugin }) {

        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(store)
            .use(PrimeVue, {
                unstyled: true,
                pt: Lara
            })
            .use(ZiggyVue, Ziggy)
            .use(Toast, {
                transition: "Vue-Toastification__bounce",
                maxToasts: 20,
                newestOnTop: true,
            })
            .mount(el);
    },
}).then(() => console.log("Welcome to Command Hub"));

InertiaProgress.init({
    color: "#e115e8",
});

import VueRouter from "vue-router";
import Welcome from "../Pages/Welcome"

const routes = [
    { path: '/', component: Welcome},
];

export const router = new VueRouter({
    routes
})

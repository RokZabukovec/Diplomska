import * as VueRouter from "vue-router";
import ProjectsTable from "../Components/Tailwindui/ProjectsTable.vue";
import ProjectContentSelection from "../Components/Tailwindui/ProjectContentSelection.vue";

// 2. Define some routes
// Each route should map to a component.
// We'll talk about nested routes later.
const dashboardRoutes = [
    { path: "/", component: ProjectsTable },
    { path: "/project/:id", component: ProjectContentSelection },
];

export const router = VueRouter.createRouter({
    history: VueRouter.createMemoryHistory(),
    routes: dashboardRoutes,
});

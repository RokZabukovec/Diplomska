import * as VueRouter from "vue-router";
import ProjectsTable from "../Components/Tailwindui/ProjectsTable.vue";
import ProjectContentSelection from "../Components/Tailwindui/ProjectContentSelection.vue";
import CreateTeamForm from "../Pages/Teams/Partials/CreateTeamForm.vue";
import TeamMemberManager from "../Pages/Teams/Partials/TeamMemberManager.vue";

const dashboardRoutes = [
    { path: "/project/:id", component: ProjectContentSelection },
    { path: "/", component: ProjectsTable },
];

export const router = VueRouter.createRouter({
    history: VueRouter.createMemoryHistory(),
    routes: dashboardRoutes,
});

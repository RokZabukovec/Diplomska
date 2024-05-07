<template>
    <MainLayout>
            <div class="mx-auto max-w-3xl">
                <Badges></Badges>
                <div v-if="loading" class="flex justify-center items-center h-screen">
                    <ProgressSpinner style="width: 50px; height: 50px" strokeWidth="8" class="fill-surface-0 dark:fill-surface-800"
                                     animationDuration=".5s" aria-label="Custom ProgressSpinner" />
                </div>

                <div v-else>
                    <Projects v-show="showProjects"></Projects>
                    <CommandList v-if="showCommands"></CommandList>
                    <Team v-if="showTeam"></Team>
                </div>
            </div>
    </MainLayout>
</template>

<script setup>
import MainLayout from "../Layouts/MainLayout.vue";
import Projects from "../Pages/Redesign/Projects.vue";
import { computed, onMounted } from "vue";
import CommandList from "../Components/Tailwindui/CommandList.vue";
import { useStore } from "vuex";
import Badges from "./Badges.vue";
import Team from "../Components/Tailwindui/Team.vue";
import ProgressSpinner from 'primevue/progressspinner';
import { usePage } from "@inertiajs/inertia-vue3";
import useUrlParams from "../composables/useUrlParams";

let store = useStore();
let page = usePage();

const loading = computed(() => store.state.search.loading);
const showProjects = computed(() => store.state.search.type === "projects");
const showCommands = computed(() => store.state.search.type === "commands");
const showTeam = computed(() => store.state.search.type === "team_members");

const { params } = useUrlParams();

store.dispatch("search/setSelected", params);
</script>

<style scoped>
.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>

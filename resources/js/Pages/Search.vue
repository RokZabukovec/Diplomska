<template>
    <MainLayout>
            <div class="mx-auto max-w-3xl">
                <Badges></Badges>
                <div v-if="loading">
                    Loading ...
                </div>
                <div v-else>
                    <Transition>
                        <Projects v-if="showProjects"></Projects>
                        <CommandList v-else-if="showCommands"></CommandList>
                        <Team v-else-if="showTeam"></Team>
                    </Transition>
                </div>
            </div>
    </MainLayout>
</template>

<script setup>
import MainLayout from "../Layouts/MainLayout.vue";
import Projects from "../Pages/Redesign/Projects.vue";
import {computed} from "vue";
import CommandList from "../Components/Tailwindui/CommandList.vue";
import { useStore } from "vuex";
import Badges from "./Badges.vue";
import Team from "../Components/Tailwindui/Team.vue";

let store = useStore();
// Define a computed property to get the 'type' property from the Vuex store state
const loading = computed(() => store.state.search.loading);
const showProjects = computed(() => store.state.search.type === "projects");
const showCommands = computed(() => store.state.search.type === "commands");
const showTeam = computed(() => store.state.search.type === "team_members");
console.log(computed(() => store.state.search.type).value)
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

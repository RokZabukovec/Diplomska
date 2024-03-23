<template>
    <MainLayout>
            <div class="mx-auto max-w-3xl">
                <div v-if="loading">
                    <h1>Loading</h1>
                </div>
                <div v-else>
                    <Transition>
                        <Projects v-show="showProjects" :projects="projects"></Projects>
                    </Transition>
                </div>
            </div>
    </MainLayout>
</template>

<script setup>
import MainLayout from "../Layouts/MainLayout.vue";
import Projects from "../Pages/Redesign/Projects.vue";
import {computed} from "vue";
import searchStore from "../Store/search.js";

const projects = computed(() => searchStore.state.search.projects);
const loading = computed(() => searchStore.state.search.loading);
let showProjects = computed(() => searchStore.state.search.type).value === "projects";
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

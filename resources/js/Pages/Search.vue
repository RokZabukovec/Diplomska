<template>
    <MainLayout>
            <div class="mx-auto max-w-3xl">
                <div class="filters mb-4">
                    <span class="inline-flex items-center gap-x-0.5 rounded-md bg-gray-100 px-2 py-1 text-xs font-medium text-gray-600">
                        Badge
                        <button type="button" class="group relative -mr-1 h-3.5 w-3.5 rounded-sm hover:bg-gray-500/20">
                            <span class="sr-only">Remove</span>
                            <svg viewBox="0 0 14 14" class="h-3.5 w-3.5 stroke-gray-700/50 group-hover:stroke-gray-700/75">
                            <path d="M4 4l6 6m0-6l-6 6" />
                            </svg>
                            <span class="absolute -inset-1"></span>
                        </button>
                        </span>
                    <span class="inline-flex items-center gap-x-0.5 rounded-md bg-red-100 px-2 py-1 text-xs font-medium text-red-700">
                        Badge
                        <button type="button" class="group relative -mr-1 h-3.5 w-3.5 rounded-sm hover:bg-red-600/20">
                            <span class="sr-only">Remove</span>
                            <svg viewBox="0 0 14 14" class="h-3.5 w-3.5 stroke-red-700/50 group-hover:stroke-red-700/75">
                            <path d="M4 4l6 6m0-6l-6 6" />
                            </svg>
                            <span class="absolute -inset-1"></span>
                        </button>
                    </span>
                </div>
                <Projects v-show="showProjects" :projects="projects"></Projects>
                <div class="flex justify-center p-6">
                    <button class="border-2 border-pink-600 px-4 py-1.5 rounded-md text-pink-600 bg-transparent font-bold transition duration-300 ease-in-out hover:border-pink-600 focus:border-pink-600 focus:outline-none focus:ring-2 focus:ring-pink-600 focus:ring-opacity-50">
                        Load more
                    </button>
                </div>
            </div>
    </MainLayout>
</template>

<script setup>
import MainLayout from "../Layouts/MainLayout.vue";
import Projects from "../Pages/Redesign/Projects.vue";
import { useStore } from "vuex";
import {computed} from "vue";
import searchStore from "../Store/search";

let store = useStore();
const projects = computed(() => searchStore.state.search.projects);
const type = computed(() => searchStore.state.search.type);
const loading = computed(() => searchStore.state.search.loading);

let showProjects = type.value === "projects";
let showLoading = loading.value;
</script>

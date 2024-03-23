<script setup>

import EmptyProject from "../../Components/Tailwindui/EmptyProject.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
import searchStore from "../../Store/search";
import SlideOverNewProject from "../../Components/Tailwindui/SlideOverNewProject.vue";
import Badges from "../Badges.vue";

const totalPages = computed(() => searchStore.state.search.totalPages);
const currentPage = computed(() => searchStore.state.search.page);
let showMore = currentPage.value < totalPages.value

function loadNextPage() {
    searchStore.dispatch('search/incrementPage');
}

function selectProject(id, name) {
    searchStore.dispatch('search/setProject', id, name);
    searchStore.dispatch('search/addBadge', name);
}

function getLabelColor(projectLabel){
    if (!projectLabel.length || projectLabel.toString().toLowerCase() === "white") return "bg-gray-100 text-black";

    return "bg-" + projectLabel.toString().toLowerCase() + "-400";
}

function getInitials(text, max=2) {
    const words = text.split(' ');

    let initials = '';
    for (const word of words) {
        if (words.length === 1){
            let num = 0;
            for(const char of word){
                initials += char;
                num++;
                if (num >= max) break;
            }
            break;
        }
        const initial = word[0].toUpperCase();
        initials += initial;
    }

    return initials;
}

defineProps({
    projects: Array
});

</script>

<template>
    <div>
        <Badges></Badges>
        <SlideOverNewProject></SlideOverNewProject>
        <ul v-if="$props.projects.length" role="list" class="divide-y divide-gray-100">
            <li v-for="project in $props.projects" @click="selectProject(project.id, project.name)" :key="project.name" :class="{ 'fade-in': !$props.loading, 'fade-out': $props.loading }" class="flex items-center justify-between gap-x-6 py-5">
                <div class="min-w-0">
                    <div class="flex items-start gap-x-3">
                        <div :class="[getLabelColor(project.label_color), 'flex-shrink-0 flex items-center justify-center w-16 text-white text-sm font-medium rounded']">
                            {{ getInitials(project.name) }}</div>
                        <p class="text-sm font-semibold leading-6 text-gray-900">{{ project.name }}</p>
                    </div>
                </div>
                <div class="flex flex-none items-center gap-x-4">
                    <Link :href="route('project', { id: project.id })" class="hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:block"
                    >View project<span class="sr-only">, {{ project.name }}</span></Link>
                </div>
            </li>
        </ul>
        <div v-if="$props.projects.length === 0 && !loading" class="mt-6">
            <EmptyProject/>
        </div>
        <div v-show="showMore" class="flex justify-center p-6">
            <button class="border-2 border-pink-600 px-4 py-1.5 rounded-md text-pink-600 bg-transparent font-bold transition duration-300 ease-in-out hover:border-pink-600 focus:border-pink-600 focus:outline-none focus:ring-2 focus:ring-pink-600 focus:ring-opacity-50" @click="loadNextPage">
                Load more
            </button>
        </div>
    </div>
</template>

<style scoped>

</style>

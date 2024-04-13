<script setup>

import EmptyProject from "../../Components/Tailwindui/EmptyProject.vue";
import { computed } from "vue";
import searchStore from "../../Store/search";
import SlideOverNewProject from "../../Components/Tailwindui/SlideOverNewProject.vue";
import Badges from "../Badges.vue";
import moment from "moment";

const totalPages = computed(() => searchStore.state.search.totalPages);
const currentPage = computed(() => searchStore.state.search.page);
let showMore = currentPage.value < totalPages.value
const projects = computed(() => searchStore.state.search.projects);

function loadNextPage() {
    searchStore.dispatch('search/incrementPage');
}

function selectProject(id, name) {
    searchStore.dispatch('search/setProject', id, name);
    searchStore.dispatch('search/addBadge', {label: 'project', value: name});
}

function getLabelColor(projectLabel){

    if (projectLabel === undefined){
        return "bg-gray-100 text-black"
    }

    if (!projectLabel.length || projectLabel.toString().toLowerCase() === "white") return "bg-gray-100 text-black";

    if (projectLabel.startsWith("#")) {
        return "bg-gray-100 text-black"
    }

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

function formatDate(datetime){
    let momentDate = moment(datetime);

    return momentDate.format('DD.MMMM.YYYY');
}
</script>

<template>
    <div>
        <SlideOverNewProject></SlideOverNewProject>
        <TransitionGroup v-if="projects.length" name="list" tag="ul">
            <li tabindex="0" v-for="project in projects" :key="project.name" @click="selectProject(project.id, project.name)" class="flex-1 mt-1 p-2 pr-6 shadow hover:bg-indigo-100 cursor-pointer rounded flex items-center justify-between gap-x-6 py-5">
                <div class="flex-grow">
                    <div class="flex items-start gap-x-3">
                        <div :class="[getLabelColor(project.label_color), 'p-2 flex-shrink-0 flex items-center justify-center font-medium rounded uppercase']">
                            {{ getInitials(project.name) }}
                        </div>
                        <div class="flex-grow">
                            <h3 class="font-semibold leading-6 text-gray-900">{{ project.name }}</h3>
                            <p class="leading-6 text-gray-600">{{ project.description }}</p>
                            <div class="mt-5 text-gray-400 flex justify-between">
                                <p> <span>Created by </span>{{ project.username }}</p>
                                <p> <span>Created @ </span>{{ formatDate(project.created_at) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </TransitionGroup>
        <div v-if="projects.length === 0" class="mt-6">
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
.list-move, /* apply transition to moving elements */
.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateX(30px);
}

/* ensure leaving items are taken out of layout flow so that moving
   animations can be calculated correctly. */
.list-leave-active {
    position: absolute;
}
</style>

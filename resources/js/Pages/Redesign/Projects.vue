<script setup>

import { computed } from "vue";
import SlideOverNewProject from "../../Components/Tailwindui/SlideOverNewProject.vue";
import moment from "moment";
import { useStore } from "vuex";
import Pagination from "../../Components/Tailwindui/Pagination.vue";
import { TransitionRoot } from "@headlessui/vue";

const store = useStore();
const projects = computed(() => store.state.search.projects);
const loading = computed(() => store.state.search.loading);

function selectProject(id, name) {
    store.dispatch('search/setProject', id, name);
    store.dispatch('search/addBadge', {label: 'project', value: name});
}

function selectMember(id, name) {
    store.dispatch('search/setUserId', id);
    store.dispatch('search/addBadge', {label: 'user', value: name});
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
    <TransitionRoot
        name="list" as="ul"
        appear
        :show="!loading"
        enter="transition-opacity duration-300"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="transition-opacity duration-500"
        leave-from="opacity-100"
        leave-to="opacity-0"
    >
        <SlideOverNewProject></SlideOverNewProject>

        <li tabindex="0" @click="selectProject(-1, 'general')" class="flex-1 mt-6 p-3 shadow bg-indigo-600 text-white cursor-pointer rounded flex items-center justify-between gap-x-6">
            <div class="flex-grow">
                <div class="flex items-center gap-x-3">
                    <div class="p-2 flex-shrink-0 flex items-center justify-center font-medium rounded uppercase">
                        GE
                    </div>
                    <div class="flex-grow">
                        <h3 class="font-semibold leading-6">General</h3>
                        <p class="leading-6">Compiled set of Linux, MacOs and Windows bash terminal commands</p>
                    </div>
                </div>
            </div>
        </li>
        <li tabindex="0" v-for="project in projects" :key="project.name" class="flex-1 mt-6 p-3 shadow rounded flex items-center justify-between gap-x-6">
            <div class="flex-grow">
                <div class="flex items-start gap-x-3">
                    <div :class="[getLabelColor(project.label_color), 'p-2 flex-shrink-0 flex items-center justify-center font-medium rounded uppercase']">
                        {{ getInitials(project.name) }}
                    </div>
                    <div class="flex-grow">
                        <h3 class="font-semibold leading-6 text-gray-900 cursor-pointer text-gray-900" @click="selectProject(project.id, project.name)">{{ project.name }}</h3>
                        <p v-if="project.description !== null" class="leading-6 text-gray-600">{{ project.description }}</p>
                        <div class="mt-5 text-gray-400 flex justify-between">
                            <p @click="selectMember(project.user_id, project.username)" class="cursor-pointer text-xs">Created by <span class="transition font-semibold">{{ project.username }}</span></p>
                            <p class="text-xs"> <span>Created @ </span>{{ formatDate(project.created_at) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <div v-show="projects.length > 0" class="flex justify-center p-6">
            <Pagination></Pagination>
        </div>
    </TransitionRoot>
</template>

<style scoped>

</style>

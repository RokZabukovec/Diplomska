<template>
    <MainLayout :context="page.props.context">
        <div>
            <div class="flex justify-between border-b border-gray-200 pb-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Projects</h3>
                <SlideOverNewProject></SlideOverNewProject>
            </div>
            <div v-show="loading">
                <div class="pt-5">
                    <hollow-dots-spinner class="container mx-auto mt-5" :animation-duration="1000" :dot-size="15" :dots-num="3" color="#9400ff" />
                </div>
            </div>
            <ul v-if="userProjects.length && !loading" role="list" class="divide-y divide-gray-100">
                <li v-for="project in userProjects" :key="project.name" class="flex items-center justify-between gap-x-6 py-5">
                    <div class="min-w-0">
                    <div class="flex items-start gap-x-3">
                        <div :class="[getLabelColor(project.label_color), 'flex-shrink-0 flex items-center justify-center w-16 text-white text-sm font-medium rounded']">
                        {{ getInitials(project.name) }}</div>
                        <p class="text-sm font-semibold leading-6 text-gray-900">{{ project.name }}</p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                        <p class="whitespace-nowrap">
                            Created on <time :datetime="project.created_at">{{ formatDate(project.created_at) }}</time>
                        </p>
                        <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 fill-current">
                        <circle cx="1" cy="1" r="1" />
                        </svg>
                        <p class="truncate">Created by {{ project.user.name }}</p>
                    </div>
                    </div>
                    <div class="flex flex-none items-center gap-x-4">
                    <Link :href="route('project', { id: project.id })" class="hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:block"
                        >View project<span class="sr-only">, {{ project.name }}</span></Link>
                    </div>
                </li>
            </ul>
            <div v-else class="mt-6">
                <EmptyProject/>
            </div>
        </div>
    </MainLayout>
</template>
<script setup>
import {computed, onMounted} from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import {usePage} from '@inertiajs/inertia-vue3'
import store from "../Store/store";
import EmptyProject from "../Components/Tailwindui/EmptyProject.vue";
import { HollowDotsSpinner } from "epic-spinners";
import MainLayout from "../Layouts/MainLayout.vue";
import SlideOverNewProject from "../Components/Tailwindui/SlideOverNewProject.vue";
import moment from 'moment';

const page = usePage();

let loading = computed(() => store.state.general.loadingProjects);

const userProjects = computed(() => store.state.general.projects);

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

function getLabelColor(projectLabel){
    if (!projectLabel.length || projectLabel.toString().toLowerCase() === "white") return "bg-gray-100 text-black";

    return "bg-" + projectLabel.toString().toLowerCase() + "-400";
}

function selectProject(project) {
    store.commit("general/selectProject", project);
}

function formatDate(date) {
      return moment(date).format('MMMM D, YYYY');
}

onMounted(() => {
    store.commit("general/setUser", page.props.value.context.user);
});
</script>

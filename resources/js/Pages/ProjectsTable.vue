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
            <ul v-if="userProjects.length && !loading"  role="list" class="mt-3 grid grid-cols-1 gap-5 sm:grid-cols-2 sm:gap-6 lg:grid-cols-4">
                <li v-for="project in userProjects" :key="project.name" class="col-span-1 flex rounded-md shadow-sm">
                    <div :class="['bg-'+ project.label_color.toString().toLowerCase() +'-400', 'flex-shrink-0 flex items-center justify-center w-16 text-white text-sm font-medium rounded-l-md']">
                        {{ getInitials(project.name) }}</div>
                    <div class="flex flex-1 items-center justify-between truncate rounded-r-md border-t border-r border-b border-gray-200 bg-white">
                        <div class="flex-1 truncate px-4 py-2 text-sm">
                            <Link class="font-medium text-gray-900 hover:text-gray-600" :href="route('project', { id: project.id })">{{ project.name }}</Link>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="mt-6" v-else>
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
import ProjectEditMenu from "../Components/Tailwindui/ProjectEditMenu.vue";
import EmptyProject from "../Components/Tailwindui/EmptyProject.vue";
import { HollowDotsSpinner } from "epic-spinners";
import MainLayout from "../Layouts/MainLayout.vue";
import SlideOverNewProject from "../Components/Tailwindui/SlideOverNewProject.vue";

const page = usePage();

let loading = computed(() => store.state.general.loadingProjects);

const userProjects = computed(() => store.state.general.projects);

function getInitials(text, max=2) {
    console.log(text);
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
    if (!projectLabel.length || projectLabel.toString().toLowerCase() === "white") return "bg-gray-100";

    return "bg-" + projectLabel.toString().toLowerCase() + "-400";
}

function selectProject(project) {
    store.commit("general/selectProject", project);
}

onMounted(() => {
    store.commit("general/setUser", page.props.value.context.user);
});
</script>

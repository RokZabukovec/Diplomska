<script setup>

import EmptyProject from "../../Components/Tailwindui/EmptyProject.vue";
import SlideOverNewProject from "../../Components/Tailwindui/SlideOverNewProject.vue";
import { HollowDotsSpinner } from "epic-spinners";
import { Link } from "@inertiajs/inertia-vue3";

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
    projects: Array,
    loading: Boolean
});

</script>

<template>
    <div>
        <div class="flex justify-between border-b border-gray-200 pb-1">
            <SlideOverNewProject></SlideOverNewProject>
        </div>
        <div v-show="$props.loading">
            <div class="pt-5">
                <hollow-dots-spinner class="container mx-auto mt-5" :animation-duration="1000" :dot-size="15" :dots-num="3" color="#9400ff" />
            </div>
        </div>
        <ul v-if="$props.projects.length && !$props.loading" role="list" class="divide-y divide-gray-100">
            <li v-for="project in $props.projects" :key="project.name" class="flex items-center justify-between gap-x-6 py-5">
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
        <div v-else class="mt-6">
            <EmptyProject/>
        </div>
    </div>
</template>

<style scoped>

</style>

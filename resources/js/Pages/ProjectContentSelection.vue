<template>
    <MainLayout>
        <div class="flex justify-between border-b border-gray-200 pb-1">
            <h3 class="text-lg font-medium leading-6 text-gray-900"><span :class="getLabelColor(props.project.label_color)" class="rounded-lg text-white mr-2 px-2 py-1">{{props.project.name}}</span> Commands</h3>
            <div class="flex">
                <SlideOverNewCommand :project="props.project"></SlideOverNewCommand>
                <ProjectEditMenu :project="props.project"></ProjectEditMenu>
            </div>
        </div>
        <div v-if="loading" class="w-1/2 pt-5">
            <hollow-dots-spinner class="container mx-auto mt-5" :animation-duration="1000" :dot-size="20" :dots-num="5" color="#9400ff" />
        </div>
        <div v-show="!loading" class="inset-0">
            <div class="topbar flex justify-between mt-5">
                <div class="relative mt-1 flex items-center">
                    <input id="search" placeholder="Search" type="text" name="search" class="block w-full rounded-md border-gray-300 pr-12 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                    <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                        <kbd class="inline-flex items-center rounded border border-gray-200 px-2 font-sans text-sm font-medium text-gray-400">ctrl + F</kbd>
                    </div>
                </div>
            </div>
            <div class="flex">
                <CommandList></CommandList>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import SlideOverNewCommand from "@/Components/Tailwindui/SlideOverNewCommand.vue";
import CommandList from "@/Components/Tailwindui/CommandList.vue";
import ProjectEditMenu from "@/Components/Tailwindui/ProjectEditMenu.vue";
import { HollowDotsSpinner } from "epic-spinners";
import { computed, onMounted } from "vue";
import { useStore } from "vuex";
import MainLayout from "../Layouts/MainLayout.vue";

let store = useStore();
let props = defineProps({
    project: {
        type: Object,
        default: null,
    },
});

function getLabelColor(projectLabel){
    if (!projectLabel.length || projectLabel.toString().toLowerCase() === "white") return "bg-gray-100";

    return "bg-" + projectLabel.toString().toLowerCase() + "-400";
}

let loading = computed(() => store.state.general.loading);
function mainSearchFocus() {
    const input = document.querySelector('#search');
    if(input === null) return;

    document.addEventListener('keydown', (event) => {
        event.preventDefault();
        if (event.ctrlKey && event.key === 'f') {
            input.focus();
        }
    });
}

onMounted(() => {
    store.commit("general/selectProject", props.project);
    store.commit("commands/getCommands", { project: props.project.id, page: 1 });
    mainSearchFocus();
});
</script>

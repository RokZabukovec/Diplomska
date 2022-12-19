<template>
    <div>
        <div v-if="loading" class="w-1/2 pt-5">
            <hollow-dots-spinner class="container mx-auto mt-5" :animation-duration="1000" :dot-size="20" :dots-num="5" color="#9400ff" />
        </div>
        <div v-show="!loading" class="inset-0 py-6 px-1 sm:px-2 lg:px-8">
            <div class="topbar flex justify-between mb-5">
                <button>
                    <div>
                        <div class="relative mt-1 flex items-center">
                            <input id="search" placeholder="Search" type="text" name="search" class="block w-full rounded-md border-gray-300 pr-12 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                                <kbd class="inline-flex items-center rounded border border-gray-200 px-2 font-sans text-sm font-medium text-gray-400">⌘K</kbd>
                            </div>
                        </div>
                    </div>
                </button>
                <SlideOverNewCommand :project="props.project"></SlideOverNewCommand>
            </div>
            <div class="flex">
                <CommandList></CommandList>
            </div>
        </div>
    </div>
</template>

<script setup>
import SlideOverNewCommand from "@/Components/Tailwindui/SlideOverNewCommand.vue";
import CommandList from "@/Components/Tailwindui/CommandList.vue";
import { HollowDotsSpinner } from "epic-spinners";
import { computed, onMounted } from "vue";
import { useStore } from "vuex";

let store = useStore();
let props = defineProps({
    project: {
        type: Object,
        default: null,
    },
});

let loading = computed(() => store.state.general.loading);

onMounted(() => {
    console.log("Loading");
    store.commit("general/selectProject", props.project);
    store.commit("commands/getCommands", { project: props.project.id, page: 1 });
});
</script>

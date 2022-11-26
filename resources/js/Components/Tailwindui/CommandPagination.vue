<template>
    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
        <div class="flex flex-1 justify-between sm:hidden">
            <a href="#" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
            <a href="#" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    {{ " " }}
                    <span class="font-medium">{{ pagination.from }}</span>
                    {{ " " }}
                    to
                    {{ " " }}
                    <span class="font-medium">{{ pagination.to }}</span>
                    {{ " " }}
                    of
                    {{ " " }}
                    <span class="font-medium">{{ pagination.total }}</span>
                    {{ " " }}
                    results
                </p>
            </div>
            <div>
                <nav class="isolate inline-flex space-x-px" aria-label="Pagination">
                    <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                    <a v-for="link in pagination.links" :key="link.label" href="#" aria-current="page" :class="{ 'border-indigo-500 bg-indigo-50': link.active }" class="rounded relative z-10 inline-flex items-center border px-4 py-2 text-sm font-medium text-indigo-600 focus:z-20" @click="getCommands(link.label)" v-html="link.label"></a>
                </nav>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/20/solid";
import { computed, onMounted } from "vue";
import { useStore } from "vuex";

let store = useStore();

let projectId = computed(() => store.state.general.selectedProject.id);

const getCommands = (page) => {
    const payload = {
        project: projectId.value,
        page: page,
    };
    store.commit("commands/getCommands", payload);
};

let pagination = computed(() => store.state.commands.pagination);
</script>

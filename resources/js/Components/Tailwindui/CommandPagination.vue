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
            <div v-if="pagination.last_page > 1">
                <nav class="isolate inline-flex space-x-px" aria-label="Pagination">
                    <a v-for="link in links" :key="link.label" href="#" aria-current="page" :class="{ 'border-indigo-500 bg-indigo-50': link.active }" class="rounded relative z-10 inline-flex items-center border px-4 py-2 text-sm font-medium text-indigo-600 focus:z-20" @click="getCommands(link.url)" v-html="link.label"></a>
                </nav>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";
import { useStore } from "vuex";

let store = useStore();

let projectId = computed(() => store.state.general.selectedProject.id);
let pagination = computed(() => store.state.commands.pagination);
let links = computed(() => pagination.value.links.filter((link) => link.url != null));

const getCommands = (url) => {
    const urlParsed = new URL(url);
    const searchParams = urlParsed.searchParams;

    const page = searchParams.get("page");
    if (projectId) {
        const payload = {
            project: projectId.value,
            page: page ?? 1,
        };
        store.commit("commands/getCommands", payload);
    }
};
</script>

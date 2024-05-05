<template>
    <div class="flex flex-col min-h-screen">
        <TestNavbar></TestNavbar>
        <nav>
            <div class="items-center flex w-full p-8 bg-white justify-between mt-5">
                <div v-if="page.component.value === 'Search'" class="flex flex-grow justify-center sm:text-lg text-gray-400 ">
                    <div class="pl-4 p-1 relative flex items-center w-1/3 rounded-md border-0 shadow-sm ring-1 ring-inset ring-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                        <input id="search"
                            v-model="q"
                            type="search"
                            placeholder="Search something"
                            class="py-2 block w-full border-0 pl-2 pr-0 placeholder:text-gray-400 focus:outline-none focus:ring-0 focus:ring-opacity-0 text-lg focus:ring-inset focus:ring-transparent  sm:leading-6"
                            @input="triggerSearch"/>
                    </div>
                    <div class="relative flex items-center ml-2">
                        <select id="location" v-model="selectedType" name="location" class="text-lg focus:outline-none focus:ring-2 focus:ring-inset focus:ring-pink-600  text-gray-400 h-full block w-full rounded-md border-0 py-1.5 pl-3 pr-10 ring-1 shadow ring-inset ring-gray-300 sm:text-sm sm:leading-6" @change="setType">
                            <option value="projects">Projects</option>
                            <option value="commands">Commands</option>
                            <option value="team_members">Team members</option>
                        </select>
                    </div>
                </div>
            </div>
        </nav>
        <main class="mt-5 mx-auto w-3/4 flex-grow">
            <slot></slot>
        </main>
    </div>
</template>

<script setup>
import { onMounted, ref, watch } from "vue";
import _ from "lodash";
import { useStore } from "vuex";
import TestNavbar from "../Components/TestNavbar.vue";
import { usePage } from "@inertiajs/inertia-vue3";

let store = useStore();
let page = usePage();

let q = ref("");
let selectedType = ref("projects");

function setType() {
    store.commit("search/resetPage");
    store.commit("search/type", selectedType.value);
    store.commit("search/search");
}

function setQuery(newQuery) {
    store.commit('search/setQuery', newQuery);
}

onMounted(() => {
    store.commit("search/search");
});

const debouncedSearch = _.debounce(search, 500);

function triggerSearch(event) {
    store.commit("search/resetPage");
    setQuery(event.target.value);
    debouncedSearch();
}

function search() {
    store.commit("search/search");
}

// Watch for changes to the type property in the Vuex store
watch(() => store.state.search.type, (newValue) => {
    selectedType.value = newValue;
});
</script>


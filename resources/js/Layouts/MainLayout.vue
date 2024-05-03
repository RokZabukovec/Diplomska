<template>
    <div class="flex flex-col min-h-screen">
        <nav>
            <div class="items-center flex w-full p-8 bg-white justify-between shadow-md">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50" height="50">
                        <!-- Black rounded square background -->
                        <rect x="0" y="0" width="50" height="50" rx="5" ry="5" fill="black"></rect>
                        <!-- White letter C with Helvetica font -->
                        <text x="8" y="35" font-family="Helvetica, Arial, sans-serif" font-size="30" fill="white">C</text>
                        <!-- Blinking Pipe with Courier New font -->
                        <text x="26" y="32" font-family="Courier New, monospace" font-size="33" fill="white" font-weight="bold">
                            <animate attributeName="opacity" dur="1s" repeatCount="indefinite" values="0;1;0"></animate>
                            |
                        </text>
                    </svg>
                </div>
                <div class="flex flex-grow justify-center sm:text-lg text-gray-400 ">
                    <div class="pl-4 p-1 relative flex items-center w-1/3 rounded-md border-0 shadow-sm ring-1 ring-inset ring-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                        <input
id="search"
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
                <div>
                    <Link class="p-2 text-xs font-bold float-right text-pink-600" @click.prevent="Inertia.post(route('logout'))">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                        </svg>
                    </Link>
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
import { Inertia } from "@inertiajs/inertia";
import _ from "lodash";
import { Link } from "@inertiajs/inertia-vue3";
import { useStore } from "vuex";
import { route } from "ziggy-js";

let store = useStore();
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


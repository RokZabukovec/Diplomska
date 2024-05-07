<template>
    <div class="flex flex-col min-h-screen">
        <TestNavbar></TestNavbar>
        <nav v-if="page.component.value === 'Search'" >
            <div class="items-center flex w-full p-8 bg-white justify-between mt-5">
                <div class="flex flex-grow justify-center sm:text-lg text-gray-400 ">
                    <div class="pl-4 p-1 relative flex items-center w-1/3 rounded-md border-0 shadow-sm ring-1 ring-inset ring-gray-300">
                        <lord-icon
                            src="https://cdn.lordicon.com/unukghxb.json"
                            trigger="loop"
                            stroke="bold"
                            state="loop-spin"
                            colors="primary:#4f46e5,secondary:#4f46e5"
                            style="width:2rem;height:2rem">
                        </lord-icon>
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


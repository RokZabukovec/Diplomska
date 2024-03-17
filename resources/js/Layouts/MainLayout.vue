<template>
    <div class="flex flex-col min-h-screen">
        <nav>
            <div class="items-center flex w-full p-8 bg-white justify-between shadow-md">
                <div>
                    <svg viewBox="0 0 127 74" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 75px; padding-top: 11px; padding-bottom: 11px; margin-left: 13px;"><title>Meilisearch</title><path d="M.825 73.993l23.244-59.47A21.85 21.85 0 0144.42.625h14.014L35.19 60.096a21.85 21.85 0 01-20.352 13.897H.825z" fill="url(#meilisearch_logo_svg__paint0_linear_0_6)"></path><path d="M34.925 73.993l23.243-59.47A21.85 21.85 0 0178.52.626h14.013L69.29 60.096a21.85 21.85 0 01-20.351 13.897H34.925z" fill="url(#meilisearch_logo_svg__paint1_linear_0_6)"></path><path d="M69.026 73.993l23.244-59.47A21.85 21.85 0 01112.621.626h14.014l-23.244 59.47a21.851 21.851 0 01-20.352 13.897H69.026z" fill="url(#meilisearch_logo_svg__paint2_linear_0_6)"></path><defs><linearGradient id="meilisearch_logo_svg__paint0_linear_0_6" x1="126.635" y1="-4.978" x2="0.825" y2="66.098" gradientUnits="userSpaceOnUse"><stop stop-color="#FF5CAA"></stop><stop offset="1" stop-color="#FF4E62"></stop></linearGradient><linearGradient id="meilisearch_logo_svg__paint1_linear_0_6" x1="126.635" y1="-4.978" x2="0.825" y2="66.098" gradientUnits="userSpaceOnUse"><stop stop-color="#FF5CAA"></stop><stop offset="1" stop-color="#FF4E62"></stop></linearGradient><linearGradient id="meilisearch_logo_svg__paint2_linear_0_6" x1="126.635" y1="-4.978" x2="0.825" y2="66.098" gradientUnits="userSpaceOnUse"><stop stop-color="#FF5CAA"></stop><stop offset="1" stop-color="#FF4E62"></stop></linearGradient></defs></svg>
                </div>
                <div class="flex flex-grow justify-center sm:text-lg text-gray-400 ">
                    <div class="pl-4 p-1 relative flex items-center w-1/3 rounded-md border-0 shadow-sm ring-1 ring-inset ring-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                        <input type="search" placeholder="Search something" id="search" class="py-2 block w-full border-0 pl-2 pr-0 placeholder:text-gray-400 focus:outline-none focus:ring-0 focus:ring-opacity-0 text-lg focus:ring-inset focus:ring-transparent  sm:leading-6">
                    </div>
                    <div class="relative flex items-center ml-2">
                        <select id="location" name="location" class="text-lg focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-600  text-gray-400 h-full block w-full rounded-md border-0 py-1.5 pl-3 pr-10 ring-1 shadow ring-inset ring-gray-300 sm:text-sm sm:leading-6">
                            <option selected>Projects</option>
                            <option>Commands</option>
                            <option>Team members</option>
                        </select>
                    </div>
                </div>
                <div>
                    <Link @click.prevent="Inertia.post(route('logout'))" class="p-2 text-xs font-bold float-right text-pink-600">
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
import { Popover, PopoverButton, PopoverOverlay, PopoverPanel, TransitionChild, TransitionRoot } from "@headlessui/vue";
import { BellIcon, XMarkIcon } from "@heroicons/vue/24/outline";
import { MagnifyingGlassIcon } from "@heroicons/vue/20/solid";
import { computed, onMounted, ref } from "vue";
import store from "../Store/store.js";
import { Inertia } from "@inertiajs/inertia";
import _ from "lodash";
import axios from "axios";
import {Link} from "@inertiajs/inertia-vue3";
import { HomeModernIcon } from '@heroicons/vue/20/solid'
import { UserIcon } from '@heroicons/vue/20/solid'
import { GlobeAltIcon } from '@heroicons/vue/20/solid'
import { UserGroupIcon } from '@heroicons/vue/20/solid'

let q = ref("");
const user = {
    name: "Tom Cook",
    email: "tom@example.com",
    imageUrl: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
};

function logout() {
    Inertia.post("/logout");
}

const props = defineProps({
    context: {
        type: Object,
        default: null,
    },
});

const projects = computed(() => store.state.general.projects);
const teams = computed(() => store.state.general.teams);

const sidebarOpen = ref(false);

// lifecycle
onMounted(() => {
    store.commit("general/getProjects");
    store.commit("general/getTeams");
});

function mainSearchFocus() {
    const input = document.querySelector('#search');
    if(input === null) return;

    document.addEventListener('keydown', (event) => {
        if (event.ctrlKey && event.key === 'f') {
            event.preventDefault();
            input.focus();
        }
    });
}

onMounted(() => {
    mainSearchFocus();
});

function search() {
    axios
        .get("/api/search?q=" + q.value)
        .then((response) => {
            store.commit("commands/setCommands", response);
        })
        .catch((err) => {
            console.log(err);
        });
}

_.debounce(() => {
    search();
}, 2000);
</script>

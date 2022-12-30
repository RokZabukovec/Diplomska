<template>
    <div class="min-h-full">
        <Popover v-slot="{ open }" as="header" class="bg-indigo-600 pb-24">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                <div class="hidden py-5 lg:block">
                    <div class="flex items-center justify-between">
                        <div class="col-span-2">
                            <nav class="flex space-x-4 hidden lg:inline-flex">
                                <Link :href="route('projects')"  class="p-2 text-xs font-bold">
                                    <button type="button" :class="{ 'bg-slate-700': $page.url.startsWith('/dashboard') }" class="hidden w-full lg:flex items-center text-sm leading-6 text-indigo-100 rounded-md ring-1 ring-slate-900/10 shadow-sm py-1.5 pl-2 pr-3 bg-indigo-400 dark:highlight-white/5 transition-colors">
                                        <HomeModernIcon v-if="$page.url.startsWith('/dashboard')" class="-ml-0.5 mr-2 h-4 w-4 fill-amber-500 hover:fill-amber-200" aria-hidden="true" />
                                        Home
                                    </button>
                                </Link>
                                <Link :href="route('profile.show')"  class="rounded p-2 font-bold text-xs font-medium">
                                    <button type="button" :class="{ 'bg-slate-700': $page.url.startsWith('/user/profile') }" class="hidden w-full lg:flex items-center text-sm leading-6 text-white rounded-md ring-slate-900/10 py-1.5 pl-2 pr-3 bg-transparent hover:bg-indigo-400 transition-colors">
                                        Profile
                                    </button>
                                </Link>
                                <Link :href="route('api-tokens.index')"  class="rounded p-2 text-xs font-bold">
                                    <button type="button" :class="{ 'bg-slate-700': $page.url.startsWith('/user/api-tokens') }" class="hidden w-full lg:flex items-center text-sm leading-6 text-white rounded-md ring-slate-900/10 py-1.5 pl-2 pr-3 bg-transparent hover:bg-indigo-400 transition-colors">
                                        API tokens
                                    </button>
                                </Link>
                                <Link :href="route('teams.show', $page.props.user.current_team_id)"  class="rounded p-2 text-xs font-bold">
                                    <button type="button" :class="{ 'bg-slate-700': $page.url.startsWith('/teams') }" class="hidden w-full lg:flex items-center text-sm leading-6 text-white rounded-md ring-slate-900/10 py-1.5 pl-2 pr-3 bg-transparent hover:bg-indigo-400 transition-colors">
                                        Team
                                    </button>
                                </Link>

                                <Link @click.prevent="Inertia.post(route('logout'))" class="p-2 text-xs font-bold float-right">
                                    <button type="button" :class="{ 'bg-slate-700': $page.url.startsWith('/logout') }"  class="hidden w-full lg:flex items-center text-sm leading-6 text-white rounded-md ring-slate-900/10 py-1.5 pl-2 pr-3 bg-transparent hover:bg-indigo-400 transition-colors">
                                        Logout
                                    </button>
                                </Link>
                            </nav>
                        </div>
                        <div>
                            <div class="max-w-md">
                                <label for="mobile-search" class="sr-only">Search</label>
                                <div class="relative text-white focus-within:text-gray-600">
                                    <Link :href="route('search.show')" class="p-2 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        <div class="sticky top-0 -ml-0.5 pointer-events-none">
                                            <div class="bg-white bg-indigo-600 relative pointer-events-auto">
                                                <button type="button" class="hidden w-full lg:flex items-center text-sm leading-6 text-indigo-100 rounded-md ring-1 ring-slate-900/10 shadow-sm py-1.5 pl-2 pr-3 bg-indigo-400 dark:highlight-white/5 dark:hover:bg-slate-700 transition-colors">
                                                    <MagnifyingGlassIcon class="-ml-0.5 mr-2 h-4 w-4 fill-amber-500 hover:fill-amber-200" aria-hidden="true" />
                                                    Quick search...
                                                </button>
                                            </div>
                                        </div>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <TransitionRoot as="template" :show="open">
                <div class="lg:hidden">
                    <TransitionChild as="template" enter="duration-150 ease-out" enter-from="opacity-0" enter-to="opacity-100" leave="duration-150 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                        <PopoverOverlay class="fixed inset-0 z-20 bg-black bg-opacity-25" />
                    </TransitionChild>

                    <TransitionChild as="template" enter="duration-150 ease-out" enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100" leave="duration-150 ease-in" leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
                        <PopoverPanel focus class="absolute inset-x-0 top-0 z-30 mx-auto w-full max-w-3xl origin-top transform p-2 transition">
                            <div class="divide-y divide-gray-200 rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
                                <div class="pt-3 pb-2">
                                    <div class="flex items-center justify-between px-4">
                                        <div>
                                            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company" />
                                        </div>
                                        <div class="-mr-2">
                                            <PopoverButton class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                                <span class="sr-only">Close menu</span>
                                                <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                                            </PopoverButton>
                                        </div>
                                    </div>
                                    <div class="mt-3 space-y-1 px-2"></div>
                                </div>
                                <div class="pt-4 pb-2">
                                    <div class="flex items-center px-5">
                                        <div class="flex-shrink-0">
                                            <img class="h-10 w-10 rounded-full" :src="user.imageUrl" alt="" />
                                        </div>
                                        <div class="ml-3 min-w-0 flex-1">
                                            <div class="truncate text-base font-medium text-gray-800">{{ user.name }}</div>
                                            <div class="truncate text-sm font-medium text-gray-500">{{ user.email }}</div>
                                        </div>
                                        <button type="button" class="ml-auto flex-shrink-0 rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                            <span class="sr-only">View notifications</span>
                                            <BellIcon class="h-6 w-6" aria-hidden="true" />
                                        </button>
                                    </div>
                                    <div class="mt-3 space-y-1 px-2">
                                        <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-900 hover:bg-gray-100 hover:text-gray-800" @click.prevent="logout()">Sign out</a>
                                    </div>
                                </div>
                            </div>
                        </PopoverPanel>
                    </TransitionChild>
                </div>
            </TransitionRoot>
        </Popover>
        <main class="-mt-24 pb-8">
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                <h1 class="sr-only">Dashboard</h1>
                <div class="flex flex-col md:flex-row mt-6 md:mt-0">
                    <div class="w-full md:w-3/4 mb-2">
                        <section aria-labelledby="section-1-title">
                        <h2 id="section-1-title" class="sr-only">Layout left</h2>
                        <div class="overflow-hidden rounded-lg bg-white shadow min-h-screen mr-0 md:mr-2">
                            <div class="p-6"><slot></slot></div>
                        </div>
                        </section>
                    </div>
                    <div class="w-full md:w-1/4">
                        <section aria-labelledby="section-2-title">
                            <h2 id="section-2-title" class="sr-only">Layout right</h2>
                            <slot name="sidebar"></slot>
                        </section>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                <div class="border-t border-gray-200 py-8 text-center text-sm text-gray-500 sm:text-left"><span class="block sm:inline">&copy; 2022 Brain Wallet.</span> <span class="block sm:inline">All rights reserved.</span></div>
            </div>
        </footer>
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
        event.preventDefault();
        if (event.ctrlKey && event.key === 'f') {
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

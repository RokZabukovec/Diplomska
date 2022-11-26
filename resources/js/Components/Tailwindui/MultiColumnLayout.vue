<template>
    <div class="min-h-full">
        <TransitionRoot :show="sidebarOpen" as="template">
            <Dialog as="div" class="relative z-40 lg:hidden" @close="sidebarOpen = false">
                <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-600 bg-opacity-75" />
                </TransitionChild>

                <div class="fixed inset-0 z-40 flex">
                    <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
                        <DialogPanel class="relative flex w-full max-w-xs flex-1 flex-col bg-white pt-5 pb-4">
                            <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100" leave-to="opacity-0">
                                <div class="absolute top-0 right-0 -mr-12 pt-2">
                                    <button class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" type="button" @click="sidebarOpen = false">
                                        <span class="sr-only">Close sidebar</span>
                                        <XMarkIcon aria-hidden="true" class="h-6 w-6 text-white" />
                                    </button>
                                </div>
                            </TransitionChild>
                            <div class="flex flex-shrink-0 items-center px-4">
                                <img alt="Your Company" class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=purple&shade=500" />
                            </div>
                            <div class="mt-5 h-0 flex-1 overflow-y-auto">
                                <nav class="px-2">
                                    <div class="space-y-1 text-red-500">
                                        <a v-for="item in navigation" :key="item.name" :aria-current="item.current ? 'page' : undefined" :class="[item.current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50', 'group flex items-center px-2 py-2 text-base leading-5 font-medium rounded-md']" :href="item.href">
                                            <component :is="item.icon" :class="[item.current ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500', 'mr-3 flex-shrink-0 h-6 w-6']" aria-hidden="true" />
                                            {{ item.name }}
                                        </a>
                                    </div>
                                    <div class="mt-8">
                                        <h3 id="mobile-teams-headline" class="px-3 text-sm font-medium text-gray-500">Teams</h3>
                                        <div aria-labelledby="mobile-teams-headline" class="mt-1 space-y-1" role="group">
                                            <a href="#" v-for="team in teams" :key="team.id" @click.prevent="switchToTeam(team)" class="group flex items-center rounded-md px-3 py-2 text-base font-medium leading-5 text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                                                <span class="truncate">{{ team.name }}</span>
                                            </a>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                    <div aria-hidden="true" class="w-14 flex-shrink-0">
                        <!-- Dummy element to force sidebar to shrink to fit close icon -->
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>

        <!-- Static sidebar for desktop -->
        <div class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col lg:border-r lg:border-gray-200 lg:bg-gray-100 lg:pt-5 lg:pb-4">
            <div class="flex flex-shrink-0 items-center px-6">
                <img alt="Your Company" class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=purple&shade=500" />
            </div>
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="mt-8 flex h-0 flex-1 flex-col overflow-y-auto">
                <!-- User account dropdown -->
                <Menu as="div" class="relative inline-block px-3 text-left">
                    <div>
                        <MenuButton class="group w-full rounded-md bg-gray-100 px-3.5 py-2 text-left text-sm font-medium text-gray-700 mt-5 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-100">
                            <span class="flex w-full items-center justify-between">
                                <span class="flex min-w-0 items-center justify-between space-x-3">
                                    <img alt="" class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300" :src="props.page.user.profile_photo_url" />
                                    <span class="flex min-w-0 flex-1 flex-col">
                                        <span class="truncate text-sm font-medium text-gray-900">{{ props.page.user.name }}</span>
                                    </span>
                                </span>
                                <ChevronUpDownIcon aria-hidden="true" class="h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" />
                            </span>
                        </MenuButton>
                    </div>
                    <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                        <MenuItems class="absolute right-0 left-0 z-10 mx-3 mt-1 origin-top divide-y divide-gray-200 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                            <div class="py-1">
                                <MenuItem v-slot="{ active }">
                                    <a :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']" :href="route('profile.show')">Settings</a>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                    <a :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']" :href="route('api-tokens.index')">API tokens</a>
                                </MenuItem>
                            </div>
                            <div class="py-1">
                                <MenuItem v-slot="{ active }">
                                    <a :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']" :href="route('teams.create')">Create team</a>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                    <a :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']" href="#">Support</a>
                                </MenuItem>
                            </div>
                            <div class="py-1">
                                <MenuItem v-slot="{ active }">
                                    <a :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']" href="#" @click.prevent="logout()">Logout</a>
                                </MenuItem>
                            </div>
                        </MenuItems>
                    </transition>
                </Menu>
                <!-- Sidebar Search -->
                <div class="mt-5 px-3">
                    <label class="sr-only" for="search">Search</label>
                    <div class="relative mt-1 rounded-md shadow-sm">
                        <div aria-hidden="true" class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <MagnifyingGlassIcon aria-hidden="true" class="mr-3 h-4 w-4 text-gray-400" />
                        </div>
                        <input id="search" class="block w-full rounded-md border-gray-300 pl-9 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="search" placeholder="Search" type="text" @click="toggleSpotlight(true)" />
                        <Spotlight :open="spotlightOpen"></Spotlight>
                    </div>
                </div>
                <!-- Navigation -->
                <nav class="mt-6 px-3">
                    <div class="space-y-1">
                        <RouterLink v-for="item in navigation" :key="item.name" :to="item.href" :aria-current="item.current ? 'page' : undefined" :class="[item.current ? 'bg-gray-200 text-gray-900' : 'text-gray-700 hover:text-gray-900 hover:bg-gray-50', 'group flex items-center px-2 py-2 text-sm font-medium rounded-md']">{{ item.name }} </RouterLink>
                    </div>
                    <div class="mt-8">
                        <!-- Secondary navigation -->
                        <h3 id="desktop-teams-headline" class="px-3 text-sm font-medium text-gray-500">Teams</h3>
                        <div aria-labelledby="desktop-teams-headline" class="mt-1 space-y-1" role="group">
                            <a v-for="team in props.page.user.all_teams" :key="team.name" href="#" @click.prevent="switchToTeam(team)" class="relative group flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">
                                <span v-if="team.id === props.page.user.current_team_id" class="absolute bg-green-500 top-0 left-0 h-full w-1"></span>
                                <span :class="[team.bgColorClass, 'w-2.5 h-2.5 mr-4 rounded-full']" aria-hidden="true" />
                                <span class="truncate">{{ team.name }}</span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Main column -->
        <div class="flex flex-col lg:pl-64 min-h-screen">
            <!-- Search header -->
            <div class="sticky top-0 z-10 flex h-16 flex-shrink-0 border-b border-gray-200 bg-white lg:hidden">
                <button class="border-r border-gray-200 px-4 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-purple-500 lg:hidden" type="button" @click="sidebarOpen = true">
                    <span class="sr-only">Open sidebar</span>
                    <Bars3CenterLeftIcon aria-hidden="true" class="h-6 w-6" />
                </button>
                <div class="flex flex-1 justify-between px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-1">
                        <form action="#" class="flex w-full md:ml-0" method="GET">
                            <label class="sr-only" for="search-field">Search</label>
                            <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center">
                                    <MagnifyingGlassIcon aria-hidden="true" class="h-5 w-5" />
                                </div>
                                <input id="search-field" class="block h-full w-full border-transparent py-2 pl-8 pr-3 text-gray-900 placeholder-gray-500 focus:border-transparent focus:placeholder-gray-400 focus:outline-none focus:ring-0 sm:text-sm" name="search-field" placeholder="Search" type="search" />
                            </div>
                        </form>
                    </div>
                    <div class="flex items-center">
                        <!-- Profile dropdown -->
                        <Menu as="div" class="relative ml-3">
                            <div>
                                <MenuButton class="flex max-w-xs items-center rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                                    <span class="sr-only">Open user menu</span>
                                    <img alt="" class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1502685104226-ee32379fefbe?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" />
                                </MenuButton>
                            </div>
                            <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                                <MenuItems class="absolute right-0 z-10 mt-2 w-48 origin-top-right divide-y divide-gray-200 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <div class="py-1">
                                        <MenuItem v-slot="{ active }">
                                            <a :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']" href="#">View profile</a>
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                            <a :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']" href="#">Settings</a>
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                            <a :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']" href="#">Notifications</a>
                                        </MenuItem>
                                    </div>
                                    <div class="py-1">
                                        <MenuItem v-slot="{ active }">
                                            <a :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']" href="#">Get desktop app</a>
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                            <a :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']" href="#">Support</a>
                                        </MenuItem>
                                    </div>
                                    <div class="py-1">
                                        <MenuItem v-slot="{ active }">
                                            <a :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']" href="#" @click.prevent="logout()">Logout</a>
                                        </MenuItem>
                                    </div>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>
            </div>
            <main class="flex-1">
                <!-- Page title & actions -->
                <div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
                    <div class="min-w-0 flex-1">
                        <router-link to="/">
                            <button type="button" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <HomeIcon class="h-4 w-4 text-white" />
                                Home
                            </button>
                        </router-link>
                    </div>
                    <div class="mt-4 flex sm:mt-0 sm:ml-4">
                        <SlideOverNewProject></SlideOverNewProject>
                    </div>
                </div>

                <!-- Projects list (only on smallest breakpoint) -->
                <div class="mt-10 sm:hidden">
                    <div class="px-4 sm:px-6">
                        <h2 class="text-sm font-medium text-gray-900">Projects</h2>
                    </div>
                    <ul class="mt-3 divide-y divide-gray-100 border-t border-gray-200" role="list">
                        <li v-for="project in projects" :key="project.id">
                            <a class="group flex items-center justify-between px-4 py-4 hover:bg-gray-50 sm:px-6" href="#">
                                <span class="flex items-center space-x-3 truncate">
                                    <span :class="[project.label_color, 'w-2.5 h-2.5 flex-shrink-0 rounded-full']" aria-hidden="true" />
                                    <span class="truncate text-sm font-medium leading-6">
                                        {{ project.name }}
                                    </span>
                                </span>
                                <ChevronRightIcon aria-hidden="true" class="ml-4 h-5 w-5 text-gray-400 group-hover:text-gray-500" />
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Projects table (small breakpoint and up) -->
                <router-view></router-view>
            </main>
        </div>
    </div>
</template>

<script setup>
import moment from "moment";
import { Inertia } from "@inertiajs/inertia";
import Spotlight from "./Spotlight.vue";

import { computed, onMounted, ref } from "vue";
import { Dialog, DialogPanel, Menu, MenuButton, MenuItem, MenuItems, TransitionChild, TransitionRoot } from "@headlessui/vue";
import { Bars3CenterLeftIcon, Bars4Icon, HomeIcon, XMarkIcon } from "@heroicons/vue/24/outline";
import { ChevronRightIcon, ChevronUpDownIcon, MagnifyingGlassIcon } from "@heroicons/vue/20/solid";
import store from "../../Store/store.js";
import SlideOverNewProject from "./SlideOverNewProject.vue";

let spotlightOpen = ref(false);

const navigation = [{ name: "Home", href: "/", icon: HomeIcon, current: true }];

const props = defineProps({
    page: {
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
    store.commit("general/setUser", props.page.user);
});

function logout() {
    Inertia.post(route("logout"));
}

function switchToTeam(team) {
    store.commit("general/switchTeam", team.id);
    window.location.reload();
}

function toggleSpotlight(value) {
    spotlightOpen.value = value;
}
</script>

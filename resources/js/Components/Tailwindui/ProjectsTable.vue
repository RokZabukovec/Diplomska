<template>
    <div>
        <div class="mt-6 px-4 sm:px-6 lg:px-8" v-if="pined.length">
            <h2 class="text-sm font-medium text-gray-900">Pinned Projects</h2>
            <ul
                role="list"
                class="mt-3 grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-6 xl:grid-cols-4"
            >
                <li
                    v-for="project in pined"
                    :key="project.id"
                    class="relative col-span-1 flex rounded-md shadow-sm"
                >
                    <div
                        :class="[
                            'bg-red-500',
                            'flex-shrink-0 flex items-center justify-center w-16 text-white text-sm font-medium rounded-l-md',
                        ]"
                    >
                        {{ project.initials }}
                    </div>
                    <div
                        class="flex flex-1 items-center justify-between truncate rounded-r-md border-t border-r border-b border-gray-200 bg-white"
                    >
                        <div class="flex-1 truncate px-4 py-2 text-sm">
                            <button
                                @click="selectProject(project)"
                                class="font-medium text-gray-900 hover:text-gray-600"
                                >{{ project.name }}</button>
                            
                            <p class="text-gray-500">
                                {{ moment(project.created_at).format("LL") }}
                            </p>
                        </div>
                        <Menu as="div" class="flex-shrink-0 pr-2">
                            <MenuButton
                                class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2"
                            >
                                <span class="sr-only">Open options</span>
                                <EllipsisVerticalIcon
                                    class="h-5 w-5"
                                    aria-hidden="true"
                                />
                            </MenuButton>
                            <transition
                                enter-active-class="transition ease-out duration-100"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95"
                            >
                                <MenuItems
                                    class="absolute right-10 top-3 z-10 mx-3 mt-1 w-48 origin-top-right divide-y divide-gray-200 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                >
                                    <div class="py-1">
                                        <MenuItem v-slot="{ active }">
                                            <a
                                                href="#"
                                                :class="[
                                                    active
                                                        ? 'bg-gray-100 text-gray-900'
                                                        : 'text-gray-700',
                                                    'block px-4 py-2 text-sm',
                                                ]"
                                                >View</a
                                            >
                                        </MenuItem>
                                    </div>
                                    <div class="py-1">
                                        <MenuItem v-slot="{ active }">
                                            <a
                                                @click.prevent="
                                                    pinProject(project)
                                                "
                                                href="#"
                                                :class="[
                                                    active
                                                        ? 'bg-gray-100 text-gray-900'
                                                        : 'text-gray-700',
                                                    'block px-4 py-2 text-sm',
                                                ]"
                                                >Removed from pinned</a
                                            >
                                        </MenuItem>
                                    </div>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Projects list (only on smallest breakpoint) -->
        <div class="mt-10 sm:hidden">
            <div class="px-4 sm:px-6">
                <h2 class="text-sm font-medium text-gray-900">Projects</h2>
            </div>
            <ul
                role="list"
                class="mt-3 divide-y divide-gray-100 border-t border-gray-200"
            >
                <li v-for="project in projects" :key="project.id">
                    <a
                        href="#"
                        class="group flex items-center justify-between px-4 py-4 hover:bg-gray-50 sm:px-6"
                    >
                        <span class="flex items-center space-x-3 truncate">
                            <span
                                :class="[
                                    project.label_color,
                                    'w-2.5 h-2.5 flex-shrink-0 rounded-full',
                                ]"
                                aria-hidden="true"
                            />
                            <span
                                class="truncate text-sm font-medium leading-6"
                                @click="selectProject(project)"
                            >
                                {{ project.name }}
                            </span>
                        </span>
                        <ChevronRightIcon
                            class="ml-4 h-5 w-5 text-gray-400 group-hover:text-gray-500"
                            aria-hidden="true"
                        />
                    </a>
                </li>
            </ul>
        </div>

        <!-- Projects table (small breakpoint and up) -->
        <div class="hidden sm:block">
            <div
                class="inline-block min-w-full border-b border-gray-200 align-middle"
            >
            <div v-for="user, id in userProjects" :key="id">
                <UserHeading :user="user"></UserHeading>
                <table class="min-w-full" >
                    <thead>
                        <tr class="border-t border-gray-200">
                            <th
                                class="border-b border-gray-200 bg-gray-50 px-6 py-3 text-left text-sm font-semibold text-gray-900"
                                scope="col"
                            >
                                <span class="lg:pl-2">Project</span>
                            </th>
                            <th
                                class="hidden border-b border-gray-200 bg-gray-50 px-6 py-3 text-right text-sm font-semibold text-gray-900 md:table-cell"
                                scope="col"
                            >
                                Last updated
                            </th>
                            <th
                                class="border-b border-gray-200 bg-gray-50 py-3 pr-6 text-right text-sm font-semibold text-gray-900"
                                scope="col"
                            />
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        <tr v-for="project in user.projects" :key="project.id">
                            <td
                                class="w-full max-w-0 whitespace-nowrap px-6 py-3 text-sm font-medium text-gray-900"
                            >
                                <div
                                    class="flex items-center space-x-3 lg:pl-2"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        :fill="
                                            project.pined
                                                ? 'currentColor'
                                                : 'none'
                                        "
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-5 h-5 cursor-pointer"
                                        @click="pinProject(project)"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z"
                                        />
                                    </svg>

                                    <div
                                        :class="[
                                            'flex-shrink-0 w-2.5 h-2.5 rounded-full',
                                        ]"
                                        aria-hidden="true"
                                    />
                                    <RouterLink
                                        :to="'/project/' + project.id"
                                        @click="selectProject(project)"
                                    >
                                        <span>
                                            {{ project.name }}
                                        </span>
                                    </RouterLink>
                                </div>
                            </td>
                            <td
                                class="hidden whitespace-nowrap px-6 py-3 text-right text-sm text-gray-500 md:table-cell"
                            >
                                {{ moment(project.updated_at).format("LLL") }}
                            </td>
                            <td
                                class="whitespace-nowrap px-6 py-3 text-right text-sm font-medium"
                            >
                                <ProjectEditMenu
                                    :project="project"
                                ></ProjectEditMenu>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";
import store from "../../Store/store";
import moment from "moment";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import {
    ChevronRightIcon,
    EllipsisVerticalIcon,
} from "@heroicons/vue/20/solid";
import ProjectEditMenu from "./ProjectEditMenu.vue";
import UserHeading from "./UserHeading.vue";

const userProjects = computed(() => store.state.general.projects);
const pined = computed(() => store.state.general.pined);

function selectProject(project) {
    store.commit("general/selectProject", project);
}
function pinProject(project) {
    project.initials = initials(project).toUpperCase();
    store.commit("projects/pinProject", project);
}

let initials = (project) => {
    let splitName = project.name.split(" ");

    if(splitName.length === 1){
        return splitName[0].slice(0, 2);
    }

    if(splitName.length >= 2) {
        return splitName[0].slice(0, 1) + splitName[1].slice(0, 1);
    }
};
</script>

<style scoped></style>

<template>
    <div>
        <!-- Projects list (only on smallest breakpoint) -->
        <div class="mt-10 sm:hidden">
            <div class="px-4 sm:px-6">
                <h2 class="text-sm font-medium text-gray-900">Projects</h2>
            </div>
            <ul role="list" class="mt-3 divide-y divide-gray-100 border-t border-gray-200">
                <li v-for="project in userProjects" :key="project.id">
                    <a href="#" class="group flex items-center justify-between px-4 py-4 hover:bg-gray-50 sm:px-6">
                        <span class="flex items-center space-x-3 truncate">
                            <span :class="[project.label_color, 'w-2.5 h-2.5 flex-shrink-0 rounded-full']" aria-hidden="true" />
                            <span class="truncate text-sm font-medium leading-6" @click="selectProject(project)">
                                {{ project.name }}
                            </span>
                        </span>
                        <ChevronRightIcon class="ml-4 h-5 w-5 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                    </a>
                </li>
            </ul>
        </div>

        <!-- Projects table (small breakpoint and up) -->
        <div class="hidden sm:block min-h-screen">
            <div class="inline-block min-w-full border-b border-gray-200 align-middle min-h-screen">
                <table v-if="userProjects.length" class="min-w-full">
                    <thead>
                        <tr class="border-t border-gray-200">
                            <th class="border-b border-gray-200 bg-gray-50 px-6 py-3 text-left text-sm font-semibold text-gray-900" scope="col">
                                <span class="lg:pl-2">Project</span>
                            </th>
                            <th class="hidden border-b border-gray-200 bg-gray-50 px-6 py-3 text-right text-sm font-semibold text-gray-900 md:table-cell" scope="col">Last updated</th>
                            <th class="border-b border-gray-200 bg-gray-50 py-3 pr-6 text-right text-sm font-semibold text-gray-900" scope="col" />
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        <tr v-for="project in userProjects" :key="project.id">
                            <td class="w-full max-w-0 whitespace-nowrap px-6 py-3 text-sm font-medium text-gray-900">
                                <div class="flex items-center space-x-3 lg:pl-2">
                                    <div :class="['flex-shrink-0 w-2.5 h-2.5 rounded-full']" aria-hidden="true" />
                                    <RouterLink :to="'/project/' + project.id" @click="selectProject(project)">
                                        <span>
                                            {{ project.name }}
                                        </span>
                                    </RouterLink>
                                </div>
                            </td>
                            <td class="hidden whitespace-nowrap px-6 py-3 text-right text-sm text-gray-500 md:table-cell">
                                {{ moment(project.updated_at).format("LLL") }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-3 text-right text-sm font-medium">
                                <ProjectEditMenu :project="project"></ProjectEditMenu>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-else class="mt-5 h-full">
                    <EmptyProject></EmptyProject>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";
import store from "../../Store/store";
import moment from "moment";
import { ChevronRightIcon } from "@heroicons/vue/20/solid";
import ProjectEditMenu from "./ProjectEditMenu.vue";
import EmptyProject from "./EmptyProject.vue";

const userProjects = computed(() => store.state.general.projects);

function selectProject(project) {
    store.commit("general/selectProject", project);
}
</script>

<style scoped></style>

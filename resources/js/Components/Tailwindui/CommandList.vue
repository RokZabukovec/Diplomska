<template>
    <div class="w-full mt-6">
        <div class="overflow-hidden bg-white shadow sm:rounded-md">
            <ul role="list" class="divide-y divide-gray-200 mt-6">
                <li v-for="command in commands" :key="command.id" class="command-list-item">
                    <div class="relative">
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between rounded bg-gray-100 command cursor-pointer transition-all">
                                <p class="p-2 w-full truncate text-sm font-medium text-indigo-600 overflow-x-auto" v-html="colorizeCommand(command.command)"></p>
                                <Link :href="route('command.edit', { id: command.id })" class="p-2 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 edit-link">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                    </svg>
                                </Link>
                            </div>
                            <div class="mt-2 sm:flex sm:justify-between">
                                <div class="sm:flex">
                                    <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                        {{ command.description }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex flex-shrink-0 mt-3">
                                <p v-for="tag in command.tags" :key="tag.id" class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">
                                    {{ tag.name.en }}
                                </p>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <CommandPagination :pagination="pagination"></CommandPagination>
        </div>
    </div>
</template>

<script setup>
import CommandPagination from "./CommandPagination.vue";
import { computed, onMounted } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

import searchStore from "../../Store/search.js";

let commands = computed(() => searchStore.state.commands);
let projectId = computed(() => searchStore.state.search.selected.project_id);

const isFile = (text) => /[^\\/]+\.[^\\/]+$/.test(text);
const isOperator = (text) => /^(\|{1,2})|(<{1,2})|(&{1,2})|(>{1,2})|{|\[|\]|\}/.test(text);
const isQuoted = (text) => /^(".+")|('.+')$/.test(text);

let colorizeCommand = (command) => {
    const cursorNode = document.createElement("span");
    cursorNode.className = "stylized-commands";

    const originalTextContent = command.split(" ");

    originalTextContent.forEach((text, index) => {
        const textNode = document.createElement("span");
        textNode.textContent = `${text} `;

        // If first word or first after a pipe, highlight as command
        if (index === 0 || isOperator(originalTextContent[index - 1])) {
            textNode.className = "command";
            textNode.className = "text-stone-800";
        }

        if (text.startsWith("--") || text.startsWith("-")) {
            textNode.className = "flag";
            textNode.className = "text-blue-500";
        }

        if (isOperator(text)) {
            textNode.className = "operator";
            textNode.className = "text-orange-600";
        }

        if (isFile(text)) {
            textNode.className = "file";
            textNode.className = "text-green-500";
        }

        if (isQuoted(text)) {
            textNode.className = "quoted";
            textNode.className = "text-grey-500";
        }
        return cursorNode.appendChild(textNode);
    });
    return cursorNode.outerHTML;
};

const getCommands = (pageNumber) => {
    let payload = {
        project: projectId.value ?? page.props.value.project.id,
        page: pageNumber,
    };
    store.commit("commands/getCommands", payload);
};

onMounted(() => {
    getCommands(1);
});
</script>

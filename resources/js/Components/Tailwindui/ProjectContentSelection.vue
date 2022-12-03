<template>
    <div>
        <div class="pt-5" v-show="loading">
            <hollow-dots-spinner class="container mx-auto mt-5" :animation-duration="1000" :dot-size="15" :dots-num="3" color="#9400ff" />
        </div>
        <div class="w-full inset-0 py-6 px-1 sm:px-2 lg:px-8" v-show="!loading">
            <div class="topbar flex justify-between mb-5">
                <button>
                    <div>
                        <div class="relative mt-1 flex items-center">
                            <input id="search" placeholder="Search" type="text" name="search" class="block w-full rounded-md border-gray-300 pr-12 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                                <kbd class="inline-flex items-center rounded border border-gray-200 px-2 font-sans text-sm font-medium text-gray-400">⌘K</kbd>
                            </div>
                        </div>
                    </div>
                </button>
                <SlideOverNewCommand></SlideOverNewCommand>
            </div>
            <div class="flex">
                <CommandList></CommandList>
                <TeamMembersFilter></TeamMembersFilter>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import { Tab, TabGroup, TabList, TabPanel, TabPanels } from "@headlessui/vue";
import SlideOverNewCommand from "./SlideOverNewCommand.vue";
import SlideOverNewPage from "./SlideOverNewPage.vue";
import store from "../../Store/store.js";
import CommandList from "./CommandList.vue";
import TeamMembersFilter from "./TeamMembersFilter.vue";
import { HollowDotsSpinner } from "epic-spinners";

let loading = computed(() => store.state.general.loading);
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
            textNode.className = "text-stone-100";
        }

        if (text.startsWith("--") || text.startsWith("-")) {
            textNode.className = "flag";
            textNode.className = "text-amber-200";
        }

        if (isOperator(text)) {
            textNode.className = "operator";
            textNode.className = "text-blue-200";
        }

        if (isFile(text)) {
            textNode.className = "file";
            textNode.className = "text-green-400";
        }

        if (isQuoted(text)) {
            textNode.className = "quoted";
            textNode.className = "text-green-400";
        }
        return cursorNode.appendChild(textNode);
    });
    return cursorNode.outerHTML;
};

const categories = ref({
    Commands: computed(() => store.state.commands.commands),
    Pages: computed(() => store.state.pages.pages),
    Links: computed(() => store.state.links.links),
});
</script>

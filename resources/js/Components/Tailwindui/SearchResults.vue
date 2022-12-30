<template>
    <div class="overflow-hidden bg-white shadow sm:rounded-md w-full mt-6">
        <ul role="list" class="divide-y divide-gray-200">
            <li v-for="command in props.commands" :key="command.id" class="command-list-item">
                <div class="relative">
                    <div class="px-4 py-4 sm:px-6">
                        <div class="flex items-center justify-between">
                            <p class="p-2 rounded bg-gray-100 w-full truncate text-sm font-medium text-indigo-600" v-html="colorizeCommand(command.command)"></p>
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
    </div>

</template>

<script setup>
import CommandPagination from "./CommandPagination.vue";
import { computed, defineProps } from "vue";
import { useStore } from "vuex";
import { Link } from "@inertiajs/inertia-vue3";

let store = useStore();
let commands = computed(() => store.state.commands.commands);
let pagination = computed(() => store.state.commands.pagination);

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

let props = defineProps({
    commands: {
        type: Array,
        default: []
    }
});
</script>

<style scoped>

</style>

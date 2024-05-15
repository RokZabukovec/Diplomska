<template>
    <div class="w-full mt-6">
        <div v-if="commands.length !== 0 && projectId !== -1">
            <SlideOverNewCommand :project="projectId"></SlideOverNewCommand>
        </div>
        <div v-if="hasCommands" class="mt-6">
            <ul role="list">
                <li v-for="command in commands" :key="command.id" class="command-list-item mb-2 flex-1 mt-6 p-3 shadow rounded items-center justify-between gap-x-6">
                    <div class="flex justify-end">
                        <button @click="openModal(command.id)" class="cursor-pointer ml-6 text-sm transition text-gray-300 hover:text-red-500">
                            <lord-icon
                                src="https://cdn.lordicon.com/drxwpfop.json"
                                trigger="hover"
                                stroke="bold"
                                colors="primary:#dc2626,secondary:#dc2626"
                                style="width:1.5rem;height:1.5rem">
                            </lord-icon>
                        </button>
                    </div>
                    <div class="relative flex flex-1">
                        <div class="py-4 sm:px-2 w-full">
                            <div class="flex items-center justify-between rounded bg-gray-100 command cursor-pointer transition-all">
                                <p class="p-2 w-full truncate text-sm font-medium text-indigo-600 overflow-x-auto" v-html="colorizeCommand(command.command)"></p>
                                <Link v-if="projectId !== -1" :href="route('command.edit', { id: command.id })" class="p-2 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 edit-link">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                    </svg>
                                </Link>
                            </div>
                            <div class="mt-2 sm:flex sm:justify-between">
                                <div class="sm:flex">
                                    <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">{{ command.description }}</p>
                                </div>
                            </div>
                            <div class="flex flex-shrink-0 mt-3">
                                <p v-if="command.platform" class="inline-flex rounded-full bg-green-100 py-1 px-3 mr-4 text-xs font-semibold leading-5 text-green-800 cursor-pointer hover:bg-green-200 transition-all" @click="selectTag(command.platform)">{{ command.platform }}</p>
                                <p v-for="tag in command.tags" :key="tag" class="inline-flex rounded-full bg-green-100 py-1 px-3 mr-4 text-xs font-semibold leading-5 text-green-800 cursor-pointer hover:bg-green-200 transition-all" @click="selectTag(tag)">{{ tag }}</p>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div v-if="hasCommands" class="flex justify-center p-6">
            <Pagination></Pagination>
        </div>
        <div v-else>
            <div class="flex flex-col items-center justify-center h-full">
                <div class="mb-6 text-gray-600 text-center">
                    <p class="text-lg font-semibold">No commands in this project.</p>
                    <p class="mt-2">Start by adding a command below.</p>
                </div>
                <SlideOverNewCommand :project="projectId"></SlideOverNewCommand>
            </div>
        </div>
        <DialogModal :show="confirmingCommandDeletion" @close="closeModal">
            <template #title> Delete command </template>

            <template #content>
                Are you sure you want to delete a command? Once the command is deleted, all of its resources and data will be permanently deleted.
            </template>

            <template #footer>
                <SecondaryButton @click.prevent="closeModal"> Cancel </SecondaryButton>

                <DangerButton class="ml-3" @click.prevent="deleteCommand"> Delete command </DangerButton>
            </template>
        </DialogModal>
    </div>
</template>

<script setup>
import { computed, ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { useStore } from "vuex";
import { route } from "ziggy-js";
import SlideOverNewCommand from "./SlideOverNewCommand.vue";
import Pagination from "./Pagination.vue";
import DangerButton from "../DangerButton.vue";
import SecondaryButton from "../SecondaryButton.vue";
import DialogModal from "../DialogModal.vue";

let commandForDeletion = ref(null);
let confirmingCommandDeletion = ref(false);

function closeModal() {
    commandForDeletion.value = null;
    confirmingCommandDeletion.value = false;
}
function openModal(id) {
    commandForDeletion.value = id;
    confirmingCommandDeletion.value = true
}

function deleteCommand() {
    store.dispatch('search/deleteCommand', commandForDeletion);
    closeModal();
}

const store = useStore();
const commands = computed(() => store.state.search.commands);
const hasCommands = computed(() => commands.value.length > 0);
const projectId = computed(() => store.state.search.selected.projectId).value;

function selectTag(tag) {
    store.dispatch('search/setTag', tag);
    store.dispatch('search/addBadge', {label: 'tag', value: tag});
}

const colorizeCommand = (command) => {
    const tokens = command.match(/('[^']*'|"[^"]*"|\S+)/g) || []; // Tokenize the command

    return tokens.map((token) => {
        let className = "";

        // Encode angle brackets
        token = token.replace(/</g, '&lt;').replace(/>/g, '&gt;');

        if (/^(-{1,2}\w+)/.test(token)) {
            className = "flag text-blue-500"; // Flag
        } else if (/^(<{1,2})|(&{1,2})|(>{1,2})|(\|{1,2})|({|\[|\]|\})/.test(token)) {
            className = "operator text-orange-600"; // Operator
        } else if (/\.\w+$/.test(token)) {
            className = "file text-green-500"; // File
        } else if (/^('[^']*'|"[^"]*")$/.test(token)) {
            className = "quoted text-grey-500"; // Quoted text
        } else {
            className = "command text-stone-800"; // Default command
        }

        return `<span class="${className}">${token} </span>`;
    }).join("");
};


</script>

<template>
    <a @click="open = true">
        <slot></slot>
        <TransitionRoot appear as="template" :show="open">
            <Dialog as="div" class="relative z-10" @close="open = false" >
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
                </TransitionChild>

                <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                            <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-6/12 sm:p-6">
                                <div class="actions flex justify-end pb-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4 h-4 cursor-pointer" @click="edit == true">
                                        <path class="text-slate-400" d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                    </svg>
                                </div>
                                <div class="command-wrapper">
                                    <div class="command-show rounded-md bg-gray-50 px-6 py-5 sm:flex sm:items-start sm:justify-between hover:ring cursor-pointer transition-all" v-html="colorizeCommand(props.command.command)"></div>
                                    <div class="command-description text-slate-700 my-4 leading-loose cursor-pointer rounded-md transition-all p-2">
                                        {{ props.command.description ?? "Add description" }}
                                    </div>
                                    <div class="flex flex-shrink-0 cursor-pointer rounded-md transition-all p-2">
                                        <p v-for="tag in commandModel.value.tags" :key="tag.id" class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">
                                            {{ tag.name.en }}
                                        </p>
                                    </div>
                                </div>
                                <div class="command-edit">
                                    <form action="#" class="relative">
                                        <div class="overflow-hidden rounded-lg border border-gray-300 shadow-sm focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
                                            <label for="command" class="sr-only">Command</label>
                                            <input id="command" v-model="commandModel.command" type="text" name="command" class="block w-full border-0 pt-2.5 text-lg font-medium placeholder-gray-500 focus:ring-0" placeholder="Command" />
                                            <label for="description" class="sr-only">Description</label>
                                            <textarea id="description" v-model="commandModel.description" rows="10" name="description" class="block w-full resize-none border-0 py-0 placeholder-gray-500 focus:ring-0 sm:text-sm" placeholder="Write a description..."></textarea>
                                        </div>
                                        <!-- Command Tags -->
                                        <div class="py-5">
                                            <div>
                                                <input id="project-name" v-model="tagsInput" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="command-tags" type="text" @keydown.space="addToTags" />
                                                <small class="text-sm text-gray-400">Press space to create a new tag</small>
                                            </div>
                                        </div>
                                        <div class="space-y-1">
                                            <span v-for="(tag, index) in props.command.tags" :key="index" class="inline-flex items-center rounded-full bg-indigo-100 py-0.5 pl-2 mx-1 pr-0.5 text-xs font-medium text-indigo-700">
                                                {{ tag.name.en }}
                                                <button class="ml-0.5 inline-flex h-4 w-4 flex-shrink-0 items-center justify-center rounded-full text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:bg-indigo-500 focus:text-white focus:outline-none" type="button" @click="removeTag(index)">
                                                    <span class="sr-only">Remove small option</span>
                                                    <svg class="h-2 w-2" fill="none" stroke="currentColor" viewBox="0 0 8 8">
                                                        <path d="M1 1l6 6m0-6L1 7" stroke-linecap="round" stroke-width="1.5" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </div>
                                        <button type="button" class="inline-flex items-center float-right rounded border border-transparent bg-indigo-600 px-2.5 py-1.5 text-xs font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" @click="saveCommand">Save</button>
                                    </form>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </a>
</template>

<script setup>
import { ref } from "vue";
import { useStore } from "vuex";
import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from "@headlessui/vue";
import { colorizeCommand } from "../../helpers/helpers";
const open = ref(false);
const props = defineProps(["command"]);

const commandModel = ref({
    id: props.command.id,
    command: props.command.command,
    description: props.command.description,
    tags: props.command.tags,
});

const store = useStore();
const tagsInput = ref("");

function saveCommand() {
    store.commit("commands/editCommand", commandModel.value);
    open.value = false;
}

function addToTags() {
    commandModel.value.tags.push(tagsInput.value.trim());
    tagsInput.value = "";
}

function removeTag(index) {
    console.log(commandModel.value);
    commandModel.value.tags.splice(index, 1);
}
</script>

<template>
    <a @click="open = true">
        <slot></slot>
        <TransitionRoot as="template" :show="open">
            <Dialog as="div" class="relative z-10" @close="open = false">
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
                </TransitionChild>

                <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                            <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-6/12 sm:p-6">
                                <div class="command-wrapper">
                                    <div v-if="!commandEdit" class="command-show rounded-md bg-gray-50 px-6 py-5 sm:flex sm:items-start sm:justify-between hover:ring cursor-pointer transition-all" @click="showCommandEditInput" v-html="colorizeCommand(props.command.command)"></div>
                                    <div v-if="commandEdit" class="command-edit" @focusout="showCommandEditInput">
                                        <div class="mt-1">
                                            <input id="command" type="text" name="command" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="you@example.com" aria-describedby="email-description" :value="command.command" />
                                        </div>
                                    </div>
                                    <div class="command-description text-slate-700 my-4 leading-loose hover:ring cursor-pointer rounded-md transition-all p-2">
                                        {{ props.command.description ?? "Add description" }}
                                    </div>
                                    <div class="flex flex-shrink-0 hover:ring cursor-pointer rounded-md transition-all p-2">
                                        <p v-for="tag in command.tags" :key="tag.id" class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">
                                            {{ tag.name.en }}
                                        </p>
                                    </div>
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
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from "@headlessui/vue";
import { CheckIcon } from "@heroicons/vue/24/outline";
import { colorizeCommand } from "../../helpers/helpers";
const open = ref(false);
const commandEdit = ref(false);
const props = defineProps(["command"]);

function showCommandEditInput() {
    commandEdit.value = !commandEdit.value;
}
</script>

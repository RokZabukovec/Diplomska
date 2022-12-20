<template>
    <div class="my-2">
        <button type="button" class="inline-flex items-center rounded border border-transparent bg-indigo-100 px-2.5 py-1.5 text-xs font-medium text-indigo-700 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" @click="open = true">Add +</button>
        <TransitionRoot :show="open" as="template">
            <Dialog as="div" class="relative z-10" @close="open = false">
                <div class="fixed inset-0" />

                <div class="fixed inset-0 overflow-hidden">
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                            <TransitionChild as="template" enter="transform transition ease-in-out duration-500 sm:duration-700" enter-from="translate-x-full" enter-to="translate-x-0" leave="transform transition ease-in-out duration-500 sm:duration-700" leave-from="translate-x-0" leave-to="translate-x-full">
                                <DialogPanel class="pointer-events-auto w-screen max-w-2xl">
                                    <form class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                                        <div class="flex-1">
                                            <!-- Header -->
                                            <div class="bg-gray-50 px-4 py-6 sm:px-6">
                                                <div class="flex items-start justify-between space-x-3">
                                                    <div class="space-y-1">
                                                        <DialogTitle class="text-lg font-medium text-gray-900">Command </DialogTitle>
                                                        <p class="text-sm text-gray-500">Get started by filling in the information below to create your a new command.</p>
                                                    </div>
                                                    <div class="flex h-7 items-center">
                                                        <button class="text-gray-400 hover:text-gray-500" type="button" @click="open = false">
                                                            <span class="sr-only">Close panel</span>
                                                            <XMarkIcon aria-hidden="true" class="h-6 w-6" />
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Divider container -->
                                            <div class="space-y-6 py-6 sm:space-y-0 sm:divide-y sm:divide-gray-200 sm:py-0">
                                                <!-- Command name -->
                                                <div class="space-y-1 px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2" for="project-name">Command</label>
                                                    </div>
                                                    <div class="sm:col-span-2">
                                                        <input id="project-name" v-model="form.command" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="command-name" type="text" />
                                                    </div>
                                                </div>

                                                <!-- Command description -->
                                                <div class="space-y-1 px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2" for="project-description">Description</label>
                                                    </div>
                                                    <div class="sm:col-span-2">
                                                        <textarea id="project-description" v-model="form.description" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="description" rows="3" />
                                                    </div>
                                                </div>
                                                <!-- Command Tags -->
                                                <div class="space-y-1 px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2" for="project-description">Tags</label>
                                                    </div>
                                                    <div class="sm:col-span-2">
                                                        <input id="project-name" v-model="tagsInput" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="command-name" type="text" @keydown.space="addToTags" />
                                                        <small class="text-sm text-gray-400">Press space to create a new tag</small>
                                                    </div>
                                                </div>
                                                <div class="space-y-1 px-4 sm:px-6 sm:py-5">
                                                    <span v-for="(tag, index) in form.tags" :key="index" class="inline-flex items-center rounded-full bg-indigo-100 py-0.5 pl-2 mx-1 pr-0.5 text-xs font-medium text-indigo-700">
                                                        {{ tag }}
                                                        <button class="ml-0.5 inline-flex h-4 w-4 flex-shrink-0 items-center justify-center rounded-full text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:bg-indigo-500 focus:text-white focus:outline-none" type="button" @click="removeTag(index)">
                                                            <span class="sr-only">Remove small option</span>
                                                            <svg class="h-2 w-2" fill="none" stroke="currentColor" viewBox="0 0 8 8">
                                                                <path d="M1 1l6 6m0-6L1 7" stroke-linecap="round" stroke-width="1.5" />
                                                            </svg>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action buttons -->
                                        <div class="flex-shrink-0 px-4 py-5 sm:px-6">
                                            <div class="flex justify-end space-x-3">
                                                <button class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" type="button" @click="open = false">Cancel</button>
                                                <button class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" type="submit" @click.prevent="storeCommand">Create</button>
                                            </div>
                                        </div>
                                    </form>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </div>
</template>

<script setup>
import { computed, ref } from "vue";
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";
import store from "../../Store/store";

let projectId = computed(() => store.state.general.selectedProject?.id);

const props = defineProps({
    project: {
        type: Object,
        default: null,
    },
});

let form = ref({
    command: "",
    description: "",
    project_id: parseInt(projectId.value ?? props.project.id),
    tags: [],
});

const tagsInput = ref("");
let open = ref(false);

function storeCommand() {
    console.log(form.value);
    store.commit("commands/storeCommand", form.value);
    open.value = false;
    for (let data in form) delete form[data];
}

function addToTags() {
    form.value.tags.push(tagsInput.value.trim());
    tagsInput.value = "";
}

function removeTag(index) {
    form.value.tags.splice(index, 1);
}
</script>

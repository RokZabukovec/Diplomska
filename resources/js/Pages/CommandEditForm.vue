<template>
    <MainLayout>
        <div class="wrapper bg-white sm:w-full mx-auto p-4 my-2 rounded">
            <form class="space-y-8 divide-y divide-gray-200" @submit.prevent="submitForm">
                <div class="space-y-8 divide-y divide-gray-200">
                    <div>
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Command</h3>
                        </div>

                        <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                            <div class="sm:col-span-6">
                                <label for="username" class="block text-sm font-medium text-gray-700">Command</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-gray-500 sm:text-sm">$</span>
                                    <input id="command" v-model="command.command" type="text" name="command" class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" :class="{ 'border-lime-600 border-2': success }" />
                                </div>
                            </div>

                            <div class="sm:col-span-6">
                                <label for="about" class="block text-sm font-medium text-gray-700">Description</label>
                                <div class="mt-1">
                                    <textarea id="description" v-model="command.description" name="about" rows="5" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" :class="{ 'border-lime-600 border-2': success }" />
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Write a few sentences about what this should do.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-5">
                    <div class="flex justify-end items-center">
                        <Link :href="route('project', { id: projectId })" class="text-slate-800">Back</Link>
                        <button type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </MainLayout>
</template>

<script setup>
import axios from "axios";
import { ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import MainLayout from "../Layouts/MainLayout.vue";

let success = ref(false);

let command = ref({
    command: props.command.command ?? "",
    description: props.command.description ?? "",
});

const props = defineProps({
    command: Object,
});
let projectId = props.command.project_id;

function submitForm() {
    axios
        .put("/api/commands/" + props.command.id, command.value)
        .then((response) => {
            let commandResponse = response.data;
            if (commandResponse) {
                command.value.command = commandResponse.command;
                success.value = true;
            }
        })
        .catch((error) => {
            console.log(error);
        })
        .finally(() => {
            setTimeout(() => {
                success.value = false;
            }, 3000);
        });
}
</script>

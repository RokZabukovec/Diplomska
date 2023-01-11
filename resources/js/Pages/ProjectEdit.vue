<template>
    <MainLayout>
        <form class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
        <div class="flex-1">
            <!-- Header -->
            <div class="bg-gray-50 px-4 py-6 sm:px-6">
                <div class="flex items-start justify-between space-x-3">
                    <div class="space-y-1">
                        <h1 class="text-lg font-medium text-gray-900"><b>Edit: </b>{{$page.props.project.name}}</h1>
                    </div>
                </div>
            </div>

            <!-- Divider container -->
            <div class="space-y-6 py-6 sm:space-y-0 sm:divide-y sm:divide-gray-200 sm:py-0">
                <!-- Project name -->
                <div class="space-y-1 px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2" for="project-name">Project name</label>
                    </div>
                    <div class="sm:col-span-2">
                        <input id="name" v-model="form.name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="name" type="text" />
                    </div>
                </div>

                <!-- Project description -->
                <div class="space-y-1 px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2" for="project-description">Description</label>
                    </div>
                    <div class="sm:col-span-2">
                        <textarea id="project-description" v-model="form.description" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="description" rows="3" />
                    </div>
                </div>
                <fieldset class="items-center space-y-2 px-4 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">
                    <legend class="sr-only">Privacy</legend>
                    <div aria-hidden="true" class="text-sm font-medium text-gray-900">Label</div>

                    <div>
                        <div>
                            <RadioGroup v-model="form.label_color" class="mt-4">
                                <RadioGroupLabel class="sr-only"> Choose a color </RadioGroupLabel>
                                <div class="flex items-center space-x-3">
                                    <RadioGroupOption as="template" v-for="color in product.colors" :key="color.name" :value="color.name" v-slot="{ active, checked }">
                                        <div :class="[color.selectedClass, active && checked ? 'ring ring-offset-1' : '', !active && checked ? 'ring-2' : '', '-m-0.5 relative p-0.5 rounded-full flex items-center justify-center cursor-pointer focus:outline-none']">
                                            <RadioGroupLabel as="span" class="sr-only">
                                                {{ color.name }}
                                            </RadioGroupLabel>
                                            <span aria-hidden="true" :class="[color.class, 'h-8 w-8 border border-black border-opacity-10 rounded-full']" />
                                        </div>
                                    </RadioGroupOption>
                                </div>
                            </RadioGroup>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <!-- Action buttons -->
        <div class="flex-shrink-0 border-t border-gray-200 px-4 py-5 sm:px-6">
            <div class="flex justify-end space-x-3">
                <button class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" type="button">Cancel</button>
                <button @click.prevent="updateProject" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" type="submit">
                    Update
                </button>
            </div>
        </div>
    </form>
    </MainLayout>
</template>

<script setup>
import {RadioGroup, RadioGroupLabel, RadioGroupOption} from "@headlessui/vue";
import {usePage} from "@inertiajs/inertia-vue3";
import MainLayout from "../Layouts/MainLayout.vue";
import {Inertia} from "@inertiajs/inertia";
import {useStore} from "vuex";

let page = usePage();
let store = useStore();

let form = page.props.value.project;

const product = {
    colors: [
        { name: "White", class: "bg-white", selectedClass: "ring-gray-400" },
        { name: "Red", class: "bg-red-400", selectedClass: "ring-red-400" },
        {
            name: "Green",
            class: "bg-green-400",
            selectedClass: "ring-green-400",
        },
        { name: "Blue", class: "bg-blue-400", selectedClass: "ring-blue-400" },
        {
            name: "Orange",
            class: "bg-orange-400",
            selectedClass: "ring-orange-400",
        },
    ],
};

function updateProject(){
    store.commit("projects/editProject", form);
}
</script>

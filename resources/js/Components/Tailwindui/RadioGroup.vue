<template>
    <div class="w-full py-4">
        <div class="mx-auto w-full max-w-md">
            <RadioGroup v-model="selected">
                <RadioGroupLabel class="sr-only">Server size</RadioGroupLabel>
                <div class="space-y-2">
                    <RadioGroupOption
                        v-for="project in projects"
                        :key="project.name"
                        v-slot="{ active, checked }"
                        :value="project.id"
                        as="template"
                    >
                        <div
                            :class="[
                                active
                                    ? 'ring-2 ring-white ring-opacity-60 ring-offset-2 ring-offset-sky-300'
                                    : '',
                                checked
                                    ? 'bg-sky-900 bg-opacity-75 text-white '
                                    : 'bg-white ',
                            ]"
                            class="relative flex cursor-pointer rounded-lg px-5 py-4 shadow-md focus:outline-none"
                        >
                            <div
                                class="flex w-full items-center justify-between"
                            >
                                <div class="flex items-center">
                                    <div class="text-sm">
                                        <RadioGroupLabel
                                            :class="
                                                checked
                                                    ? 'text-white'
                                                    : 'text-gray-900'
                                            "
                                            as="p"
                                            class="font-medium"
                                        >
                                            {{ project.name }}
                                        </RadioGroupLabel>
                                        <RadioGroupDescription
                                            :class="
                                                checked
                                                    ? 'text-sky-100'
                                                    : 'text-gray-500'
                                            "
                                            as="span"
                                            class="inline"
                                        >
                                            <span>
                                                {{ project.description }}</span
                                            >
                                        </RadioGroupDescription>
                                    </div>
                                </div>
                                <div
                                    v-show="checked"
                                    class="shrink-0 text-white"
                                >
                                    <svg
                                        class="h-6 w-6"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                    >
                                        <circle
                                            cx="12"
                                            cy="12"
                                            fill="#fff"
                                            fill-opacity="0.2"
                                            r="12"
                                        />
                                        <path
                                            d="M7 13l3 3 7-7"
                                            stroke="#fff"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.5"
                                        />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </RadioGroupOption>
                </div>
            </RadioGroup>
        </div>
    </div>
</template>

<script setup>
import { computed, ref } from "vue";
import {
    RadioGroup,
    RadioGroupDescription,
    RadioGroupLabel,
    RadioGroupOption,
} from "@headlessui/vue";
import store from "../../Store/store";

const props = defineProps(["projects"]);

const projects = computed(() => store.state.general.projects);
const selected = ref(projects);
</script>

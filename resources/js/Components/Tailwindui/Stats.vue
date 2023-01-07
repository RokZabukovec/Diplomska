<template>
    <div class="mb-6">
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <div v-for="item in stats" :key="item.id" class="relative overflow-hidden rounded-lg bg-white px-4 pt-5 pb-12 shadow sm:px-6 sm:pt-6">
                <dt>
                    <div class="absolute rounded-md bg-indigo-500 p-3">
                        <component :is="item.icon" class="h-6 w-6 text-white" aria-hidden="true" />
                    </div>
                    <p class="ml-16 truncate text-sm font-medium text-gray-500">{{ item.name }}</p>
                </dt>
                <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                    <p class="text-2xl font-semibold text-gray-900">{{ item.stat }}</p>
                    <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                        <div class="text-sm">
                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                View all<span class="sr-only"> {{ item.name }} stats</span></a
                            >
                        </div>
                    </div>
                </dd>
            </div>
        </dl>
    </div>
</template>

<script setup>
import { ArrowDownIcon, ArrowUpIcon } from '@heroicons/vue/20/solid'
import { CursorArrowRaysIcon, EnvelopeOpenIcon, UsersIcon } from '@heroicons/vue/24/outline'
import {usePage} from "@inertiajs/inertia-vue3";

let page = usePage();
const stats = [
    { id: 1, name: 'Total users', stat: page.props.value.user_count, icon: UsersIcon },
    { id: 2, name: 'Total projects', stat: page.props.value.project_count, icon: EnvelopeOpenIcon },
    { id: 3, name: 'Total commands', stat: page.props.value.command_count, icon: CursorArrowRaysIcon},
]
</script>

<template>
    <div class="bg-white py-24 sm:py-32 lg:py-40">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="sm:text-center">
                <h2 class="text-lg font-semibold leading-8 text-indigo-600">Commands</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">A better way to focus on important things.</p>
                <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-gray-600">
                    Leave unnecessary gasping for air when you can't remember where did you find that magic command that solved the issue the last time.
                </p>
            </div>

            <div class="mt-20 max-w-lg sm:mx-auto md:max-w-none">
                <div class="grid grid-cols-1 gap-y-16 md:grid-cols-2 md:gap-x-12 md:gap-y-16">
                    <div v-for="feature in features" :key="feature.name" class="relative flex flex-col gap-6 sm:flex-row md:flex-col lg:flex-row">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-500 text-white sm:shrink-0">
                            <component :is="feature.icon" class="h-8 w-8" aria-hidden="true" />
                        </div>
                        <div class="sm:min-w-0 sm:flex-1">
                            <p class="text-lg font-semibold leading-8 text-gray-900">{{ feature.name }}</p>
                            <p class="mt-2 text-base leading-7 text-gray-600">{{ feature.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { BoltIcon, DevicePhoneMobileIcon, GlobeAltIcon, ScaleIcon } from '@heroicons/vue/24/outline'

const features = [
    {
        name: 'Easy workflow integration',
        description:
            'Easy to use CLI application that provides you with intuitive search functionality.',
        icon: GlobeAltIcon,
    },
    {
        name: 'Free of charge',
        description:
            'No limit on the number of projects and commands that you store.',
        icon: ScaleIcon,
    },
    {
        name: 'Share with the team',
        description:
            'Everyone can simple add you to their list of team members and can access your commands instantly.',
        icon: BoltIcon,
    },
    {
        name: 'Future updates to the platform',
        description:
            'Future updates will bring a lot of useful commands right in your dashboard by default.',
        icon: DevicePhoneMobileIcon,
    },
]
</script>

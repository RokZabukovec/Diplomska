Tailwind UI Components Templates New Documentation Dropdowns Application UI
Elements Simple Requires JS With dividers Requires JS With icons Requires JS
With minimal menu icon Requires JS

<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <Menu as="div" class="relative inline-block text-left">
        <div>
            <MenuButton
                class="overflow-y-auto flex items-center rounded-full bg-transparent text-gray-900 hover:text-gray-700 focus:outline-none z-10"
            >
                <span class="sr-only">Open options</span>
                <EllipsisVerticalIcon aria-hidden="true" class="h-5 w-5" />
            </MenuButton>
        </div>

        <transition
            enter-active-class="transition ease-out duration-100"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
        >
            <MenuItems
                class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
            >
                <div class="py-1">
                    <MenuItem v-slot="{ active }">
                        <a
                            :class="[
                                active
                                    ? 'bg-gray-100 text-gray-900'
                                    : 'text-gray-700',
                                'block px-4 py-2 text-sm',
                            ]"
                            href="#"
                            >Edit</a
                        >
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                        <DeleteProjectModal></DeleteProjectModal>
                    </MenuItem>
                </div>
            </MenuItems>
        </transition>
    </Menu>
</template>

<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { EllipsisVerticalIcon } from "@heroicons/vue/20/solid";
import DeleteProjectModal from "./DeleteProjectModal.vue";
</script>

With simple header Requires JS © 2022 Tailwind Labs Inc. All rights reserved.
Privacy policy Changelog

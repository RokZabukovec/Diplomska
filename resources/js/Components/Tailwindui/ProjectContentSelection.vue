<template>
    <div>
        <div class="w-full inset-0 py-6 px-1 sm:px-2 lg:px-8">
            <div class="topbar flex justify-between mb-5">
                <button>
                    <div>
                        <div class="relative mt-1 flex items-center">
                            <input id="search" placeholder="Search" type="text" name="search" class="block w-full rounded-md border-gray-300 pr-12 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                                <kbd class="inline-flex items-center rounded border border-gray-200 px-2 font-sans text-sm font-medium text-gray-400">⌘K</kbd>
                            </div>
                        </div>
                    </div>
                </button>
                <SlideOverNewCommand></SlideOverNewCommand>
            </div>
            <div class="flex">
                <CommandList></CommandList>
            </div>
        </div>
    </div>
</template>

<script setup>
import SlideOverNewCommand from "./SlideOverNewCommand.vue";
import CommandList from "./CommandList.vue";
</script>

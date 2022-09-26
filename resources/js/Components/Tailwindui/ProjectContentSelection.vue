<template>
    <div class="w-full inset-0 py-6 px-1 sm:px-2 lg:px-8">
        <TabGroup>
            <TabList class="flex space-x-1 rounded-xl bg-blue-900/20 p-1">
                <Tab v-slot="{ selected }" as="template">
                    <button
                        :class="[
                            'flex justify-around w-full rounded-lg py-2.5 px-2 text-sm font-medium leading-5 text-blue-700',
                            'ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                            selected
                                ? 'bg-white shadow'
                                : 'text-blue-500 hover:bg-white/[0.12] hover:text-white',
                        ]"
                    >
                        Commands
                        <SlideOverNewCommand
                            v-if="selected"
                        ></SlideOverNewCommand>
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" as="template">
                    <button
                        :class="[
                            'w-full rounded-lg py-2.5 text-sm font-medium leading-5 text-blue-700',
                            'ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                            selected
                                ? 'bg-white shadow'
                                : 'text-blue-500 hover:bg-white/[0.12] hover:text-white',
                        ]"
                    >
                        Pages
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" as="template">
                    <button
                        :class="[
                            'w-full rounded-lg py-2.5 text-sm font-medium leading-5 text-blue-700',
                            'ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                            selected
                                ? 'bg-white shadow'
                                : 'text-blue-500 hover:bg-white/[0.12] hover:text-white',
                        ]"
                    >
                        Snippets
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" as="template">
                    <button
                        :class="[
                            'w-full rounded-lg py-2.5 text-sm font-medium leading-5 text-blue-700',
                            'ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                            selected
                                ? 'bg-white shadow'
                                : 'text-blue-500 hover:bg-white/[0.12] hover:text-white',
                        ]"
                    >
                        Links
                    </button>
                </Tab>
            </TabList>

            <TabPanels class="mt-2">
                <TabPanel
                    v-for="(posts, idx) in Object.values(categories)"
                    :key="idx"
                    :class="[
                        'prose prose-slate rounded-xl bg-white p-3',
                        'ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                    ]"
                >
                    <ul>
                        <li
                            v-for="post in posts"
                            :key="post.id"
                            class="relative rounded-md p-3 hover:bg-gray-100 not-prose"
                        >
                            <h3 class="text-sm font-medium leading-5">
                                {{ post.title }}
                            </h3>
                            <ul
                                class="mt-1 flex space-x-1 text-xs font-normal leading-4 text-gray-500"
                            >
                                <li>{{ post.date }}</li>
                                <li>&middot;</li>
                                <li>{{ post.commentCount }} comments</li>
                                <li>&middot;</li>
                                <li>{{ post.shareCount }} shares</li>
                            </ul>
                            <a
                                :class="[
                                    'absolute inset-0 rounded-md',
                                    'ring-blue-400 focus:z-10 focus:outline-none focus:ring-2',
                                ]"
                                href="#"
                            />
                        </li>
                    </ul>
                </TabPanel>
            </TabPanels>
        </TabGroup>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { Tab, TabGroup, TabList, TabPanel, TabPanels } from "@headlessui/vue";
import SlideOverNewCommand from "./SlideOverNewCommand.vue";

const categories = ref({
    Commands: [],
    Pages: [],
    Snippets: [],
    Links: [],
});

onMounted(() => {
    // store.commit("general/searchCommands");
});
</script>

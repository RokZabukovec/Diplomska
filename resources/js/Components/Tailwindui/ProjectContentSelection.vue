<template>
    <div class="w-full inset-0 py-6 px-1 sm:px-2 lg:px-8 prose">
        <Breadcrumbs></Breadcrumbs>
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
                            'flex justify-around w-full rounded-lg py-2.5 text-sm font-medium leading-5 text-blue-700',
                            'ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                            selected
                                ? 'bg-white shadow'
                                : 'text-blue-500 hover:bg-white/[0.12] hover:text-white',
                        ]"
                    >
                        Pages
                        <SlideOverNewPage v-if="selected"></SlideOverNewPage>
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" as="template">
                    <button
                        :class="[
                            'flex justify-around w-full rounded-lg py-2.5 text-sm font-medium leading-5 text-blue-700',
                            'ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                            selected
                                ? 'bg-white shadow'
                                : 'text-blue-500 hover:bg-white/[0.12] hover:text-white',
                        ]"
                    >
                        Links
                        <SlideOverNewLink v-if="selected"></SlideOverNewLink>
                    </button>
                </Tab>
            </TabList>

            <TabPanels class="mt-2">
                <TabPanel
                    v-for="(posts, idx) in Object.values(categories)"
                    :key="idx"
                    :class="[
                        'prose prose-slate rounded-xl',
                        'ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                    ]"
                >
                    <div v-if="Object.keys(categories)[idx] === 'Commands'">
                        <div
                            v-for="post in posts"
                            :key="post.id"
                            class="relative rounded-md p-3 bg-white my-3"
                        >
                            <pre class="language-bash whitespace-normal m-0">
                                <code class="language-bash">
                                    {{ post.command }}
                                </code>
                            </pre>
                            <div
                                class="prose mt-3"
                                v-if="post.description.length"
                            >
                                <small class="text-sm text-gray-200 uppercase"
                                    >Description:
                                </small>
                                <p class="m-0">{{ post.description }}</p>
                            </div>
                            <a
                                :class="[
                                    'absolute inset-0 rounded-md',
                                    'ring-blue-400 focus:z-10 focus:outline-none focus:ring-2',
                                ]"
                                href="#"
                            />

                            <div
                                class="tags mt-3"
                                v-if="post.tags && post.tags.length"
                            >
                                <div class="flex flex-wrap">
                                    <span
                                        v-for="tag in post.tags"
                                        class="mr-1 inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800"
                                        >{{ tag.name.en }}</span
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="Object.keys(categories)[idx] === 'Pages'">
                        <div
                            v-for="post in posts"
                            :key="post.id"
                            class="relative rounded-md p-3 bg-white my-3"
                        >
                            <a
                                :href="route('pages.show', post.id)"
                                class="no-underline relative rounded-md hover:bg-gray-100 flex justify-between align-middle text-blue-500 hover:text-blue-600 my-0"
                            >
                                <span class="flex items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-5 h-5 mr-3"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"
                                        />
                                    </svg>

                                    {{ post.title }}
                                </span>

                                <span class="text-gray-400 text-sm">{{
                                    moment(post.created_at).format("LL")
                                }}</span>
                            </a>
                        </div>
                    </div>
                    <div v-if="Object.keys(categories)[idx] === 'Links'">
                        <SkeletonLoader></SkeletonLoader>
                        <div
                            class="relative rounded-md p-3 bg-white my-3"
                            v-for="post in posts"
                            :key="post.id"
                        >
                            <div class="flex justify-between">
                                <a
                                    :href="post.url"
                                    class="no-underline relative rounded-md hover:bg-gray-100 text-blue-500 hover:text-blue-600 my-0"
                                    target="_blank"
                                >
                                    <div class="flex items-center">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-5 h-5 mr-3"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"
                                            />
                                        </svg>

                                        <span v-if="post.title">
                                            {{ post.title }}
                                        </span>
                                        <span v-else>
                                            {{ post.url }}
                                        </span>
                                    </div>
                                </a>
                                <div class="text-gray-400 text-sm">
                                    {{ moment(post.created_at).format("LL") }}
                                </div>
                            </div>
                            <p class="line-clamp-3" v-if="post.description">
                                {{ post.description }}
                            </p>
                        </div>
                    </div>
                </TabPanel>
            </TabPanels>
        </TabGroup>
    </div>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import { Tab, TabGroup, TabList, TabPanel, TabPanels } from "@headlessui/vue";
import SlideOverNewCommand from "./SlideOverNewCommand.vue";
import SlideOverNewPage from "./SlideOverNewPage.vue";
import store from "../../Store/store.js";
import SlideOverNewLink from "./SlideOverNewLink.vue";
import SkeletonLoader from "./SkeletonLoader.vue";
import moment from "moment";

const categories = ref({
    Commands: computed(() => store.state.commands.commands),
    Pages: computed(() => store.state.pages.pages),
    Links: computed(() => store.state.links.links),
});
</script>

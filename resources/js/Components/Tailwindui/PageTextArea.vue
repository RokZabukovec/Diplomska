<!--
  This example requires Tailwind CSS v2.0+

  This example requires some changes to your config:

  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<template>
    <form action="#">
        <TabGroup v-slot="{ selectedIndex }">
            <TabList class="flex items-center">
                <Tab v-slot="{ selected }" as="template">
                    <button
                        :class="[
                            selected
                                ? 'text-gray-900 bg-gray-100 hover:bg-gray-200'
                                : 'text-gray-500 hover:text-gray-900 bg-white hover:bg-gray-100',
                            'rounded-md border border-transparent px-3 py-1.5 text-sm font-medium',
                        ]"
                    >
                        Write
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" as="template">
                    <button
                        :class="[
                            selected
                                ? 'text-gray-900 bg-gray-100 hover:bg-gray-200'
                                : 'text-gray-500 hover:text-gray-900 bg-white hover:bg-gray-100',
                            'ml-2 rounded-md border border-transparent px-3 py-1.5 text-sm font-medium',
                        ]"
                    >
                        Preview
                    </button>
                </Tab>

                <!-- These buttons are here simply as examples and don't actually do anything. -->
                <div
                    v-if="selectedIndex === 0"
                    class="ml-auto flex items-center space-x-5"
                >
                    <div class="flex items-center">
                        <button
                            class="-m-2.5 inline-flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:text-gray-500"
                            type="button"
                        >
                            <span class="sr-only">Insert link</span>
                            <LinkIcon aria-hidden="true" class="h-5 w-5" />
                        </button>
                    </div>
                    <div class="flex items-center">
                        <button
                            class="-m-2.5 inline-flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:text-gray-500"
                            type="button"
                        >
                            <span class="sr-only">Insert code</span>
                            <CodeBracketIcon
                                aria-hidden="true"
                                class="h-5 w-5"
                            />
                        </button>
                    </div>
                    <div class="flex items-center">
                        <button
                            class="-m-2.5 inline-flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:text-gray-500"
                            type="button"
                        >
                            <span class="sr-only">Mention someone</span>
                            <AtSymbolIcon aria-hidden="true" class="h-5 w-5" />
                        </button>
                    </div>
                </div>
            </TabList>
            <TabPanels class="mt-2">
                <TabPanel class="-m-0.5 rounded-lg p-0.5">
                    <div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700"
                                for="email"
                                >Title</label
                            >
                            <div class="mt-1">
                                <input
                                    id="title"
                                    v-model="page.title"
                                    class="block w-full mb-3 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    name="title"
                                    placeholder="Deployment of the project xxxx"
                                    type="text"
                                />
                            </div>
                        </div>
                        <textarea
                            id="comment"
                            v-model="page.body"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            name="comment"
                            placeholder="Write it good ..."
                            rows="10"
                        />
                    </div>
                </TabPanel>
                <TabPanel class="rounded-lg p-0.5">
                    <div class="border-b">
                        <div
                            class="mx-px mt-px px-3 pt-2 pb-12 text-sm leading-5 text-gray-800 prose"
                        >
                            <h5 class="font-medium text-md">
                                {{ page.title }}
                            </h5>
                            <div>
                                {{ markdownRendered }}
                            </div>
                        </div>
                    </div>
                </TabPanel>
            </TabPanels>
        </TabGroup>
        <div class="flex flex-shrink-0 justify-end mx-px mt-px px-3 pt-2 pb-12">
            <button
                class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                type="button"
                @click="open = false"
            >
                Cancel
            </button>
            <button
                class="ml-4 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                type="submit"
                @click.prevent="storePage"
            >
                Save
            </button>
        </div>
    </form>
</template>

<script setup>
import { Tab, TabGroup, TabList, TabPanel, TabPanels } from "@headlessui/vue";
import {
    AtSymbolIcon,
    CodeBracketIcon,
    LinkIcon,
} from "@heroicons/vue/20/solid";
import { computed } from "vue";
import marked from "marked";
import store from "../../Store/store";

let projectId = computed(() => store.state.general.selectedProject.id);

let page = {
    title: "",
    body: "",
    project_id: projectId.value,
};

const markdownRendered = computed(() => {
    return marked(page.body, { sanitize: true });
});

function storePage() {
    store.commit("pages/storePage", page);
}
</script>

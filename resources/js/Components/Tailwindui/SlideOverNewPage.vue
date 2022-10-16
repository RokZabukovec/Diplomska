<template>
    <div>
        <PlusIcon
            aria-hidden="true"
            class="right-2 cursor-pointer ml-2 -mr-0.5 h-5 w-5 hover:text-indigo-700"
            @click="open = true"
        />
        <TransitionRoot :show="open" as="template">
            <Dialog as="div" class="relative z-10" @close="open = false">
                <div class="fixed inset-0" />

                <div class="fixed inset-0 overflow-hidden">
                    <div class="absolute inset-0 overflow-hidden">
                        <div
                            class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16"
                        >
                            <TransitionChild
                                as="template"
                                enter="transform transition ease-in-out duration-500 sm:duration-700"
                                enter-from="translate-x-full"
                                enter-to="translate-x-0"
                                leave="transform transition ease-in-out duration-500 sm:duration-700"
                                leave-from="translate-x-0"
                                leave-to="translate-x-full"
                            >
                                <DialogPanel
                                    class="pointer-events-auto w-screen max-w-3xl"
                                >
                                    <form
                                        class="flex h-full flex-col divide-y divide-gray-200 bg-white shadow-xl"
                                    >
                                        <div class="h-0 flex-1 overflow-y-auto">
                                            <div
                                                class="bg-indigo-700 py-6 px-4 sm:px-6"
                                            >
                                                <div
                                                    class="flex items-center justify-between"
                                                >
                                                    <DialogTitle
                                                        class="text-lg font-medium text-white"
                                                        >New Page
                                                    </DialogTitle>
                                                    <div
                                                        class="ml-3 flex h-7 items-center"
                                                    >
                                                        <button
                                                            class="rounded-md bg-indigo-700 text-indigo-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-white"
                                                            type="button"
                                                            @click="
                                                                open = false
                                                            "
                                                        >
                                                            <span
                                                                class="sr-only"
                                                                >Close
                                                                panel</span
                                                            >
                                                            <XMarkIcon
                                                                aria-hidden="true"
                                                                class="h-6 w-6"
                                                            />
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="mt-1">
                                                    <p
                                                        class="text-sm text-indigo-300"
                                                    >
                                                        Write any documentation
                                                        you need in a format you
                                                        are already familiar
                                                        with.
                                                    </p>
                                                </div>
                                            </div>
                                            <div
                                                class="flex flex-1 flex-col justify-between py-6 px-4 sm:px-6"
                                            >
                                                <form action="#">
                                                    <TabGroup
                                                        v-slot="{
                                                            selectedIndex,
                                                        }"
                                                    >
                                                        <TabList
                                                            class="flex items-center"
                                                        >
                                                            <Tab
                                                                v-slot="{
                                                                    selected,
                                                                }"
                                                                as="template"
                                                            >
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
                                                            <Tab
                                                                v-slot="{
                                                                    selected,
                                                                }"
                                                                as="template"
                                                            >
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
                                                                v-if="
                                                                    selectedIndex ===
                                                                    0
                                                                "
                                                                class="ml-auto flex items-center space-x-5"
                                                            >
                                                                <div
                                                                    class="flex items-center"
                                                                >
                                                                    <button
                                                                        class="-m-2.5 inline-flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:text-gray-500"
                                                                        type="button"
                                                                    >
                                                                        <span
                                                                            class="sr-only"
                                                                            >Insert
                                                                            link</span
                                                                        >
                                                                        <LinkIcon
                                                                            aria-hidden="true"
                                                                            class="h-5 w-5"
                                                                        />
                                                                    </button>
                                                                </div>
                                                                <div
                                                                    class="flex items-center"
                                                                >
                                                                    <button
                                                                        class="-m-2.5 inline-flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:text-gray-500"
                                                                        type="button"
                                                                    >
                                                                        <span
                                                                            class="sr-only"
                                                                            >Insert
                                                                            code</span
                                                                        >
                                                                        <CodeBracketIcon
                                                                            aria-hidden="true"
                                                                            class="h-5 w-5"
                                                                        />
                                                                    </button>
                                                                </div>
                                                                <div
                                                                    class="flex items-center"
                                                                >
                                                                    <button
                                                                        class="-m-2.5 inline-flex h-10 w-10 items-center justify-center rounded-full text-gray-400 hover:text-gray-500"
                                                                        type="button"
                                                                    >
                                                                        <span
                                                                            class="sr-only"
                                                                            >Mention
                                                                            someone</span
                                                                        >
                                                                        <AtSymbolIcon
                                                                            aria-hidden="true"
                                                                            class="h-5 w-5"
                                                                        />
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </TabList>
                                                        <TabPanels class="mt-2">
                                                            <TabPanel
                                                                class="-m-0.5 rounded-lg p-0.5"
                                                            >
                                                                <div>
                                                                    <div>
                                                                        <label
                                                                            class="block text-sm font-medium text-gray-700"
                                                                            for="email"
                                                                            >Title</label
                                                                        >
                                                                        <div
                                                                            class="mt-1"
                                                                        >
                                                                            <input
                                                                                id="title"
                                                                                v-model="
                                                                                    page.title
                                                                                "
                                                                                class="block w-full mb-3 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                                                name="title"
                                                                                placeholder="Deployment of the project xxxx"
                                                                                type="text"
                                                                            />
                                                                        </div>
                                                                    </div>
                                                                    <textarea
                                                                        id="comment"
                                                                        v-model="
                                                                            page.body
                                                                        "
                                                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                                        name="comment"
                                                                        placeholder="Write it good ..."
                                                                        rows="50"
                                                                    />
                                                                </div>
                                                            </TabPanel>
                                                            <TabPanel
                                                                class="-m-0.5 rounded-lg p-0.5"
                                                            >
                                                                <div
                                                                    class="border-b"
                                                                >
                                                                    <div
                                                                        class="mx-px mt-px px-3 pt-2 pb-12 text-sm leading-5 text-gray-800 prose"
                                                                    >
                                                                        <h1>
                                                                            {{
                                                                                page.title
                                                                            }}
                                                                        </h1>
                                                                        <div
                                                                            v-html="
                                                                                markdownRendered
                                                                            "
                                                                        ></div>
                                                                    </div>
                                                                </div>
                                                            </TabPanel>
                                                        </TabPanels>
                                                    </TabGroup>
                                                    <div
                                                        class="flex flex-shrink-0 justify-end px-4 py-4"
                                                    >
                                                        <button
                                                            class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                                            type="button"
                                                            @click="
                                                                open = false
                                                            "
                                                        >
                                                            Cancel
                                                        </button>
                                                        <button
                                                            class="ml-4 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                                            type="submit"
                                                            @click.prevent="
                                                                storePage
                                                            "
                                                        >
                                                            Save
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </form>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </div>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    Tab,
    TabGroup,
    TabList,
    TabPanel,
    TabPanels,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";
import {
    AtSymbolIcon,
    CodeBracketIcon,
    LinkIcon,
    PlusIcon,
} from "@heroicons/vue/20/solid";
import store from "../../Store/store";
import marked from "marked";

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
    open.value = false;
}

onMounted(() => {
    store.commit("pages/getPages", projectId);
});
let open = ref(false);
</script>

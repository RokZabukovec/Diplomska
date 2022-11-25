<template>
    <div>
        <button
            class="inline-flex justify-between items-center rounded border border-transparent bg-indigo-100 px-2.5 py-1.5 text-xs font-medium text-indigo-700 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            type="button"
            @click="open = true"
            @open-new-project = "open = true"
        >
            New project
            <PlusIcon aria-hidden="true" class="ml-2 -mr-0.5 h-4 w-4" />
        </button>
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
                                    class="pointer-events-auto w-screen max-w-2xl"
                                >
                                    <form
                                        class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl"
                                    >
                                        <div class="flex-1">
                                            <!-- Header -->
                                            <div
                                                class="bg-gray-50 px-4 py-6 sm:px-6"
                                            >
                                                <div
                                                    class="flex items-start justify-between space-x-3"
                                                >
                                                    <div class="space-y-1">
                                                        <DialogTitle
                                                            class="text-lg font-medium text-gray-900"
                                                            >New project
                                                        </DialogTitle>
                                                        <p
                                                            class="text-sm text-gray-500"
                                                        >
                                                            Get started by
                                                            filling in the
                                                            information below to
                                                            create your new
                                                            project.
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="flex h-7 items-center"
                                                    >
                                                        <button
                                                            class="text-gray-400 hover:text-gray-500"
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
                                            </div>

                                            <!-- Divider container -->
                                            <div
                                                class="space-y-6 py-6 sm:space-y-0 sm:divide-y sm:divide-gray-200 sm:py-0"
                                            >
                                                <!-- Project name -->
                                                <div
                                                    class="space-y-1 px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5"
                                                >
                                                    <div>
                                                        <label
                                                            class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2"
                                                            for="project-name"
                                                            >Project name</label
                                                        >
                                                    </div>
                                                    <div class="sm:col-span-2">
                                                        <input
                                                            id="project-name"
                                                            v-model="form.name"
                                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                            name="project-name"
                                                            type="text"
                                                        />
                                                    </div>
                                                </div>

                                                <!-- Project description -->
                                                <div
                                                    class="space-y-1 px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5"
                                                >
                                                    <div>
                                                        <label
                                                            class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2"
                                                            for="project-description"
                                                            >Description</label
                                                        >
                                                    </div>
                                                    <div class="sm:col-span-2">
                                                        <textarea
                                                            id="project-description"
                                                            v-model="
                                                                form.description
                                                            "
                                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                            name="project-description"
                                                            rows="3"
                                                        />
                                                    </div>
                                                </div>

                                                <!-- Team members
                                                <div class="space-y-2 px-4 sm:grid sm:grid-cols-3 sm:items-center sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">
                                                    <div>
                                                        <h3 class="text-sm font-medium text-gray-900">Team Members</h3>
                                                    </div>
                                                    <div class="sm:col-span-2">
                                                        <div class="flex space-x-2">
                                                            <a v-for="person in team" :key="person.email" :href="person.href" class="flex-shrink-0 rounded-full hover:opacity-75">
                                                                <img class="inline-block h-8 w-8 rounded-full" :src="person.imageUrl" :alt="person.name" />
                                                            </a>

                                                            <button type="button" class="inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full border-2 border-dashed border-gray-200 bg-white text-gray-400 hover:border-gray-300 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                                <span class="sr-only">Add team member</span>
                                                                <PlusIcon class="h-5 w-5" aria-hidden="true" />
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                -->

                                                <!-- Privacy -->
                                                <fieldset
                                                    class="space-y-2 px-4 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5"
                                                >
                                                    <legend class="sr-only">
                                                        Privacy
                                                    </legend>
                                                    <div
                                                        aria-hidden="true"
                                                        class="text-sm font-medium text-gray-900"
                                                    >
                                                        Color
                                                    </div>

                                                    <div>
                                                        <RadioGroup
                                                            v-model="
                                                                form.label_color
                                                            "
                                                            class="mt-4"
                                                        >
                                                            <RadioGroupLabel
                                                                class="sr-only"
                                                            >
                                                                Choose a color
                                                            </RadioGroupLabel>
                                                            <div
                                                                class="flex items-center space-x-3"
                                                            >
                                                                <RadioGroupOption
                                                                    as="template"
                                                                    v-for="color in product.colors"
                                                                    :key="
                                                                        color.name
                                                                    "
                                                                    :value="
                                                                        color.name
                                                                    "
                                                                    v-slot="{
                                                                        active,
                                                                        checked,
                                                                    }"
                                                                >
                                                                    <div
                                                                        :class="[
                                                                            color.selectedClass,
                                                                            active &&
                                                                            checked
                                                                                ? 'ring ring-offset-1'
                                                                                : '',
                                                                            !active &&
                                                                            checked
                                                                                ? 'ring-2'
                                                                                : '',
                                                                            '-m-0.5 relative p-0.5 rounded-full flex items-center justify-center cursor-pointer focus:outline-none',
                                                                        ]"
                                                                    >
                                                                        <RadioGroupLabel
                                                                            as="span"
                                                                            class="sr-only"
                                                                        >
                                                                            {{
                                                                                color.name
                                                                            }}
                                                                        </RadioGroupLabel>
                                                                        <span
                                                                            aria-hidden="true"
                                                                            :class="[
                                                                                color.class,
                                                                                'h-8 w-8 border border-black border-opacity-10 rounded-full',
                                                                            ]"
                                                                        />
                                                                    </div>
                                                                </RadioGroupOption>
                                                            </div>
                                                        </RadioGroup>
                                                    </div>
                                                    <div
                                                        class="space-y-5 sm:col-span-2"
                                                    >
                                                        <div
                                                            class="space-y-5 sm:mt-0"
                                                        >
                                                            <div
                                                                class="relative flex items-start"
                                                            >
                                                                <div
                                                                    class="absolute flex h-5 items-center"
                                                                >
                                                                    <input
                                                                        id="public-access"
                                                                        aria-describedby="public-access-description"
                                                                        checked=""
                                                                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                                        name="privacy"
                                                                        type="radio"
                                                                    />
                                                                </div>
                                                                <div
                                                                    class="pl-7 text-sm"
                                                                >
                                                                    <label
                                                                        class="font-medium text-gray-900"
                                                                        for="public-access"
                                                                        >Public
                                                                        access</label
                                                                    >
                                                                    <p
                                                                        id="public-access-description"
                                                                        class="text-gray-500"
                                                                    >
                                                                        Everyone
                                                                        with the
                                                                        link
                                                                        will see
                                                                        this
                                                                        project
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="relative flex items-start"
                                                            >
                                                                <div
                                                                    class="absolute flex h-5 items-center"
                                                                >
                                                                    <input
                                                                        id="restricted-access"
                                                                        aria-describedby="restricted-access-description"
                                                                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                                        name="privacy"
                                                                        type="radio"
                                                                    />
                                                                </div>
                                                                <div
                                                                    class="pl-7 text-sm"
                                                                >
                                                                    <label
                                                                        class="font-medium text-gray-900"
                                                                        for="restricted-access"
                                                                        >Private
                                                                        to
                                                                        Project
                                                                        Members</label
                                                                    >
                                                                    <p
                                                                        id="restricted-access-description"
                                                                        class="text-gray-500"
                                                                    >
                                                                        Only
                                                                        members
                                                                        of this
                                                                        project
                                                                        would be
                                                                        able to
                                                                        access
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="relative flex items-start"
                                                            >
                                                                <div
                                                                    class="absolute flex h-5 items-center"
                                                                >
                                                                    <input
                                                                        id="private-access"
                                                                        aria-describedby="private-access-description"
                                                                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                                        name="privacy"
                                                                        type="radio"
                                                                    />
                                                                </div>
                                                                <div
                                                                    class="pl-7 text-sm"
                                                                >
                                                                    <label
                                                                        class="font-medium text-gray-900"
                                                                        for="private-access"
                                                                        >Private
                                                                        to
                                                                        you</label
                                                                    >
                                                                    <p
                                                                        id="private-access-description"
                                                                        class="text-gray-500"
                                                                    >
                                                                        You are
                                                                        the only
                                                                        one able
                                                                        to
                                                                        access
                                                                        this
                                                                        project
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr
                                                            class="border-gray-200"
                                                        />
                                                        <div
                                                            class="space-between sm:space-between flex flex-col space-y-4 sm:flex-row sm:items-center sm:space-y-0"
                                                        >
                                                            <div class="flex-1">
                                                                <a
                                                                    class="group flex items-center space-x-2.5 text-sm font-medium text-indigo-600 hover:text-indigo-900"
                                                                    href="#"
                                                                >
                                                                    <LinkIcon
                                                                        aria-hidden="true"
                                                                        class="h-5 w-5 text-indigo-500 group-hover:text-indigo-900"
                                                                    />
                                                                    <span
                                                                        >Copy
                                                                        link</span
                                                                    >
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a
                                                                    class="group flex items-center space-x-2.5 text-sm text-gray-500 hover:text-gray-900"
                                                                    href="#"
                                                                >
                                                                    <QuestionMarkCircleIcon
                                                                        aria-hidden="true"
                                                                        class="h-5 w-5 text-gray-400 group-hover:text-gray-500"
                                                                    />
                                                                    <span
                                                                        >Learn
                                                                        more
                                                                        about
                                                                        sharing</span
                                                                    >
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>

                                        <!-- Action buttons -->
                                        <div
                                            class="flex-shrink-0 border-t border-gray-200 px-4 py-5 sm:px-6"
                                        >
                                            <div
                                                class="flex justify-end space-x-3"
                                            >
                                                <button
                                                    class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                                    type="button"
                                                    @click="open = false"
                                                >
                                                    Cancel
                                                </button>
                                                <button
                                                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                                    type="submit"
                                                    @click.prevent="
                                                        storeProject
                                                    "
                                                >
                                                    Create
                                                </button>
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
import { StarIcon } from "@heroicons/vue/20/solid";
import { RadioGroup, RadioGroupLabel, RadioGroupOption } from "@headlessui/vue";
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { PlusIcon, XMarkIcon } from "@heroicons/vue/24/outline";
import { LinkIcon, QuestionMarkCircleIcon } from "@heroicons/vue/20/solid";
import { useStore } from "vuex";

let open = ref(false);

// data
const team = [
    {
        name: "Tom Cook",
        email: "tom.cook@example.com",
        href: "#",
        imageUrl:
            "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
    },
    {
        name: "Whitney Francis",
        email: "whitney.francis@example.com",
        href: "#",
        imageUrl:
            "https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
    },
    {
        name: "Leonard Krasner",
        email: "leonard.krasner@example.com",
        href: "#",
        imageUrl:
            "https://images.unsplash.com/photo-1519345182560-3f2917c472ef?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
    },
    {
        name: "Floyd Miles",
        email: "floy.dmiles@example.com",
        href: "#",
        imageUrl:
            "https://images.unsplash.com/photo-1463453091185-61582044d556?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
    },
    {
        name: "Emily Selman",
        email: "emily.selman@example.com",
        href: "#",
        imageUrl:
            "https://images.unsplash.com/photo-1502685104226-ee32379fefbe?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
    },
];

// computed
const store = useStore();
const projects = computed(() => store.state.general.projects);

// methods
function storeProject() {
    open.value = false;
    store.commit("projects/storeProject", form.value);
}

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

let form = ref({
    name: "",
    description: "",
    label_color: product.colors[0].name,
});

</script>

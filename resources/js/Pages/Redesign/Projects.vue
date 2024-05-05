<script setup>

import { computed, ref } from "vue";
import SlideOverNewProject from "../../Components/Tailwindui/SlideOverNewProject.vue";
import { useStore } from "vuex";
import Pagination from "../../Components/Tailwindui/Pagination.vue";
import { TransitionRoot } from "@headlessui/vue";
import DialogModal from "../../Components/DialogModal.vue";
import DangerButton from "../../Components/DangerButton.vue";
import SecondaryButton from "../../Components/SecondaryButton.vue";
import { usePage } from "@inertiajs/inertia-vue3";

const page = usePage();
const user = page.props.value.auth.user;
const store = useStore();
const projects = computed(() => store.state.search.projects);
const loading = computed(() => store.state.search.loading);

let projectForDeletion = ref(null);
let confirmingProjectDeletion = ref(false);

function closeModal() {
    projectForDeletion.value = null;
    confirmingProjectDeletion.value = false;
}
function openModal(id) {
    projectForDeletion.value = id;
    confirmingProjectDeletion.value = true
}

function selectProject(id, name) {
    store.dispatch('search/setProject', id, name);
    store.dispatch('search/addBadge', {label: 'project', value: name});
}

function deleteProject() {
    store.dispatch('search/deleteProject', projectForDeletion);
    closeModal();
}

function selectMember(id, name) {
    store.dispatch('search/setUserId', id);
    store.dispatch('search/addBadge', {label: 'user', value: name});
}

function getLabelColor(projectLabel){

    if (projectLabel === undefined){
        return "bg-gray-100 text-black"
    }

    if (!projectLabel.length || projectLabel.toString().toLowerCase() === "white") return "bg-gray-100 text-black";

    if (projectLabel.startsWith("#")) {
        return "bg-gray-100 text-black"
    }

    return "bg-" + projectLabel.toString().toLowerCase() + "-400";
}

function getInitials(text, max=2) {
    const words = text.split(' ');

    let initials = '';
    for (const word of words) {
        if (words.length === 1){
            let num = 0;
            for(const char of word){
                initials += char;
                num++;
                if (num >= max) break;
            }
            break;
        }
        const initial = word[0].toUpperCase();
        initials += initial;
    }

    return initials;
}

</script>

<template>
    <TransitionRoot
        name="list" as="ul"
        appear
        :show="!loading"
        enter="transition-opacity duration-300"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="transition-opacity duration-500"
        leave-from="opacity-100"
        leave-to="opacity-0"
    >
        <SlideOverNewProject></SlideOverNewProject>

        <li tabindex="0" @click="selectProject(-1, 'general')" class="flex-1 mt-6 p-3 shadow bg-indigo-600 text-white cursor-pointer rounded flex items-center justify-between gap-x-6">
            <div class="flex-grow">
                <div class="flex items-center gap-x-3">
                    <div class="p-2 flex-shrink-0 flex items-center justify-center font-medium rounded uppercase">
                        SC
                    </div>
                    <div class="flex-grow">
                        <h3 class="font-semibold leading-6">System commands</h3>
                        <p class="leading-6">Compiled set of Linux, MacOs and Windows bash terminal commands</p>
                    </div>
                </div>
            </div>
        </li>
        <li tabindex="0" v-for="project in projects" :key="project.name" class="flex-1 mt-6 p-3 shadow rounded flex items-center justify-between gap-x-6">
            <div class="flex-grow">
                <div class="mb-5 text-gray-400 flex justify-between">
                    <p @click="selectMember(project.user_id, project.username)" class="cursor-pointer text-xs"><span class="transition font-semibold">{{ project.username }}</span></p>
                    <button v-if="project.user_id === user.id" @click="openModal(project.id)" class="cursor-pointer ml-6 text-sm transition text-gray-300 hover:text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                </div>
                <div class="flex items-start gap-x-3">
                    <div :class="[getLabelColor(project.label_color), 'p-2 flex-shrink-0 flex items-center justify-center font-medium rounded uppercase']">
                        {{ getInitials(project.name) }}
                    </div>
                    <div class="flex-grow">
                        <h3 class="font-semibold leading-6 text-gray-900 cursor-pointer text-gray-900" @click="selectProject(project.id, project.name)">{{ project.name }}</h3>
                        <p v-if="project.description !== null" class="leading-6 text-gray-600">{{ project.description }}</p>
                    </div>
                </div>
            </div>
        </li>
        <div v-show="projects.length > 0" class="flex justify-center p-6">
            <Pagination></Pagination>
        </div>
        <!-- Delete Account Confirmation Modal -->
        <DialogModal :show="confirmingProjectDeletion" @close="closeModal">
            <template #title> Delete project </template>

            <template #content>
                Are you sure you want to delete a project? Once the project is deleted, all of its resources and data will be permanently deleted.
            </template>

            <template #footer>
                <SecondaryButton @click.prevent="closeModal"> Cancel </SecondaryButton>

                <DangerButton class="ml-3" @click.prevent="deleteProject"> Delete project </DangerButton>
            </template>
        </DialogModal>
    </TransitionRoot>
</template>

<style scoped>

</style>

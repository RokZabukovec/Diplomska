<template>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-end">
            <div class="mt-4 sm:ml-16 sm:mt-0 flex justify-end">
                <ul>
                    <li>
                        <a :href="'/teams/'+ team.id">
                            <button type="button" class="flex block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                <span class="mr-1">Manage team</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                        </a>
                    </li>
                </ul>

            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-2 mt-8">
            <template v-for="person in members" :key="person.email">
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img class="w-full h-auto" :src="person.profile_photo_url" alt="User's Profile Photo">
                    <div class="p-4">
                        <Tag v-if="person.id === user.id" severity="success" value="Owner" class="mb-2"></Tag>
                        <p v-if="person.id !== user.id" class="flex rounded text-gray-600 text-xs font-bold p-1 mb-2">Member</p>
                        <h2 class="text-lg font-semibold text-gray-800">{{ person.name }}</h2>
                        <p class="text-gray-600 text-sm">{{ person.email }}</p>
                        <p class="text-gray-600 text-sm">Created At: {{ formatDate(person.created_at) }}</p>
                    </div>
                </div>
            </template>
        </div>

    </div>

</template>

<script setup>
import Tag from 'primevue/tag';
import { computed } from "vue";
import { useStore } from "vuex";
import { usePage } from "@inertiajs/inertia-vue3";

const store = useStore();
const page = usePage();
const user = page.props.value.context.user;
const members = computed(() => store.state.search.team_members);
const team = user.current_team;

const formatDate = (dateString) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString(undefined, options);
};
</script>

<style scoped>

</style>

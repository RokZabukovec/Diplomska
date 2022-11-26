<template>
    <div class="overflow-hidden bg-white shadow sm:rounded-md ml-2">
        <ul role="list" class="divide-y divide-gray-200">
            <li v-for="member in members" :key="member.email">
                <a href="" :class="{ 'bg-amber-50': member.id === user.id }" class="block hover:bg-gray-50">
                    <div class="flex items-center px-4 py-4 sm:px-6">
                        <div class="flex min-w-0 flex-1 items-center">
                            <div class="flex-shrink-0">
                                <img class="h-12 w-12 rounded-full" :src="member.profile_photo_url" alt="" />
                            </div>
                            <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                <div>
                                    <p class="truncate text-sm font-medium text-indigo-600">{{ member.name }}</p>
                                    <p class="mt-2 flex items-center text-sm text-gray-500">
                                        <EnvelopeIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                                        <span class="truncate">{{ member.email }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { EnvelopeIcon } from "@heroicons/vue/20/solid";
import { computed, onMounted } from "vue";
import { useStore } from "vuex";

let store = useStore();
let members = computed(() => store.state.teams.members);
let user = computed(() => store.state.general.user);

const getMembers = () => {
    store.commit("teams/getMembers");
};

onMounted(() => {
    getMembers();
});
</script>

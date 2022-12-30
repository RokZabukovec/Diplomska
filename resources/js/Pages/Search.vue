<template>
    <MainLayout :context="props.context">
        <template #sidebar>
            <div class="overflow-hidden rounded-lg shadow">
                <div class="bg-white rounded p-2">
                    <div class="p-2">
                        <h3 class="bolder text-gray-700 mb-4">Team members</h3>
                        <ul role="list" class="divide-y divide-gray-200" v-if="props.context.members.length">
                            <li v-for="person in props.context.members" :key="person.id" class="flex py-4 hover:bg-blue-100 cursor-pointer px-2 rounded" :class="{'bg-blue-200': params.member === person.id}" @click="selectMember(person.id)">
                                <img class="h-10 w-10 rounded-full" :src="person.profile_photo_url" alt="" />
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ person.name }}</p>
                                    <p class="text-sm text-gray-500">{{ person.email }}</p>
                                </div>
                            </li>
                        </ul>
                        <Link :href="route('teams.show', $page.props.user.current_team_id)"  class="rounded p-2 text-xs font-bold">
                            <button type="button" :class="{ 'bg-slate-700': $page.url.startsWith('/teams') }" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <PlusIconMini class="-ml-0.5 mr-2 h-4 w-4" aria-hidden="true" />
                                Invite members
                            </button>
                        </Link>
                    </div>
                </div>
            </div>
        </template>
        <div class="sm:w-full md:w-3/4 mx-auto">
            <div class="relative mt-1 flex items-center">
                <input @change="search()" v-model="params.q" placeholder="Search" autofocus type="text" name="search" id="search" class="block w-full rounded-md border-gray-300 pr-12 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                    <kbd class="inline-flex items-center rounded border border-gray-200 px-2 font-sans text-sm font-medium text-gray-400">⌘ + F</kbd>
                </div>
            </div>
            <ul v-if="commands.length">
                <SearchResults :commands="commands"></SearchResults>
            </ul>
            <div v-else class="flex justify-content-center mt-5">
                <h3 class="text-slate-500">No results yet</h3>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import MainLayout from "../Layouts/MainLayout.vue";
import SearchResults from "../Components/Tailwindui/SearchResults.vue";
import { PlusIcon as PlusIconMini } from '@heroicons/vue/20/solid';
import axios from "axios";
import _ from "lodash";
import { useStore } from "vuex";
import {defineProps, onMounted, ref, computed} from "vue";
import {Link} from "@inertiajs/inertia-vue3";

let store = useStore();
let commands = computed(() => store.state.commands.commands);
let pagination = computed(() => store.state.commands.pagination);

let params = ref({
    member: null,
    q: ""
});

let props = defineProps({
    "context": {
        type: Object,
        default: null,
    },
})

function selectMember(id){
    console.log(props.context);
    params.value.member = id
    search();
}
onMounted(()=>{
    console.log(props.context);
});

function search() {
    const parameters = params.value;
    axios
        .get("/api/search", {
            params:{
                "q": parameters.q,
                "member": parameters.member
            },
        })
        .then((response) => {
            store.commit("commands/setCommands", response);
        })
        .catch((err) => {
            console.log(err);
        });
}
_.debounce(() => {
    search(params.value);
}, 2000);
</script>

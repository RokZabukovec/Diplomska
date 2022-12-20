<template>
    <MainLayout>
        <div class="sm:w-full md:w-3/4 mx-auto">
            <div class="relative mt-1 flex items-center">
                <input @change="search()" v-model="params.q" placeholder="Search" autofocus type="text" name="search" id="search" class="block w-full rounded-md border-gray-300 pr-12 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                    <kbd class="inline-flex items-center rounded border border-gray-200 px-2 font-sans text-sm font-medium text-gray-400">⌘K</kbd>
                </div>
            </div>
            <ul>
                <li v-for="command in commands">
                    {{command.command}}
                </li>
            </ul>
        </div>
        <template #sidebar>
            <div class="p-2">
                <h3 class="bolder text-gray-700 mb-4">Team members</h3>
                <ul role="list" class="divide-y divide-gray-200" >
                    <li v-for="person in props.context.members" :key="person.id" class="flex py-4 hover:bg-blue-100 cursor-pointer px-2 rounded" :class="{'bg-blue-200': params.member === person.id}" @click="selectMember(person.id)">
                        <img class="h-10 w-10 rounded-full" :src="person.profile_photo_url" alt="" />
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">{{ person.name }}</p>
                            <p class="text-sm text-gray-500">{{ person.email }}</p>
                        </div>
                    </li>
                </ul>
            </div>
        </template>
    </MainLayout>
</template>

<script setup>
import MainLayout from "../Layouts/MainLayout.vue";
import {defineProps, onMounted, ref, computed} from "vue";
import axios from "axios";
import _ from "lodash";
import { useStore } from "vuex";

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
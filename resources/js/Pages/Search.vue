<template>
    <MainLayout>
            <div class="mx-auto max-w-3xl">
                <div v-if="loading">
                    <div class="border-round border-1 surface-border p-4 surface-card">
                        <div class="flex mb-3">
                            <Skeleton shape="circle" size="4rem" class="mr-2"></Skeleton>
                            <div>
                                <Skeleton width="10rem" class="mb-2"></Skeleton>
                                <Skeleton width="5rem" class="mb-2"></Skeleton>
                                <Skeleton height=".5rem"></Skeleton>
                            </div>
                        </div>
                        <Skeleton width="100%" height="150px"></Skeleton>
                        <div class="flex justify-content-between mt-3">
                            <Skeleton width="4rem" height="2rem"></Skeleton>
                            <Skeleton width="4rem" height="2rem"></Skeleton>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <Transition>
                        <Projects v-if="showProjects"></Projects>
                        <CommandList v-else-if="showCommands"></CommandList>
                    </Transition>
                </div>
            </div>
    </MainLayout>
</template>

<script setup>
import MainLayout from "../Layouts/MainLayout.vue";
import Projects from "../Pages/Redesign/Projects.vue";
import {computed} from "vue";
import CommandList from "../Components/Tailwindui/CommandList.vue";
import { useStore } from "vuex";
import Skeleton from 'primevue/skeleton';

let store = useStore();
// Define a computed property to get the 'type' property from the Vuex store state
const loading = computed(() => store.state.search.loading);
const showProjects = computed(() => store.state.search.type === "projects");
const showCommands = computed(() => store.state.search.type === "commands");
console.log(computed(() => store.state.search.type).value)
</script>

<style scoped>
.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>

<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import Banner from "../Components/Banner.vue";
import { onMounted } from "vue";
import store from "../Store/store.js";

defineProps({
    title: String,
});

onMounted(() => {
    store.commit("general/getProjects");
});
</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

        <div class="min-h-screen bg-gray-100">
            <!-- Page Content -->
            <main>
                <slot></slot>
            </main>
        </div>
    </div>
</template>

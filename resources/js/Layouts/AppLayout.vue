<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import Banner from '@/Components/Banner.vue';

defineProps({
    title: String,
});



</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

        <div class="min-h-screen bg-gray-100">
            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>

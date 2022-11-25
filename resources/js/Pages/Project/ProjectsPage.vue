<template>
    <AppLayout title="Dashboard">
        <h1>Hello</h1>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

let props = defineProps({
    project: Object,
});

</script>

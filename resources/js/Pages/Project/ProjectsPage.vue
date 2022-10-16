<template>
    <AppLayout title="Dashboard">
        <ProjectSingle :project="project"></ProjectSingle>
    </AppLayout>
</template>

<script setup>
import ProjectSingle from "./ProjectSingle.vue";
import AppLayout from "@/Layouts/AppLayout.vue";

let props = defineProps({
    project: Object,
});
</script>

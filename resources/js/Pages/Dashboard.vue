<script setup>
import AppLayout from "../Layouts/AppLayout.vue";
import MultiColumnLayout from "../Components/Tailwindui/MultiColumnLayout.vue";
</script>

<template>
    <AppLayout title="Dashboard">
        <MultiColumnLayout :page="$page.props"></MultiColumnLayout>
    </AppLayout>
</template>

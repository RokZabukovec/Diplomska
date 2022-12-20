<script setup>
import MainLayout from "../Layouts/MainLayout.vue";
import MultiColumnLayout from "../Components/Tailwindui/MultiColumnLayout.vue";
</script>

<template>
    <MainLayout title="Dashboard">
        <MultiColumnLayout :page="$page.props"></MultiColumnLayout>
    </MainLayout>
</template>

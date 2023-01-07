<template>
    <MainLayout>
        <h1>Admin Dashboard</h1>
        <Stats />
        <UserChart/>
    </MainLayout>
</template>

<script setup>
import MainLayout from "../Layouts/MainLayout.vue";
import Stats from "../Components/Tailwindui/Stats.vue";
import UserChart from "../Components/Tailwindui/UserChart.vue";

</script>

<style scoped>

</style>

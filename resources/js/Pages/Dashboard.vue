<script setup>
import MainLayout from "../Layouts/MainLayout.vue";
import Search from "../Pages/Search.vue";
</script>

<template>
    <MainLayout title="Dashboard">
        <Search :page="$page.props"></Search>
    </MainLayout>
</template>

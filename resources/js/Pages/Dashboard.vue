<script setup>
import MainLayout from "../Layouts/MainLayout.vue";
import Search from "../Pages/Search.vue";
import MainNavigation from "../Components/MainNavigation.vue";
</script>

<template>
    <MainLayout title="Dashboard">
        <Search :page="$page.props"></Search>
    </MainLayout>
</template>

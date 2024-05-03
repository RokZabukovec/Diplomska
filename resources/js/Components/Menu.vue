
<template>
    <div class="card flex justify-center">
        <Sidebar v-model:visible="visibleLeft" header="Left Sidebar">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </Sidebar>
        <Button icon="pi pi-bars" @click="visibleLeft = true" />
    </div>
</template>

<script setup>
import Sidebar from 'primevue/sidebar';
import Button from 'primevue/button';
import Avatar from 'primevue/avatar';
import { ref } from "vue";

const visibleLeft = ref(false);
</script>

<template>
    <div class="flex min-h-screen">
        <div class="flex flex-1 flex-col justify-start py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <HomeButton />
                <div class="mt-8">
                    <div class="mt-6">
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative hidden w-0 flex-1 lg:block">
            <img class="absolute inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1505904267569-f02eaeb45a4c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1908&q=80" alt="" />
        </div>
    </div>
</template>
<script setup>
import AuthenticationCardLogo from "../Components/AuthenticationCardLogo.vue";
import HomeButton from "../Components/HomeButton.vue";
</script>

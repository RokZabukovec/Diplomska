<template>
    <div
        class="md:flex md:items-center md:justify-between md:space-x-5 my-3 py-2"
    >
        <div class="flex items-start space-x-5">
            <div class="py-1 px-4">
                <h1 class="text-xl font-bold text-gray-900">
                    {{ props.user.name }}
                </h1>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import {
    CodeBracketIcon,
    EllipsisVerticalIcon,
    FlagIcon,
    StarIcon,
} from "@heroicons/vue/20/solid";

let props = defineProps({
    user: Object,
});
</script>

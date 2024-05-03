<script setup>
import searchStore from "../Store/search.js";
import { computed } from "vue";

function getRandomBgColor() {
    const colors = [
        'bg-red-100', 'bg-blue-100', 'bg-green-100', 'bg-yellow-100',
        'bg-indigo-100', 'bg-purple-100', 'bg-pink-100', 'bg-gray-100',
        'bg-red-100', 'bg-blue-100', 'bg-green-100', 'bg-yellow-100',
        'bg-indigo-100', 'bg-purple-100', 'bg-pink-100', 'bg-gray-100'
    ];

    return colors[Math.floor(Math.random() * colors.length)];
}

const badges = computed(() => searchStore.state.search.badges);

function remove(badge) {
    searchStore.dispatch('search/removeBadge', badge);
}

</script>

<template>
<span v-for="badge in badges" :key="badge.label" :class="[ 'inline-flex', 'items-center', 'gap-x-0.5', 'rounded-md', getRandomBgColor(), 'px-3', 'py-2', 'text-sm', 'text-gray-600', 'mr-2' ]">
    <span class="font-bold">{{ badge.label }} :</span>{{ badge.value }}
    <button type="button" class="group relative ml-2 mt-0.5 -mr-2 h-4 w-4 rounded-sm hover:bg-gray-500/20" @click="remove(badge)">
      <span class="sr-only">Remove</span>
      <svg viewBox="0 0 14 14" class="h-3.5 w-3.5 stroke-gray-700/50 group-hover:stroke-gray-700/75">
        <path d="M4 4l6 6m0-6l-6 6" />
      </svg>
      <span class="absolute -inset-1" />
    </button>
  </span>
</template>

<style scoped>

</style>

<template>
    <div class="overflow-hidden rounded-md bg-white shadow">
        <ul role="list" class="divide-y divide-gray-200">
            <li v-for="item in items" :key="item.id" class="px-6 py-4">
                <a href="#">
                    <h2 class="flex justify-between text-gray-800 font-bold leading-7 text-gray-900 sm:truncate sm:tracking-tight">
                        {{item.name}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </h2>
                </a>
            </li>
        </ul>
    </div>
</template>

<script setup>
const items = [
    { id: 1, name: 'School'},
    { id: 2, name: 'XML validator'},
]
</script>

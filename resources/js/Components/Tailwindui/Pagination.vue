<script setup>
import { useStore } from "vuex";
import { computed } from "vue";

const store = useStore();
const page = computed(() => store.state.search.page).value;
const totalPages = computed(() => store.state.search.totalPages).value || 1;

function nextPage() {
    store.dispatch("search/nextPage");
}

function prevPage() {
    store.dispatch("search/prevPage");
}

function setPage(page) {
    store.dispatch("search/setPage", page);
}

</script>

<template>
    <div class="flex items-center gap-4">
        <!-- Previous button -->
        <button @click="prevPage"
                :disabled="page === 1"
                class="flex items-center gap-2 px-6 py-3 font-sans text-xs font-bold text-center text-gray-600 uppercase align-middle transition-all rounded-lg select-none hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                type="button">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                 stroke="currentColor"
                 aria-hidden="true" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
            </svg>
            Previous
        </button>
        <!-- Page buttons -->
        <div class="flex items-center gap-2">
            <button v-for="pageNumber in totalPages"
                    :key="pageNumber"
                    @click="setPage(pageNumber)"
                    :class="[
              'relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase transition-all',
              {
                'bg-indigo-500 text-white shadow-md': pageNumber === page,
                'text-gray-900 hover:bg-gray-100 active:bg-gray-200': pageNumber !== page
              }
            ]">
                <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">{{ pageNumber }}</span>
            </button>
        </div>
        <!-- Next button -->
        <button @click="nextPage"
                class="flex items-center gap-2 px-6 py-3 font-sans text-xs font-bold text-center text-gray-600 uppercase align-middle transition-all rounded-lg select-none hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                type="button" :disabled="page === totalPages">
            Next
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                 stroke="currentColor"
                 aria-hidden="true" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path>
            </svg>
        </button>
    </div>
</template>

<style scoped>
</style>

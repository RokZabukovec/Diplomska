<template>
    <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20 prose prose-stone">
        <div class="max-w-xl mb-5 md:mx-auto lg:max-w-2xl">
            <div class="mb-1 text-center">
                <h1 class="text-indigo-600">{{ page.title }}</h1>
                <small class="mb-2 text-xs font-semibold text-center tracking-wide text-gray-400 sm:text-center">
                    {{ moment(page.created_at).format("LLL") }}
                </small>
            </div>
            <div v-html="renderedBody"></div>
        </div>
        <div class="mb-10 sm:text-center">
            <a aria-label="Author" class="inline-block mb-1" href="/public">
                <img alt="avatar" class="object-cover w-10 h-10 rounded-full shadow-sm" src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;h=750&amp;w=1260" />
            </a>
        </div>
    </div>
</template>

<script setup>
import marked from "marked";
import { computed } from "vue";
import moment from "moment";

let props = defineProps({
    page: Object,
});

let renderedBody = computed(() => {
    if (props.page === undefined || props.page.body === undefined || props.page.body === null) {
        return "<h3 class='text-center text-bold'>The page is a blank slate.</h3>";
    }
    return marked(props.page.body);
});
</script>

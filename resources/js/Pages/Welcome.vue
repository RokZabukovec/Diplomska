<!-- This example requires Tailwind CSS v3.0+ -->
<template>
    <div class="isolate bg-white">
        <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]">
            <svg class="relative left-[calc(50%-11rem)] -z-10 h-[21.1875rem] max-w-none -translate-x-1/2 rotate-[30deg] sm:left-[calc(50%-30rem)] sm:h-[42.375rem]" viewBox="0 0 1155 678" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill="url(#45de2b6b-92d5-4d68-a6a0-9b9b2abad533)" fill-opacity=".3" d="M317.219 518.975L203.852 678 0 438.341l317.219 80.634 204.172-286.402c1.307 132.337 45.083 346.658 209.733 145.248C936.936 126.058 882.053-94.234 1031.02 41.331c119.18 108.451 130.68 295.337 121.53 375.223L855 299l21.173 362.054-558.954-142.079z" />
                <defs>
                    <linearGradient id="45de2b6b-92d5-4d68-a6a0-9b9b2abad533" x1="1155.49" x2="-78.208" y1=".177" y2="474.645" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#9089FC" />
                        <stop offset="1" stop-color="#FF80B5" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
        <div class="px-6 pt-6 lg:px-8">
            <div>
                <nav class="flex h-16 items-center justify-between" aria-label="Global">
                    <div class="flex-shrink-0">
                        <a href="#" class="p-2">
                            <span class="sr-only">Your Company</span>
                            <img class="h-10" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="" />
                        </a>
                    </div>
                    <div class="flex lg:hidden">
                        <button type="button" class="p-2 inline-flex items-center justify-center rounded-md text-gray-700" aria-label="Open main menu" @click="mobileMenuOpen = true">
                            <Bars3Icon class="h-6 w-6" aria-hidden="true" />
                        </button>
                    </div>
                    <div class="hidden lg:flex lg:flex-grow lg:justify-end">
                        <a href="/documentation" class="inline-block px-4 py-2 text-sm font-semibold leading-6 text-gray-900 hover:text-gray-700">Documentation</a>
                        <a v-if="_.isEmpty(user)" href="/login" class="inline-block px-4 py-2 text-sm font-semibold leading-6 text-gray-900 hover:text-gray-700">Log in</a>
                        <a v-if="_.isEmpty(user)" href="/register" class="inline-block px-4 py-2 text-sm font-semibold leading-6 text-gray-50 bg-gray-800 hover:bg-gray-700">Register</a>
                        <a v-else href="/search" class="inline-block px-4 py-2 text-sm font-semibold leading-6 text-gray-900 hover:text-gray-700 bg-indigo-50 hover:bg-indigo-100">Dashboard</a>
                    </div>
                </nav>
            </div>
        </div>
        <main>
            <div class="relative px-6 lg:px-8">
                <div class="mx-auto max-w-3xl pt-20 pb-32 sm:pt-48 sm:pb-40">
                    <div>
                        <div>
                            <h1 class="text-4xl font-bold tracking-tight sm:text-center sm:text-6xl relative">{{ $page.props.context.app_name }} <span class="absolute top-0 sm:right-0 md:right-8 inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800">Beta</span></h1>
                            <p class="mt-6 text-lg leading-8 text-gray-600 sm:text-center">"Are you tired of searching through old terminal windows to find that one command you need? Try our web app and easily store and access all your terminal commands and information in one place."</p>
                        </div>
                        <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]">
                            <svg class="relative left-[calc(50%+3rem)] h-[21.1875rem] max-w-none -translate-x-1/2 sm:left-[calc(50%+36rem)] sm:h-[42.375rem]" viewBox="0 0 1155 678" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill="url(#ecb5b0c9-546c-4772-8c71-4d3f06d544bc)" fill-opacity=".3" d="M317.219 518.975L203.852 678 0 438.341l317.219 80.634 204.172-286.402c1.307 132.337 45.083 346.658 209.733 145.248C936.936 126.058 882.053-94.234 1031.02 41.331c119.18 108.451 130.68 295.337 121.53 375.223L855 299l21.173 362.054-558.954-142.079z" />
                                <defs>
                                    <linearGradient id="ecb5b0c9-546c-4772-8c71-4d3f06d544bc" x1="1155.49" x2="-78.208" y1=".177" y2="474.645" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#9089FC" />
                                        <stop offset="1" stop-color="#FF80B5" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <section id="cta">
                <DarkPanel />
            </section>
            <section id="get-started">
                <Features />
            </section>
            <section id="get-in-touch">
                <GetInTouch />
            </section>
            <section id="footer">
                <Footer />
            </section>
        </main>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { Dialog, DialogPanel } from "@headlessui/vue";
import { Bars3Icon, XMarkIcon } from "@heroicons/vue/24/outline";
import _ from "lodash";
import { usePage } from "@inertiajs/inertia-vue3";
import Features from "../Components/Tailwindui/Features.vue";
import Footer from "../Components/Tailwindui/Footer.vue";
import GetInTouch from "../Components/Tailwindui/GetInTouch.vue";
import DarkPanel from "../Components/Tailwindui/DarkPanel.vue";
import Terminal from "../Components/Terminal.vue";

const props = defineProps(["data"]);
const page = usePage();
const user = page.props.value.context.user;

const mobileMenuOpen = ref(false);
</script>

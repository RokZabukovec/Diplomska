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
                <nav class="flex h-9 items-center justify-between" aria-label="Global">
                    <div class="flex lg:min-w-0 lg:flex-1" aria-label="Global">
                        <a href="#" class="-m-1.5 p-1.5">
                            <span class="sr-only">Your Company</span>
                            <img class="h-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="" />
                        </a>
                    </div>
                    <div class="flex lg:hidden">
                        <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700" @click="mobileMenuOpen = true">
                            <span class="sr-only">Open main menu</span>
                            <Bars3Icon class="h-6 w-6" aria-hidden="true" />
                        </button>
                    </div>
                    <div class="hidden lg:flex lg:min-w-0 lg:flex-1 lg:justify-end" v-if="_.isEmpty(user)">
                        <a href="/login" class="inline-block rounded-lg px-3 py-1.5 text-sm font-semibold leading-6 text-gray-900 shadow-sm ring-1 ring-gray-900/10 hover:ring-gray-900/20 mr-2.5">Log in</a>
                        <a href="/register" class="inline-block rounded-lg px-3 py-1.5 text-sm font-semibold leading-6 text-gray-50 shadow-sm ring-1 ring-gray-900/10 hover:ring-gray-900/20 bg-gray-800">Register</a>
                    </div>
                    <div class="hidden lg:flex lg:min-w-0 lg:flex-1 lg:justify-end" v-else>
                        <a href="/dashboard" class="inline-block rounded-full px-3 py-1.5 text-sm font-semibold leading-6 text-gray-50 shadow-sm ring-1 ring-gray-900/10 hover:ring-gray-900/20 bg-blue-600">Dashboard</a>
                    </div>
                </nav>
                <Dialog as="div" :open="mobileMenuOpen" @close="mobileMenuOpen = false">
                    <DialogPanel focus="true" class="fixed inset-0 z-10 overflow-y-auto bg-white px-6 py-6 lg:hidden">
                        <div class="flex h-9 items-center justify-between">
                            <div class="flex">
                                <a href="#" class="-m-1.5 p-1.5">
                                    <span class="sr-only">Your Company</span>
                                    <img class="h-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="" />
                                </a>
                            </div>
                            <div class="flex">
                                <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700" @click="mobileMenuOpen = false">
                                    <span class="sr-only">Close menu</span>
                                    <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                                </button>
                            </div>
                        </div>
                        <div class="mt-6 flow-root">
                            <div class="-my-6 divide-y divide-gray-500/10">
                                <div class="py-6">
                                    <a href="/login" class="-mx-3 block rounded-lg py-2.5 px-3 text-base font-semibold leading-6 text-gray-900 hover:bg-gray-400/10">Log in</a>
                                </div>
                            </div>
                        </div>
                    </DialogPanel>
                </Dialog>
            </div>
        </div>
        <main>
            <div class="relative px-6 lg:px-8">
                <div class="mx-auto max-w-3xl pt-20 pb-32 sm:pt-48 sm:pb-40">
                    <div>
                        <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                            <div class="relative overflow-hidden rounded-full py-1.5 px-4 text-sm leading-6 ring-1 bg-blue-600 text-white border-none">
                                <span class="text-white">
                                    This platform is not yet complete.
                                </span>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold tracking-tight sm:text-center sm:text-6xl">{{$page.props.context.app_name}}</h1>
                            <p class="mt-6 text-lg leading-8 text-gray-600 sm:text-center">
                                "Are you tired of searching through old terminal windows to find that one command you need?
                                Try our web app and easily store and access all your terminal commands and information in one place."
                            </p>
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
            <section id="get-started">
                <Features/>
            </section>
        </main>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { Dialog, DialogPanel } from "@headlessui/vue";
import { Bars3Icon, XMarkIcon } from "@heroicons/vue/24/outline";
import _ from "lodash";
import {usePage} from "@inertiajs/inertia-vue3";
import Features from "../Components/Tailwindui/Features.vue";
import Footer from "../Components/Tailwindui/Footer.vue";
import GetInTouch from "../Components/Tailwindui/GetInTouch.vue";

const props = defineProps(["data"]);
const page = usePage();
const user = page.props.value.context.user;


const mobileMenuOpen = ref(false);
</script>

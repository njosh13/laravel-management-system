<template>
    <nav class="mx-auto flex h-10 border-b border-gray-100 bg-white" aria-label="Breadcrumb">
        <ol class="flex max-w-7xl items-center space-x-4 px-4 sm:px-6 lg:px-8">
            <li>
                <div>
                    <Link :href="route('dashboard')" class="text-gray-400 hover:text-gray-500">
                        <HomeIcon class="h-5 w-5 shrink-0" aria-hidden="true" />
                        <span class="sr-only">Tasks</span>
                    </Link>
                </div>
            </li>
            <li v-for="page in pages" :key="page.name">
                <div class="flex items-center">
                    <svg
                        class="h-5 w-5 shrink-0 text-gray-300"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        aria-hidden="true">
                        <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                    </svg>
                    <Link
                        :href="page.href"
                        class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
                        :aria-current="page.current ? 'page' : undefined"
                        >{{ page.name }}</Link
                    >
                </div>
            </li>
        </ol>
    </nav>
</template>

<script setup>
import { HomeIcon } from "@heroicons/vue/solid";
import { Link } from "@inertiajs/vue3";

defineProps({ pages: Array });
</script>

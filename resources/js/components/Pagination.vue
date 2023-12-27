<template>
    <div class="bg-gray flex items-center justify-between border-t border-gray-200 px-4 py-3 sm:px-6">
        <div class="flex flex-1 justify-between sm:hidden">
            <inertia-link
                v-if="prevPageUrl !== null"
                preserve-scroll
                :href="prevPageUrl"
                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                Previous
            </inertia-link>

            <span
                v-else
                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                Previous
            </span>

            <inertia-link
                preserve-scroll
                v-if="nextPageUrl !== null"
                :href="nextPageUrl"
                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                Next
            </inertia-link>

            <span
                v-else
                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                Next
            </span>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    {{ " " }}
                    <span class="font-medium" v-text="from"></span>
                    {{ " " }}
                    to
                    {{ " " }}
                    <span class="font-medium" v-text="to"></span>
                    {{ " " }}
                    of
                    {{ " " }}
                    <span class="font-medium" v-text="total"></span>
                    {{ " " }}
                    results
                </p>
            </div>
            <div>
                <nav class="relative z-0 inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                    <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                    <template v-for="(page, index) in links" :key="index">
                        <!-- Previous page link -->
                        <template v-if="index === 0">
                            <inertia-link
                                v-if="page.url !== null"
                                :href="page.url"
                                class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
                            </inertia-link>

                            <span
                                v-else
                                class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
                            </span>
                        </template>

                        <!-- Next page link -->
                        <template v-else-if="index === links.length - 1">
                            <inertia-link
                                v-if="page.url !== null"
                                :href="page.url"
                                class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Next</span>
                                <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
                            </inertia-link>

                            <span
                                v-else
                                class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Next</span>
                                <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
                            </span>
                        </template>

                        <!-- Three dots -->
                        <span
                            v-else-if="page.label === '...'"
                            class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700">
                            ...
                        </span>

                        <inertia-link
                            v-else
                            :href="page.url"
                            v-html="page.label"
                            :aria-current="page.active ? 'page' : false"
                            :class="{
                                'border-gray-300 bg-white text-gray-500 hover:bg-gray-50': !page.active,
                                'z-10 border-yellow-500 bg-yellow-50 text-yellow-600': page.active,
                            }"
                            class="relative inline-flex items-center border px-4 py-2 text-sm font-medium">
                        </inertia-link>
                    </template>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/solid";
import { Link } from "@inertiajs/vue3";
export default {
    components: {
        "inertia-link": Link,
        ChevronLeftIcon,
        ChevronRightIcon,
    },
    props: {
        from: {
            required: true,
            type: Number,
        },
        to: {
            required: true,
            type: Number,
        },
        total: {
            required: true,
            type: Number,
        },
        links: {
            required: true,
            type: Array,
        },
        prevPageUrl: {
            type: String,
        },
        nextPageUrl: {
            type: String,
        },
    },
};
</script>

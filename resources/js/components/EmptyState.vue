<template>
    <div class="mx-auto max-w-lg rounded-md bg-white py-6 text-center shadow-md">
        <component :is="icon" aria-hidden="true" class="mx-auto h-12 w-12 text-gray-400" />
        <h3 class="mt-2 text-sm font-medium text-gray-900" v-text="title"></h3>
        <p class="mt-1 text-sm text-gray-500" v-text="description"></p>
        <div class="mt-6">
            <AppButtonLink v-if="actionHref" :href="actionHref" class="capitalize" size="base" variant="white">
                <PlusIcon aria-hidden="true" class="-ml-1 mr-2 h-5 w-5" />
                {{ actionText }}
            </AppButtonLink>
        </div>
    </div>
</template>

<script setup>
import { PlusIcon } from "@heroicons/vue/solid";
import AppButtonLink from "./AppButtonLink.vue";

defineProps({
    icon: { required: true },
    title: { required: true, type: String },
    description: { required: true, type: String },
    actionText: { type: String },
    actionHref: { type: String },
});
</script>

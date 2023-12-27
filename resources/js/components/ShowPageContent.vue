<template>
    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">
                <slot name="title" />
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500"><slot name="description" /></p>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
            <slot> </slot>
        </div>
    </div>
</template>

<script>
import { PaperClipIcon } from "@heroicons/vue/solid";
</script>

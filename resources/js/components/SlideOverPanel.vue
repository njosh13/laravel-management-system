<template>
    <TransitionRoot :show="open" as="template">
        <Dialog as="div" auto-reopen="true" class="fixed inset-0 z-20 overflow-hidden" @close="$emit('close')">
            <div class="absolute inset-0 overflow-hidden">
                <TransitionChild
                    as="template"
                    enter="ease-in-out duration-500"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in-out duration-500"
                    leave-from="opacity-100"
                    leave-to="opacity-0">
                    <DialogOverlay class="absolute inset-0 bg-gray-500/75 transition-opacity" />
                </TransitionChild>
                <div class="fixed inset-y-0 right-0 flex max-w-full pl-10">
                    <TransitionChild
                        as="template"
                        enter="transform transition ease-in-out duration-500 sm:duration-700"
                        enter-from="translate-x-full"
                        enter-to="translate-x-0"
                        leave="transform transition ease-in-out duration-500 sm:duration-700"
                        leave-from="translate-x-0"
                        leave-to="translate-x-full">
                        <div class="w-screen" :class="[wide ? 'max-w-2xl' : 'max-w-md']">
                            <div class="flex h-full flex-col divide-y divide-gray-200 bg-white shadow-xl">
                                <div class="flex min-h-0 flex-1 flex-col overflow-y-scroll py-6">
                                    <div class="border-b-2 border-gray-200 px-4 pb-4 sm:px-6">
                                        <div class="flex items-start justify-between">
                                            <DialogTitle class="text-lg font-medium text-gray-900">
                                                {{ title }}
                                            </DialogTitle>
                                            <div class="ml-3 flex h-7 items-center">
                                                <button
                                                    class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                    @click="$emit('close')">
                                                    <span class="sr-only">Close panel</span>
                                                    <XIcon aria-hidden="true" class="h-6 w-6" />
                                                </button>
                                            </div>
                                        </div>
                                        <div v-if="!!$slots.description" class="mt-2">
                                            <slot name="description" />
                                        </div>
                                    </div>
                                    <div class="relative mt-6 flex-1 px-4 sm:px-6">
                                        <slot name="content" />
                                    </div>
                                </div>
                                <div class="shrink-0">
                                    <slot name="footer" />
                                </div>
                            </div>
                        </div>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from "@headlessui/vue";
import { XIcon } from "@heroicons/vue/outline";

defineProps({
    title: { required: true, type: String },
    open: { type: Boolean, default: false },
    wide: { type: Boolean, default: false },
});

defineEmits(["close"]);
</script>

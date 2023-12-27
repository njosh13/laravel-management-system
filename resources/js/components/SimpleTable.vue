<template>
    <div class="mt-5 flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200" :class="{ 'table-fixed': fixedLayout }">
                        <thead class="bg-gray-100">
                            <slot name="thead" />
                        </thead>
                        <tbody>
                            <slot name="tbody" />
                        </tbody>
                    </table>

                    <slot name="pagination" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    fixedLayout: { type: Boolean, required: false, default: false },
});
</script>

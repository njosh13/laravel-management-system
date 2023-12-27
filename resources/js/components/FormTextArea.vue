<template>
    <textarea
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        rows="5"
        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
</template>

<script setup>
defineProps({
    modelValue: { type: String, default: "" },
});
defineEmits(["update:modelValue"]);
</script>

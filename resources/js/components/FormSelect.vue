<template>
    <div class="flex items-center">
        <select
            :value="modelValue"
            :required="required"
            placeholder="select"
            @input="$emit('update:modelValue', $event.target.value)"
            class="ml-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <slot />
        </select>
    </div>
</template>

<script setup>
defineProps({
    modelValue: { type: [String, Number], default: "" },
    required: { type: Boolean, default: false },
});
</script>

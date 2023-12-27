<template>
    <flat-pickr
        type="date"
        :modelValue="modelValue"
        :required="required"
        @input="$emit('update:modelValue', $event.target.value)"
        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
</template>

<script setup>
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";
defineProps({
    modelValue: { type: [Date, String], default: "" },
    required: { type: Boolean, default: false },
});
</script>

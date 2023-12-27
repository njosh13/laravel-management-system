<script>
export default {
    props: ["modelValue"],

    emits: ["update:modelValue"],
};
</script>

<template>
    <select
        class="rounded-md border-gray-300 text-base shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        @input="$emit('update:modelValue', $event.target.value)"
        :value="modelValue"
        v-bind="$attrs">
        >
        <slot />
    </select>
</template>

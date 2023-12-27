<template>
    <th
        scope="col"
        class="px-6 py-3"
        :class="[
            action ? 'relative' : `text-xs font-medium uppercase tracking-wider text-gray-900 ${alignClass[align]}`,
        ]">
        <slot />
    </th>
</template>

<script setup>
const props = defineProps({
    action: {
        type: Boolean,
        default: false,
    },
    align: {
        type: String,
        default: "left",
        validator(value) {
            return ["left", "right", "center"].includes(value);
        },
    },
});

const alignClass = {
    left: "text-left",
    right: "text-right",
    center: "text-center",
};
</script>

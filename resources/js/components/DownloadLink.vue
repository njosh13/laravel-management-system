<template>
    <a
        v-bind="$attrs"
        class="cursor-pointer rounded-md bg-white text-yellow-600 hover:text-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
        <slot></slot>
    </a>
</template>

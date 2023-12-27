<template>
    <Link
        :href="href"
        class="inline-flex items-center border font-medium shadow-sm transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        :class="[sizeClass, variantClass, fullWidth ? 'w-full justify-center' : '']">
        <slot></slot>
    </Link>
</template>

<script>
import { Link } from "@inertiajs/vue3";

const sizeClasses = {
    xs: "px-2.5 py-1.5 text-xs rounded",
    sm: "px-3 py-2 text-sm leading-4 rounded-md",
    base: "px-4 py-2 text-sm rounded-md",
    lg: "px-4 py-2 text-base rounded-md",
    xl: "px-6 py-3 text-base rounded-md",
};
const variantClasses = {
    primary: "text-white bg-gray-800 hover:bg-gray-700 border-transparent",
    secondary: "text-gray-800 bg-gray-300 hover:bg-gray-400 border-transparent",
    accent: "text-yellow-700 bg-yellow-200 hover:bg-yellow-300 border-transparent",
    white: "text-gray-700 bg-white hover:bg-gray-50 border-gray-300",
};

export default {
    components: {
        Link,
    },
    props: {
        href: {
            type: String,
            required: true,
        },
        size: {
            type: String,
            default: "base",
            validator(value) {
                return ["xs", "sm", "base", "lg", "xl"].includes(value);
            },
        },
        variant: {
            type: String,
            required: true,
            validator(value) {
                return ["primary", "accent", "secondary", "white"].includes(value);
            },
        },
        fullWidth: {
            type: Boolean,
            default: false,
        },
    },
    setup(props) {
        return {
            sizeClass: sizeClasses[props.size],
            variantClass: variantClasses[props.variant],
        };
    },
};
</script>

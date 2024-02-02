<script setup lang="ts">
import { tv, type VariantProps } from "tailwind-variants";

const props = defineProps({
    variant: String,
    size: String,
    shape: String,
    class: String,
});

defineEmits(["click"]);

const buttonVariants = tv({
    base: "font-bold",
    variants: {
        variant: {
            primary: "bg-blue-500 text-white",
            secondary: "bg-gray-400 text-white",
            success: "bg-green-500 text-white",
            danger: "bg-red-500 text-white",
            warning: "bg-yellow-500 text-white",
            info: "bg-blue-500 text-white",
        },
        size: {
            small: "text-sm px-3 py-1",
            medium: "text-md px-5 py-2",
            large: "text-lg px-8 py-3",
        },
        shape: {
            squared: "rounded-md",
            rounded: "rounded-full",
        },
    },
    defaultVariants: {
        shape: "squared",
        size: "medium",
        variant: "primary",
    },
});

const classes = buttonVariants({
    variant: props.variant,
    size: props.size,
    shape: props.shape,
    class: props.class,
});
</script>

<template>
    <button v-bind="$attrs" :class="classes">
        <slot />
    </button>
</template>

<script setup lang="ts">
import { CategoryModel } from "../../types";

defineProps<{
    category: CategoryModel;
}>();


</script>

<template>
    <a
        :href="'/events?category='+category.name"
        class="flex flex-col justify-between gap-4 rounded-md border border-solid border-zinc-300 p-4 shadow transition-transform hover:scale-110"
    >
        <h3 class="text-center text-xl font-bold">
            {{ category.name }}
        </h3>

        <p class="inline-flex flex-col gap-2 text-center">
            <span class="text-4xl font-black">
                {{ category.events_count }}
            </span>
            évènement{{ category.events_count > 1 ? "s" : "" }}
        </p>
    </a>
</template>

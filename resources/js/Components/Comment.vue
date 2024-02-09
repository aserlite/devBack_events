<script setup>
import { defineProps } from 'vue';

const props = defineProps(['comment']);
</script>


<template>
    <div class="mt-4 border-b pb-4">
        <div class="flex items-center mt-2">
            <h4 class="text-lg font-semibold">{{ comment.user_name }}</h4>
            <div class="flex items-center gap-1 ml-4">
                <span class="text-yellow-500">{{ comment.grade }}/5</span>
            </div>
        </div>
        <h3 class="mt-2">{{ comment.title }}</h3>
        <p class="text-gray-600">{{ comment.content }}</p>
    </div>
</template>

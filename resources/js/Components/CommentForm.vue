<script setup>
import { ref, defineProps } from 'vue';
import axios from 'axios';

const props = defineProps(['eventId']);
const title = ref('');
const grade = ref(0);
const content = ref('');

const submitComment = () => {
    axios.post(`/events/${props.eventId}/comments`, {
        title: title.value,
        grade: grade.value,
        content: content.value,
    })
        .then(response => {
            console.log('Comment submitted successfully:', response.data);
            location.reload();
        })
        .catch(error => {
            console.error('Error submitting comment:', error);
        });
};
</script>

<template>
    <form @submit.prevent="submitComment" class="mt-4">
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-3 sm:col-span-2">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input v-model="title" type="text" id="title" name="title" class="mt-1 p-2 border rounded-md w-full">
            </div>
            <div class="col-span-3 sm:col-span-1">
                <label for="grade" class="block text-sm font-medium text-gray-700">Grade (0-5)</label>
                <input v-model="grade" type="number" id="grade" name="grade" class="mt-1 p-2 border rounded-md w-full">
            </div>
            <div class="col-span-3">
                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                <textarea v-model="content" id="content" name="content" rows="4" class="mt-1 p-2 border rounded-md w-full"></textarea>
            </div>
        </div>
        <button type="submit" class="mt-4 px-4 py-2 text-white bg-blue-500 rounded-md">Submit Comment</button>
    </form>
</template>

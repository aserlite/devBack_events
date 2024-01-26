<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    event: Object,
})

console.log(event);

</script>

<template>
    <AppLayout title="Events.show">
        {{ event.title }}
    </AppLayout>
</template>

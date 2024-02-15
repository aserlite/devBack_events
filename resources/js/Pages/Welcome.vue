<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from "@inertiajs/vue3";
import { EventModel, CategoryModel } from "../types";
import { CalendarFold, User } from "lucide-vue-next";
import EventCard from "../Components/ui/EventCard.vue";
import CategoryCard from "../Components/ui/CategoryCard.vue";
import GuestLayout from "../Layouts/GuestLayout.vue";

defineProps<{
    canLogin: boolean;
    canRegister: boolean;
    upcomingEvents: EventModel[];
    popularCategories: CategoryModel[];
}>();
</script>

<template>
    <div v-if="$page.props.auth.user">
        <AppLayout title="Welcome" />
    </div>
    <div v-else>
        <GuestLayout title="Welcome" />
    </div>
        <div class="flex flex-col items-center gap-2 bg-black py-56 text-white">
            <h1 class="text-5xl">EventMaker</h1>
            <p class="text-lg text-zinc-300">
                Participez à des évènements, partagez des moments inoubliables avec
                vos amis et rencontrez du monde
            </p>
        </div>

        <div class="container mx-auto flex flex-col gap-4 py-32">
            <h2 class="text-center text-4xl font-bold text-zinc-700">
                Nos 5 prochains évènements
            </h2>

            <div class="grid grid-cols-5 gap-4">
                <template v-for="event in upcomingEvents" :key="event.id">
                    <EventCard :event="event" />
                </template>
            </div>
        </div>

        <div class="container mx-auto flex flex-col gap-4 py-16">
            <h2 class="text-center text-4xl font-bold text-zinc-700">
                Les catégories les plus populaires
            </h2>

            <div class="grid grid-cols-5 gap-4">
                <template v-for="category in popularCategories" :key="category.id">
                    <CategoryCard
                        :category="category"
                    />
                </template>
            </div>
        </div>
</template>

<script setup lang="ts">
import { Head, Link } from "@inertiajs/vue3";
import { EventModel, CategoryModel } from "../types";
import { CalendarFold, User } from "lucide-vue-next";
import EventCard from "../Components/ui/EventCard.vue";

defineProps<{
    canLogin: boolean;
    canRegister: boolean;
    upcomingEvents: EventModel[];
    popularCategories: CategoryModel[];
}>();
</script>

<template>
    <Head title="Welcome" />

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
            <div
                v-for="category in popularCategories"
                :key="category.id"
                class="flex flex-col justify-between gap-4 rounded-md border border-solid border-zinc-300 p-4 shadow hover:scale-110"
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
            </div>
        </div>
    </div>
</template>

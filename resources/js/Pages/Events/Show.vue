<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import dayjs from "dayjs";
import "dayjs/locale/fr";
import { CalendarFold, MapPinned } from "lucide-vue-next";
import { EventModel } from "../../types";
import Button from "../../Components/Button.vue";

dayjs.locale("fr");

defineProps<{
    event: EventModel;
}>();
</script>

<template>
    <AppLayout title="Events.show">
        <div v-if="!event">Aucun évènement trouvé.</div>

        <div
            v-else
            class="container mx-auto mt-8 grid grid-cols-1 gap-4 md:grid-cols-2"
        >
            <div class="aspect-square w-full bg-zinc-500"></div>
            <!-- <img src="./" class="" alt="" /> -->

            <div class="flex flex-col gap-4">
                <h1 class="text-4xl font-bold">{{ event.title }}</h1>
                <p class="text-2xl font-bold">{{ event.price }}€</p>
                <p class="text-gray-500">{{ event.description }}</p>
                <p
                    class="inline-flex w-max items-center gap-4 rounded-full border-2 border-blue-700 bg-blue-100 px-4 py-1.5 font-bold text-blue-700"
                >
                    <CalendarFold />
                    Du {{ dayjs(event?.start_date).format("DD MMMM YYYY") }} au
                    {{ dayjs(event?.end_date).format("DD MMMM YYYY") }}
                </p>

                <p class="inline-flex gap-2 rounded-md bg-gray-50 p-4">
                    <MapPinned />
                    {{ event.location }}
                </p>

                <div class="flex flex-wrap gap-2">
                    <Button variant="primary">Participer</Button>
                    <Button variant="secondary">Intéressé</Button>
                </div>
            </div>
        </div>

        <pre>{{ JSON.stringify(event, null, 2) }}</pre>
    </AppLayout>
</template>

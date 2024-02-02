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
    storage_path: string;
    participating: boolean;
    nb_participants: bigint;
}>();
</script>

<template>
    <AppLayout title="Events.show">
        <div v-if="!event">Aucun évènement trouvé.</div>

        <div
            v-else
            class="container mx-auto mt-8 grid grid-cols-1 gap-4 md:grid-cols-2"
        >

            <img :src="'/storage/' + event.image " class="w-full aspect-square bg-zinc-500" alt="" />
            <div class="flex flex-col gap-4">
                <h3 class="text-xl text-slate-500	">{{ nb_participants }} participants</h3>
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
        <a :href='"/events/"+event.id+"/participate"' v-if="participating == false" class="bg-blue-500 text-white">Participer</a>
        <a :href='"/events/"+event.id+"/participate"' v-else class="bg-gray-500 text-white">Je ne participe plus</a>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import dayjs from "dayjs";
import "dayjs/locale/fr"
import { CalendarFold , MapPinned } from "lucide-vue-next";
import Button from "../../Components/Button.vue";

dayjs.locale("fr")
defineProps<{
    storage_path: '',
    participating: boolean,
    nb_participants: bigint,
    event: {
        id: number;
        title: string;
        description: string;
        start_date: string;
        end_date: string;
        location: string;
        capacity: number;
        price: number;
        image:string;
        created_at: string;
        updated_at: string;
    };
}>(
);
</script>

<template>
    <AppLayout title="Events.show">
        <div v-if="!event">
            Aucun évènement trouvé.
        </div>

        <div v-else class="mx-auto container mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">

            <img :src="'/storage/' + event.image " class="w-full aspect-square bg-zinc-500" alt="" />
            <div>
                <h3 class="text-xl text-slate-500	">{{ nb_participants }} participants</h3>
                <h1 class="text-4xl font-bold">{{ event.title }}</h1>
                <p class="text-gray-500">{{ event.description }}</p>
                <p
                    class="inline-flex items-center gap-4 font-bold text-blue-700 rounded-full px-4 py-1.5 bg-blue-100 w-max border-2 border-blue-700"
                >
                    <CalendarFold />
                    Du {{ dayjs(event?.start_date).format("DD MMMM YYYY") }} au
                    {{ dayjs(event?.end_date).format("DD MMMM YYYY") }}
                </p>

                <p class="inline-flex gap-2 p-4 rounded-md bg-gray-50">
                    <MapPinned />
                    {{ event.location }}
                </p>

            </div>

        </div>
        <Button variant="secondary">Participer</Button>

        <a :href='"/events/"+event.id+"/participate"' v-if="participating == false" class="bg-blue-500 text-white">Participer</a>
        <a :href='"/events/"+event.id+"/participate"' v-else class="bg-gray-500 text-white">Je ne participe plus</a>
    </AppLayout>
</template>

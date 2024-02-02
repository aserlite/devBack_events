<script setup lang="ts">
import { CalendarFold, User } from "lucide-vue-next";
import { EventModel } from "../../types";
import dayjs from "dayjs";

defineProps<{
    event: EventModel;
}>();
</script>

<template>
    <div
        class="flex flex-col justify-between rounded-md border border-solid border-zinc-300 p-4 shadow transition-transform hover:scale-110"
    >
        <div>
            <!-- Most important informations -->
            <div class="flex items-start justify-between gap-2">
                <p class="text-xl font-bold">{{ event.title }}</p>
                <p class="text-xl font-bold">{{ event.price }}€</p>
            </div>

            <!-- Dates -->
            <div class="inline-flex items-center gap-2 p-2">
                <span>{{ dayjs(event.start_date).format("DD/MM/YYYY") }}</span>
                -
                <span>{{ dayjs(event.end_date).format("DD/MM/YYYY") }}</span>
            </div>

            <!-- Max capacity -->
            <p
                class="inline-flex flex-wrap items-center gap-2 text-xs text-zinc-600"
            >
                <User />
                Capacité maximale de {{ event.capacity }}
            </p>
        </div>

        <!-- Location -->
        <p
            class="mt-auto inline-flex flex-wrap items-center gap-2 rounded-md border border-solid border-zinc-300 p-2 text-zinc-600"
        >
            <CalendarFold />
            {{ event.location }}
        </p>
    </div>
</template>

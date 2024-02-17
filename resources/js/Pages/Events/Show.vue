<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Comment from "@/Components/Comment.vue";
import CommentForm from "@/Components/CommentForm.vue";
import dayjs from "dayjs";
import "dayjs/locale/fr";
import { CalendarFold, MapPinned } from "lucide-vue-next";
import Button from "../../Components/Button.vue";
import { Link } from "@inertiajs/vue3";
import EventCard from "../../Components/ui/EventCard.vue";

dayjs.locale("fr");
let props = defineProps<{
    storage_path: "";
    participating: boolean;
    is_admin: boolean;
    nb_participants: bigint;
    previousUrl: string;
    categories: object;
    comments: object;
    outdated: boolean;
    sameLocation: object;
    sameCategory: object;
    event: {
        id: number;
        title: string;
        description: string;
        start_date: string;
        end_date: string;
        location: string;
        capacity: number;
        price: number;
        image: string;
        created_at: string;
        updated_at: string;
    };
}>();
</script>

<template>
    <div class="container mx-auto">
        <div v-if="$page.props.auth.user">
            <AppLayout title="Welcome" />
        </div>
        <div v-else>
            <GuestLayout title="Welcome" />
        </div>

        <Link :href="$page.props.previousUrl" class="">Retour</Link>

        <div v-if="!event">Aucun évènement trouvé.</div>

        <div v-else class="mt-8 grid grid-cols-1 gap-4 md:grid-cols-2">
            <img
                :src="'/storage/' + event.image"
                class="aspect-square w-full bg-zinc-500"
                alt=""
            />
            <div>
                <div class="flex items-center gap-2">
                    <h3 class="text-xl text-slate-500">
                        {{ nb_participants }} participants
                    </h3>
                    <div v-if="!is_admin">
                        <a
                            :href="'/events/' + event.id + '/participate'"
                            v-if="participating == false"
                            class="rounded-md bg-blue-500 px-2 py-1 text-white"
                        >
                            Participer
                        </a>
                        <a
                            :href="'/events/' + event.id + '/participate'"
                            v-else
                            class="rounded-md bg-gray-500 px-2 py-1 text-white"
                        >
                            Je ne participe plus
                        </a>
                    </div>
                    <div v-else>
                        <a
                            :href="'/admin/events/' + event.id + '/edit'"
                            class="bg-blue-500 text-white"
                            >Editer cet évement</a
                        >
                    </div>
                </div>
                <h1 class="text-4xl font-bold">{{ event.title }}</h1>
                <div v-for="category in categories">
                    <a
                        :href="'/events?category=' + category.name"
                        class="me-2 rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300"
                    >
                        {{ category.name }}
                    </a>
                </div>
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
            </div>
        </div>

        <div class="flex flex-col gap-4 py-32" v-if="sameLocation.length">
            <h2 class="text-center text-4xl font-bold text-zinc-700">
                Nos évènements dans la meme ville
            </h2>

            <div class="grid grid-cols-5 gap-4">
                <template v-for="event in sameLocation" :key="event.id">
                    <EventCard :event="event" />
                </template>
            </div>
        </div>

        <div class="flex flex-col gap-4 py-32" v-if="sameCategory.length">
            <h2 class="text-center text-4xl font-bold text-zinc-700">
                Nos évènements similaires
            </h2>

            <div class="grid grid-cols-5 gap-4">
                <template v-for="event in sameCategory" :key="event.id">
                    <EventCard :event="event" />
                </template>
            </div>
        </div>

        <div v-if="outdated">
            <div v-if="comments.length > 0">
                <h2 class="mt-8 text-2xl font-semibold">Comments</h2>
                <div class="">
                    <Comment
                        v-for="comment in comments"
                        :key="comment.id"
                        :comment="comment"
                    />
                </div>
            </div>

            <div v-if="$page.props.auth.user">
                <h2 class="mt-8 text-2xl font-semibold">Add a Comment</h2>
                <CommentForm :eventId="event.id" />
            </div>
        </div>
    </div>
</template>

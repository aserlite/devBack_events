<script setup>
import { ref, onMounted } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { useForm } from "@inertiajs/vue3";
import GuestLayout from "../../Layouts/GuestLayout.vue";

const props = defineProps(["events", "storage_path"]);

const urlSearchParams = new URLSearchParams(window.location.search);
const location = ref(urlSearchParams.get("location"));
const category = ref(urlSearchParams.get("category"));
const orderBy = ref(urlSearchParams.get("order_by"));
const startDate = ref(urlSearchParams.get("start_date"));
const maxPrice = ref(urlSearchParams.get("max_price"));

const form = useForm({
    location: location.value,
    category: category.value,
    order_by: orderBy.value,
    start_date: startDate.value,
    max_price: maxPrice.value,
});

const applyFilters = () => {
    const routeParams = {
        location: form.location,
        category: form.category,
        order_by: form.order_by,
        start_date: form.start_date,
        max_price: form.max_price,
    };

    form.get(route("events"), routeParams);
};
</script>

<template>
    <div v-if="$page.props.auth.user">
        <AppLayout title="Welcome" />
    </div>
    <div v-else>
        <GuestLayout title="Welcome" />
    </div>

    <div class="container mx-auto">
        <form
            @submit.prevent="applyFilters"
            class="container sticky top-0 my-4 flex items-center justify-between gap-4 rounded-md border border-zinc-100 bg-white p-2"
        >
            <div class="flex items-center gap-4">
                <div>
                    <label
                        for="location"
                        class="block text-sm font-medium text-gray-700"
                        >Location
                    </label>
                    <input
                        v-model="form.location"
                        type="text"
                        id="location"
                        name="location"
                        class="mt-1 rounded-md border p-2"
                    />
                </div>

                <div>
                    <label
                        for="category"
                        class="block text-sm font-medium text-gray-700"
                        >Category
                    </label>
                    <input
                        v-model="form.category"
                        type="text"
                        id="category"
                        name="category"
                        class="mt-1 rounded-md border p-2"
                    />
                </div>

                <div>
                    <label
                        for="startDate"
                        class="block text-sm font-medium text-gray-700"
                        >Start Date
                    </label>
                    <input
                        v-model="form.start_date"
                        type="date"
                        id="startDate"
                        name="startDate"
                        class="mt-1 rounded-md border p-2"
                    />
                </div>

                <div>
                    <label
                        for="maxPrice"
                        class="block text-sm font-medium text-gray-700"
                        >Max Price {{ form.max_price }}</label
                    >
                    <input
                        v-model="form.max_price"
                        type="range"
                        id="maxPrice"
                        name="maxPrice"
                        class="mt-1 rounded-md border p-2"
                        min="0"
                        max="1000"
                    />
                </div>

                <div>
                    <label
                        for="orderBy"
                        class="block text-sm font-medium text-gray-700"
                        >Order By
                    </label>
                    <select
                        v-model="form.order_by"
                        id="orderBy"
                        name="orderBy"
                        class="mt-1 rounded-md border p-2"
                    >
                        <option value="default">Default</option>
                        <option value="price_asc">Price Ascending</option>
                        <option value="price_desc">Price Descending</option>
                        <option value="location">Location</option>
                        <option value="start_date_asc">
                            Start Date Ascending
                        </option>
                        <option value="start_date_desc">
                            Start Date Descending
                        </option>
                    </select>
                </div>
            </div>

            <button
                type="submit"
                class="rounded-md bg-blue-500 px-4 py-2 text-white"
            >
                Apply Filters
            </button>
        </form>

        <div class="grid grid-cols-3 gap-8">
            <a
                v-for="event in events.data"
                :key="event.id"
                :href="route('events.show', event)"
                class="block rounded-lg p-4 shadow-sm shadow-indigo-100"
            >
                <img
                    :src="'/storage/' + event.image"
                    class="h-56 w-full rounded-md object-cover"
                />

                <div class="mt-2">
                    <dl>
                        <div>
                            <dt class="sr-only">Address</dt>

                            <dd class="text-sm text-gray-500">
                                {{ event.location }}
                            </dd>
                        </div>

                        <div>
                            <dt class="sr-only">Title</dt>

                            <dd class="font-medium">{{ event.title }}</dd>
                        </div>
                    </dl>

                    <div class="mt-6 flex items-center gap-8 text-xs">
                        <div
                            class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2"
                        >
                            <svg
                                style="color: blue"
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-coin"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z"
                                    fill="blue"
                                ></path>
                                <path
                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"
                                    fill="blue"
                                ></path>
                                <path
                                    d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"
                                    fill="blue"
                                ></path>
                            </svg>

                            <div class="mt-1.5 sm:mt-0">
                                <p class="text-gray-500">Price</p>

                                <p class="font-medium">{{ event.price }}</p>
                            </div>
                        </div>

                        <div
                            class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2"
                        >
                            <svg
                                class="h-4 w-4 text-indigo-700"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"
                                />
                            </svg>

                            <div class="mt-1.5 sm:mt-0">
                                <p class="text-gray-500">Capacity</p>

                                <p class="font-medium">{{ event.capacity }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <Pagination class="mt-6" :links="events.links" />
    </div>
</template>

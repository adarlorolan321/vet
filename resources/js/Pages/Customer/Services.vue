<script>
import CustomerLayout from "@/Layouts/CustomerLayout.vue";

export default {
    props: {
        data: Object,
    },
    components: {
        CustomerLayout,
    },
    computed: {},
    data() {},
    watch: {},
    methods: {},
};
</script>
<script setup>
import { computed, onBeforeMount, onMounted, ref } from "vue";
import { useForm, usePage, router } from "@inertiajs/vue3";
const data = computed(() => {
    return usePage().props;
});
</script>
<template>
    <CustomerLayout>
        <div class="container mx-auto my-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <!-- First Card -->

                <div
                    class="flex flex-col shadow-lg rounded-lg"
                    v-for="(item, index) in data.services"
                    :key="item"
                >
                    <div
                        :id="`carouselExample${index}`"
                        class="carousel slide"
                        data-bs-ride="carousel"
                    >
                        <div class="carousel-inner">
                            <div
                                v-for="(photo, index) in item.photo"
                                :key="photo"
                                class="carousel-item"
                                :class="{ active: index === 0 }"
                            >
                                <img
                                    v-if="photo.src"
                                    :src="photo.src"
                                    class="w-full h-48 object-cover"
                                    alt="Placeholder 1"
                                />
                                <img
                                    v-else
                                    src="/img/sevice-1.jpg"
                                    class="w-full h-48 object-cover"
                                    alt="Service"
                                />
                            </div>
                        </div>
                        <button
                            class="carousel-control-prev"
                            type="button"
                            :data-bs-target="`#carouselExample${index}`"
                            data-bs-slide="prev"
                        >
                            <span
                                class="carousel-control-prev-icon"
                                aria-hidden="true"
                            ></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button
                            class="carousel-control-next"
                            type="button"
                            :data-bs-target="`#carouselExample${index}`"
                            data-bs-slide="next"
                        >
                            <span
                                class="carousel-control-next-icon"
                                aria-hidden="true"
                            ></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div class="p-4">
                        <h5 class="text-lg font-bold mb-2">{{ item.name }}</h5>
                        <p class="text-gray-600">{{ item.description }}</p>
                        <div class="d-flex gap-2">
                            <p class="text-gray-600 text-bold p-0">
                                <span class="font-bold">PRICE: </span
                                >{{ item.price }}
                            </p>
                            |
                            <p class="text-gray-600 text-bold p-0">
                                <span class="font-bold">DURATION: </span
                                >{{ item.duration }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Second Card -->
            </div>
        </div>
    </CustomerLayout>
</template>

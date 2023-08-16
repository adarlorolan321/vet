<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref, onMounted } from "vue";
import moment from "moment";
import FullCalendar from "@fullcalendar/vue3";
import Dropzone from "../../../Components/Dropzone.vue";

export default {
    props: {
        data: Object,
    },
    components: {
        FullCalendar, // make the <FullCalendar> tag available
        AuthenticatedLayout,
        moment,
        Dropzone,
    },
    computed: {},
    data() {
        return {};
    },
    watch: {},
    methods: {},
};
</script>
<script setup>
import { Head, useForm, router } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

let form = useForm({
    name: null,
    description: null,
    duration: null,
    photo: [],
    price: null
});

const showModal = ref(false);

const editServices =(data)=>{
    showModal.value = true
    form.id = data.id,
    form.name = data.name,
    form.description = data.description,
    form.duration = data.duration,
    form.price = data.price
    form.photo  = JSON.parse(data.photo);
    console.log(form.photo);
}

const resetInput = () => {
    showModal.value = false;
    form.name = null;
    form.description = null;
    form.duration = null;
    form.price = null;
    form.photo = [];
    form.id = null;
}

const closeModal = () => {
    resetInput();
    showModal.value = false;
}

const submitForm = async () => {

    if (form.id) {
        console.log(form)
        await form.patch(route("dental-services.update", form.id), {
            onSuccess: () => {

                resetInput();
            },

        });
    }
    else{
        await form.post(route("dental-services.store"), {
            onSuccess: () => {
                resetInput();
            },
        });
    }

}
const deleteServices = (id)=>{
    form.delete(route("dental-services.destroy", id))
}
</script>

<template>
    <authenticated-layout>
        <div
            class="fixed inset-0 flex items-center justify-center z-50  bg-opacity-50"
            v-if="showModal"
        >
            <div
                class="bg-white p-8 rounded-lg shadow-lg max-w-xl min-w-xl scroll-m-9"
            >
                <h2 class="text-2xl font-bold mb-4" @click="showModal = true">
                    Add Details
                </h2>
                <form @submit.prevent="submitForm">
                    <div class="row">
                        <div class="mb-4">
                            <label for="date" class="block text-gray-600 mb-2">
                                Service Name
                            </label>
                            <input
                                v-model="form.name"
                                type="text"
                                id="name"
                                name="name"
                                class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200"
                            />
                        </div>
                        <div class="mb-4">
                            <label
                                for="description"
                                class="block text-gray-600 mb-2"
                            >
                                Description
                            </label>
                            <input
                                v-model="form.description"
                                type="text"
                                id="description"
                                name="description"
                                class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200"
                            />
                        </div>
                        <div class="mb-4">
                            <label
                                for="time_end"
                                class="block text-gray-600 mb-2"
                            >
                                Duration
                            </label>
                            <input
                                v-model="form.duration"
                                type="time"
                                id="duration"
                                name="duration"
                                class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200"
                            />
                        </div>
                        <div class="mb-4">
                            <label
                                for="time_end"
                                class="block text-gray-600 mb-2"
                            >
                                Price
                            </label>
                            <input
                                v-model="form.price"
                                type="number"
                                id="price"
                                name="price"
                                class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200"
                            />
                        </div>
                        <Dropzone
                            class="bg-white p-8 rounded-lg shadow-lg mb-2"
                            collection="services"
                            :url="route('api.media.upload')"
                            :value="form.photo"
                            @input="
                                ($event) => {
                                    form.photo = $event;
                                    form.clearErrors('photo');
                                }
                            "
                            @error="
                                ($event) => {
                                    if ($event && $event[0]) {
                                        form.setError('photo', $event[0]);
                                    }
                                }
                            "
                            model="Admin\DentalService"
                            message="Drop files here or click to upload profile photo"
                            acceptedFiles="image/jpeg,image/png"
                        ></Dropzone>
                    </div>

                    <div class="text-right">
                        <button
                            type="button"
                            class="text-gray-600 px-4 py-2 mr-2"
                            @click="closeModal"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="bg-green-template text-white px-4 py-2 rounded"
                        >
                        {{ form.id?'Update' :'Add' }}
                            
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="container mx-auto">
          
            <button
                class="bg-green-template text-white px-3 py-2 rounded mr-auto mt-10"
                @click="showModal = true"
            >
                Add Services
            </button>
            <div class="bg-white shadow-md rounded my-6 overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                scope="col"
                                class="px-5 py-3 bg-green-template text-white font-semibold uppercase tracking-wider"
                            >
                                Service Name
                            </th>
                            <th
                                scope="col"
                                class="px-5 py-3 bg-green-template text-white font-semibold uppercase tracking-wider"
                            >
                                Description
                            </th>
                            <th
                                scope="col"
                                class="px-5 py-3 bg-green-template text-white font-semibold uppercase tracking-wider"
                            >
                                Duration
                            </th>
                            <th
                                scope="col"
                                class="px-5 py-3 bg-green-template text-white font-semibold uppercase tracking-wider"
                            >
                                Price
                            </th>
                            <th
                                scope="col"
                                class="px-5 py-3 bg-green-template text-white font-semibold uppercase tracking-wider"
                            >
                                Action
                            </th>
                            <!-- Add more table headers if needed -->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Replace the example data with your dynamic data -->
                        <tr v-for="data in data.data" :key="data">
                            <td
                                class="px-5 py-3 border-b border-gray-200 bg-white text-sm"
                            >
                                {{ data.name }}
                            </td>
                            <td
                                class="px-5 py-3 border-b border-gray-200 bg-white text-sm"
                            >
                                {{ data.description }}
                            </td>
                            <td
                                class="px-5 py-3 border-b border-gray-200 bg-white text-sm"
                            >
                                {{ data.duration }}
                            </td>
                            <td
                                class="px-5 py-3 border-b border-gray-200 bg-white text-sm"
                            >
                                ₱
                                {{ data.price }}
                            </td>
                            <td
                                class="px-5 py-3 border-b border-gray-200 bg-white text-sm"
                            >
                                <a
                                    href="javascript:void(0)"
                                    class="text-blue-500"
                                    @click="editServices(data)"
                                    >Edit</a
                                >
                                |
                                <a
                                    href="javascript:void(0)"
                                    class="text-red-500"
                                    @click="deleteServices(data.id)"
                                    >Delete</a
                                >
                            </td>
                            <!-- Add more table data rows if needed -->
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Modal to add details -->

            <!-- Rest of your content -->
        </div>
    </authenticated-layout>
</template>

<style lang="scss" scoped>
.scroll-m-9 {
    max-height: 90vh; /* Set the maximum height for the modal */
    overflow-y: auto; /* Enable vertical scrollbar when content overflows */
}

/* Optional: Adjust scrollbar styles to match your design */
.scroll-m-9::-webkit-scrollbar {
    width: 10px;
}

.scroll-m-9::-webkit-scrollbar-thumb {
    background-color: #888;
    border-radius: 5px;
}

.scroll-m-9::-webkit-scrollbar-thumb:hover {
    background-color: #555;
}
</style>

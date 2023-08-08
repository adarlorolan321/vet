<script setup>
import CustomerLayout from "@/Layouts/CustomerLayout.vue";
import { Head, useForm, router, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import AddSlotModal from "@/Components/AddSlotModal.vue";

import { ref, computed } from "vue";
import { reactive } from "vue";
const user = computed(() => usePage().props.auth.user);
const appointmentData = computed(() => usePage().props.data);
const services = computed(() => usePage().props.service);
const error = computed(() => usePage().props.errors);

let form_data = reactive(null);

let form = useForm({
    id: null,
    date: null,
    time_start: null,
    time_end: null,
    status: "Pending",
    type: null,
    user_id: user.value.id,
});

const editTime = (data) => {
    //    form.id = data.id,
    //    form.date = data.date,
    //    form.time_start = data.time_start,
    //    form.time_end = data.time_end,
    //    form.status = data.status,
    //    form.type = data.type,
    //    form.user_id = data.user_id
    form_data = { ...form_data, ...data };
    isModalShow.value = true;

    console.log(form);
};

const timeOptions = ref([
    { label: "08:00 AM", value: "08:00" },
    { label: "09:00 AM", value: "09:00" },
    { label: "10:00 AM", value: "10:00" },
    { label: "11:00 AM", value: "11:00" },
    { label: "12:00 PM", value: "12:00" },
    { label: "01:00 PM", value: "13:00" },
    { label: "02:00 PM", value: "14:00" },
    { label: "03:00 PM", value: "15:00" },
    { label: "04:00 PM", value: "16:00" },
]);
const isModalShow = ref(false);

const deleteTime = (data) => {
    form.delete(route("customer-apointment.destroy", data));
};

const openModal = () => {
    form_data = null;
    isModalShow.value = true;
};
const closeMOdal = () => {
    isModalShow.value = false;
};
</script>

<template>
    <CustomerLayout>
        <AddSlotModal
            @close="closeMOdal"
            :data="form_data"
            :service="form_data"
            :show="isModalShow"
        ></AddSlotModal>
        <div class="flex justify-end mr-56">
            <PrimaryButton @click="openModal" type="button">Add</PrimaryButton>
        </div>

        <div class="d-flex justify-center align-middle mt-20">
            <div
                class="bg-white rounded-lg shadow-md p-6 w-full max-w-xl mx-auto"
            >
                <h2 class="text-xl font-semibold mb-4">Appointment Schedule</h2>
                <div class="">
                    <template v-for="data in appointmentData">
                        <div class="d-flex justify-end">
                            
                        <div class="space-x-2">
                            <a
                                href="javascript:void(0)"
                                class="text-blue-500 hover:underline"
                                >Edit</a
                            >
                            <a
                                href="javascript:void(0)"
                                class="text-red-500 hover:underline"
                                >Delete</a
                            >
                        </div>
                        </div>
                        <hr>
                        <h2 class="text-lg font-semibold ">Appointment Details</h2>
                        <div class="d-flex">
                            <div class="text-gray-500 font-semibold">Date  - </div> <div class="ml-5">{{ data.date }}</div>
                        </div>
                        <div class="d-flex">
                            <div class="text-gray-500 font-semibold">Time  - </div> <div class="ml-5">{{ data.time_start }}</div>
                        </div>
                        <div class="d-flex">
                            <div class="text-gray-500 font-semibold">Type  - </div> <div class="ml-5">{{ data.type }}</div>
                        </div>
                        <div class="d-flex">
                            <div class="text-gray-500 font-semibold">Service  - </div> <div class="ml-5">{{ data.service.name }}</div>
                        </div>
                        <div class="d-flex">
                            <div class="text-gray-500 font-semibold">Service Duration  - </div> <div class="ml-5">{{ data.service.duration }}</div>
                        </div>
                        <div class="d-flex">
                            <div class="text-gray-500 font-semibold">Service Price  - </div> <div class="ml-5">{{ data.service.price }}</div>
                        </div>
                        <div class="d-flex">
                            <div class="text-gray-500 font-semibold">Status  - </div> <div class="ml-5">{{ data.status }}</div>
                        </div>
                        <hr>
                        <h2 class="text-lg font-semibold ">Payment Details</h2>
                        <div class="d-flex">
                            <div class="text-gray-500 font-semibold">Payment amount  - </div> <div class="ml-5">{{ data.payment_amount}}</div>
                        </div>
                        <div class="d-flex">
                            <div class="text-gray-500 font-semibold">Payment Status  - </div> <div class="ml-5">{{ data.payment_status }}</div>
                        </div>
                        <div class="d-flex">
                            <div class="text-gray-500 font-semibold">Payment Method  - </div> <div class="ml-5">{{ data.payment_method }}</div>
                        </div>
                       
                        
                        
                    </template>
                    <!-- You can repeat the above section for each appointment data entry -->
                </div>
            </div>
        </div>
    </CustomerLayout>
</template>

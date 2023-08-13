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
   
        <AddSlotModal
            @close="closeMOdal"
            :data="form_data"
            :service="form_data"
            :show="isModalShow"
        ></AddSlotModal>
      
            <a href="javascript:void(0);" class="btn btn-primary bg-green py-md-3 px-md-5 me-3 animated slideInLeft"  @click="openModal" type="button">Appointment</a >
        
</template>

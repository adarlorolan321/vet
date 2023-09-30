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
    pet_id:null
    
});



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
        >
    
    </AddSlotModal>
      
            <a href="javascript:void(0);" class="btn btn-secondary bg-white py-md-3 px-md-5 me-3 "  @click="openModal" type="button">Appointment</a >
        
</template>

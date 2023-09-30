<script>
import CustomerLayout from "@/Layouts/CustomerLayout.vue";
import Appointment from "../Customer/Index.vue";
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
import { usePage } from "@inertiajs/vue3";
import toastr from "toastr";
import "toastr/build/toastr.css";

const data = computed(() => {
    return usePage().props.appointment;
});
</script>
<template>
    <CustomerLayout>
        <div class="container-fluid py-5">
            <div class="container mt-5">
                <div class="row justify-content-center" v-if="data">
                    <div class="col-md-8">
                        <div class="">
                            <div class="">
                                <h2 class="card-title text-center mb-4">
                                    Appointment Information
                                </h2>

                                <ul
                                    class="list-group list-group-flush text-dark"
                                >
                                    <li class="list-group-item">
                                        <strong>Date:</strong> {{ data.date }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Time Start:</strong>
                                        {{ data.time_start }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Time End:</strong>
                                        {{ data.time_end }}
                                    </li>
                                </ul>

                                <hr />

                                <ul
                                    class="list-group list-group-flush text-dark"
                                >
                                    <li class="list-group-item">
                                        <strong>Payment Amount:</strong> ${{
                                            parseFloat(
                                                data.payment_amount
                                            ).toFixed(2)
                                        }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Payment Method:</strong>
                                        {{ data.payment_method }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Payment Status:</strong>
                                        {{ data.payment_status }}
                                    </li>
                                </ul>

                                <hr />

                                <ul
                                    class="list-group list-group-flush text-dark"
                                >
                                    <li class="list-group-item">
                                        <strong>Service Name:</strong>
                                        {{ data.service.name }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Service Duration:</strong>
                                        {{ data.service.duration }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Status:</strong>
                                        {{ data.status }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Type:</strong> {{ data.type }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mt-4" v-else>
                    <div class="col-md-8">
                        <div class="">
                            <div class="card-body text-center">
                                <h2
                                    class="card-title text-xl font-semibold mb-4"
                                >
                                    No Appointment Found
                                </h2>
                                <hr />
                                <div class="text-center">
                                    <Appointment></Appointment>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </CustomerLayout>
</template>

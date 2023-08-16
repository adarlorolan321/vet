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
import { usePage } from "@inertiajs/vue3";
import toastr from "toastr";
import 'toastr/build/toastr.css';

const data = computed(() => {
    return usePage().props.appointment;
});




</script>
<template>
    <CustomerLayout>
        <div class="container-fluid py-5" >
            <div class="container">
                <div class="row g-5 mb-5">
                    <div class="col-lg-12">
                        <div class="section-title mb-5">
                            <h5
                                class="position-relative d-inline-block text-primary text-uppercase"
                            >
                            Your Upcoming Appointment
                            </h5>
                            <h1 class="display-5 mb-0">
                                Discover Premium Dental Services Tailored Just for You
                            </h1>
                        </div>
                        <div class="flex justify-center ">
                            <div
                                class="bg-white shadow-lg rounded-lg p-6 w-100 mx-10"
                            >
                                <h2 class="text-xl font-semibold mb-4">
                                    Appointment Details
                                </h2>

                                <p><strong>Date:</strong> {{ data.date }}</p>
                                <p>
                                    <strong>Time Start:</strong>
                                    {{ data.time_start }}
                                </p>
                                <p>
                                    <strong>Time End:</strong>
                                    {{ data.time_end }}
                                </p>

                                <hr />
                                <p>
                                    <strong>Payment Amount:</strong> ${{
                                        parseFloat(data.payment_amount).toFixed(
                                            2
                                        )
                                    }}
                                </p>
                                <p>
                                    <strong>Payment Method:</strong>
                                    {{ data.payment_method }}
                                </p>
                                <p>
                                    <strong>Payment Status:</strong>
                                    {{ data.payment_status }}
                                </p>

                                <hr />
                                <p>
                                    <strong>Service Name:</strong>
                                    {{ data.service.name }}
                                </p>
                                <p>
                                    <strong>Service Duration:</strong>
                                    {{ data.service.duration }}
                                </p>

                                <p>
                                    <strong>Status:</strong> {{ data.status }}
                                </p>
                                <p><strong>Type:</strong> {{ data.type }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </CustomerLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { useRoute } from "vue-router";
import Calendar from "calendarjs";
import { ref, onMounted } from "vue";
import moment from "moment";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import timeGridPlugin from "@fullcalendar/timegrid";

export default {
    props: {
        data: Object,
    },
    components: {
        FullCalendar, // make the <FullCalendar> tag available
        AuthenticatedLayout,
        moment,
    },
    computed: {
        transformedEvents() {
            // Transform the prop data into the events format expected by FullCalendar
            return this.data.data.map((item) => ({
                title: `${item.user.name} - ${item.time_start}`,
                start: `${item.date}T${item.time_start}`,
                end: `${item.date}T${item.time_end}`,
            }));
        },
    },
    data() {
        return {
            selectedEvent: null,
            calendarOptions: {
                plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin], // Add timeGridPlugin to plugins
                initialView: "dayGridMonth", // Use "timeGridWeek" or "timeGridDay" for time slots
                slotDuration: "00:30:00", // Set the duration for each time slot (30 minutes in this example)
                dateClick: this.handleDateClick,
                eventClick: this.handleEventClick,
                height: 750,
                contentHeight: 650,
                themeSystem: "bootstrap5",
                headerToolbar: {
                    left: "prev,next today", // Show previous, next, and today buttons on the left side
                    center: "title", // Show the title (current date) in the center
                    right: "dayGridMonth,timeGridWeek", // Show month and week view buttons on the right side
                },
                slotMinTime: "08:00:00",
                slotMaxTime: "18:00:00",
                events: [],
                displayEventTime: false,
                dayCell: this.handleDayCell,
            },
        };
    },
    watch: {
        data: {
            handler(newData) {
                // When the data prop changes, update the events with the transformed data
                this.calendarOptions.events = this.transformedEvents;
            },
            immediate: true, // Call the handler immediately when the component is created
        },
    },
    methods: {
        handleDateClick: function (arg) {
            // alert("date click! " + arg.dateStr);
        },
        handleEventClick(info) {
            this.selectedEvent = info.event; // Store the clicked event in selectedEvent
        },
        handleDayCell(arg) {
            const startTime = moment("08:00", "HH:mm");
            const endTime = moment("17:00", "HH:mm");
            const date = moment(arg.date);

            // Check if the date falls within the specific time range (08:00 to 17:00)
            if (date.isSameOrAfter(startTime) && date.isSameOrBefore(endTime)) {
                arg.dayEl.style.backgroundColor = "red";
            }
        },
    },
};
</script>
<script setup>
import { Head, useForm, router } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
let form = useForm({
    date: null,
    time_start: null,
    time_end: null,
});

const submit = () => {
    console.log("rolan");
    form.post(route("apointment.store"), {
        onError: (error) => {
            this.form.errors = error.errors;
        },
    });
};
</script>

<template>
    <Head title="Dashboard" />
    <transition
        enter-active-class="duration-200 ease-out"
        leave-active-class="duration-100 ease-in"
    >
        <div
            v-if="selectedEvent"
            class="fixed inset-0 flex items-center justify-center z-50"
        >
            <div
                class="modal-overlay absolute inset-0 bg-gray-700 opacity-75"
            ></div>

            <div
                class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto"
            >
                <div class="modal-content py-4 text-left px-6">
                    <div class="flex justify-between items-center pb-3">
                        <h3 class="text-2xl font-bold">
                            {{ selectedEvent.title }}
                        </h3>
                        <button
                            @click="selectedEvent = null"
                            class="modal-close cursor-pointer z-50"
                        >
                            <svg
                                class="fill-current text-black"
                                xmlns="http://www.w3.org/2000/svg"
                                width="18"
                                height="18"
                                viewBox="0 0 18 18"
                            >
                                <path
                                    d="M18 1.5l-1.5-1.5-7.5 7.5-7.5-7.5-1.5 1.5 7.5 7.5-7.5 7.5 1.5 1.5 7.5-7.5 7.5 7.5 1.5-1.5-7.5-7.5z"
                                ></path>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex">
                            <div class="border-r border-gray-600 pr-2">
                                <p class="pt-2">Start Time</p>
                            </div>
                            <div class="pl-2">
                                <p class="mb-0">
                                    {{
                                        moment(selectedEvent.start).format(
                                            "MMMM D, YYYY"
                                        )
                                    }}
                                </p>
                                <p class="mb-0">
                                    {{
                                        moment(selectedEvent.start).format(
                                            "HH:mm"
                                        )
                                    }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex mt-2">
                            <div class="border-r border-gray-600 pr-4">
                                <p class="pt-2">End Time</p>
                            </div>
                            <div class="pl-2">
                                <p class="mb-0">
                                    {{
                                        moment(selectedEvent.end).format(
                                            "MMMM D, YYYY"
                                        )
                                    }}
                                </p>
                                <p class="mb-0">
                                    {{
                                        moment(selectedEvent.end).format(
                                            "HH:mm"
                                        )
                                    }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
    <AuthenticatedLayout>
        <div class="calendar-container mx-5">
            <FullCalendar class="calendar" :options="calendarOptions" />
        </div>
    </AuthenticatedLayout>
</template>

<style lang="scss">
.calendar-container {
    margin-top: 20px;
}
</style>

<script>
import CustomerLayout from "@/Layouts/CustomerLayout.vue";
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
        user: Object,
    },
    components: {
        FullCalendar, // make the <FullCalendar> tag available
        CustomerLayout,
    },
    computed: {
        transformedEvents() {
            // Transform the prop data into the events format expected by FullCalendar
            return this.data.data.map((item) => ({
                title: this.user.id == item.user_id ? "You" : "Taken",
                start: `${item.date}T${item.time_start}`,
                end: `${item.date}T${item.time_end}`,
            }));
        },
    },
    data() {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin], // Add timeGridPlugin to plugins
                initialView: "dayGridMonth", // Use "timeGridWeek" or "timeGridDay" for time slots
                slotDuration: "00:30:00", // Set the duration for each time slot (30 minutes in this example)
                dateClick: this.handleDateClick,
                height: 750,
                contentHeight: 650,
                headerToolbar: {
                    left: "prev,next today", // Show previous, next, and today buttons on the left side
                    center: "title", // Show the title (current date) in the center
                    right: "dayGridMonth,timeGridWeek", // Show month and week view buttons on the right side
                },
                events: [],
                displayEventTime: false,
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
            alert("date click! " + arg.dateStr);
        },
    },
};
</script>

<template>
    <CustomerLayout>
        <div class="container-fluid py-5 wow " data-wow-delay="0.1s">
            <div class="container">
                <div class="row g-5 mb-5">
                    <div class="col-lg-12">
                        
                        <div class="calendar-container mx-5 mt-5">
                            <FullCalendar
                                class="calendar"
                                :options="calendarOptions"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </CustomerLayout>
</template>

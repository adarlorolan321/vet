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
            calendarOptions: {
                plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin], // Add timeGridPlugin to plugins
                initialView: "dayGridMonth", // Use "timeGridWeek" or "timeGridDay" for time slots
                slotDuration: "00:30:00", // Set the duration for each time slot (30 minutes in this example)
                dateClick: this.handleDateClick,
                height: 750,
                contentHeight: 650,
                themeSystem: 'bootstrap5',
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

/* Optionally, you can set a height for the calendar itself if needed */

</style>

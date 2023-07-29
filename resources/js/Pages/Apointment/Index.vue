<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { useRoute } from "vue-router";
import Calendar from "calendarjs";
import { ref, onMounted } from "vue";
import moment from "moment";

const calendar = ref();
const events = [
    {
        title: "Event 1",
        start: moment().add(1, "days").toDate(), // Tomorrow
    },
    {
        title: "Event 2",
        start: moment().add(3, "days").toDate(), // Three days from now
    },
    {
        title: "Event 3",
        start: moment().add(7, "days").toDate(), // One week from now
    },
];
onMounted(() => {
    initCalendar();
});

const initCalendar = () => {
    const calendarContainer = calendar.value;
    const cal = new Calendar(calendarContainer, {
        events: events,
      }); // Use a different variable name here to avoid shadowing

    // Render the calendar
    cal.render();
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="calendar-container" ref="calendar"></div>
    </AuthenticatedLayout>
</template>

<style lang="scss">
.calendar-container {
    height: 500px;
}
</style>

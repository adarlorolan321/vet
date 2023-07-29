<script setup>
import CustomerLayout from "@/Layouts/CustomerLayout.vue";
import { Head, useForm, router, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";


import {ref, computed} from 'vue'
const user = computed(() => usePage().props.auth.user);
const appointmentData = computed(() => usePage().props.data);
const error = computed(() => usePage().props.errors);

let form = useForm({
    date: null,
    time_start: null,
    type: null,
    user_id: user.value.id
});

const options = ref([
    { value: "New Appointment", label: "New Appointment" },
    { value: "Reschedule", label: "Reschedule" },
   
]);

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
    <CustomerLayout>
     
        <div class="d-flex justify-center mt-2">
            <form @submit.prevent="submit">
                <div class="d-flex mx-5 gap-3 mb-3">
                    <div class="mt-4">
                        <InputLabel for="date" value="Date" />

                        <TextInput
                            id="date"
                            type="date"
                            class="mt-1 block w-full"
                            v-model="form.date"
                            required
                            autofocus
                        />

                        <InputError class="mt-2" :message="form.errors.date" />
                    </div>
                    <div class="mt-4">
                        <InputLabel for="time_end" value="Time End" />

                        <TextInput
                            id="time_end"
                            type="time"
                            class="mt-1 block w-full"
                            v-model="form.time_start"
                            required
                        />

                        <InputError
                            class="mt-2"
                            :message="form.errors.time_start"
                        />
                    </div>
                    <div class="mt-4">
                        <InputLabel for="time_start" value="Type" />

                        <select v-model="form.type" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">Select an option</option>
                            <option
                                v-for="option in options"
                                :key="option.value"
                                :value="option.value"
                            >
                                {{ option.label }}
                            </option>
                        </select>

                        <InputError
                            class="mt-2"
                            :message="form.errors.password"
                        />
                    </div>

                    
                    <PrimaryButton
                        class="add-button"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Add
                    </PrimaryButton>
                </div>
            </form>
        </div>
        <div class="max-w-4xl mx-auto">
    <div class="my-4">
      <input
        v-model="searchQuery"
        type="text"
        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300"
        placeholder="Search..."
      />
    </div>
    <table class="w-full border-collapse">
      <thead>
        <tr class="bg-gray-100">
          <th class="py-2 px-4 border">Date</th>
          <th class="py-2 px-4 border">Time</th>
          <th class="py-2 px-4 border">Type</th>
          <th class="py-2 px-4 border">Status</th>
          <th class="py-2 px-4 border">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="data in appointmentData" :key="data" class="border">
          <td class="py-2 px-4 border">{{ data.date }}</td>
          <td class="py-2 px-4 border">{{ data.time_start }}</td>
          <td class="py-2 px-4 border">{{ data.type }}</td>
          <td class="py-2 px-4 border"></td>
          <td class="py-2 px-4 border"></td>
        </tr>
      </tbody>
    </table>
  </div>
    </CustomerLayout>
</template>

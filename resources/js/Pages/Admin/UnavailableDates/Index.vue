<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, router, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";


import {ref, computed} from 'vue'
const user = computed(() => usePage().props.auth.user);
const  appointmentData  = computed(() => usePage().props.data);
const error = computed(() => usePage().props.errors);



let form = useForm({
    id:null,
    date: null,
    time_start: '08:00',
    time_end: null,
    status: 'Pending',
    type: null,
    user_id: user.value.id
});

const editTime =(data)=>{
   form.id = data.id,
   form.date = data.date,
   form.time_start = data.time_start,
   form.time_end = data.time_end,
   form.status = data.status,
   form.type = data.type,
   form.user_id = data.user_id
   
   console.log(form);
}

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

const options = ref([
    { value: "Whole Day", label: "Whole Day" },
    { value: "Half Day", label: "Half Day" },
   
]);

const deleteTime = (data) => {
    form.delete(route("customer-apointment.destroy", data));
}

const submit = () => {
    console.log("rolan");
    if(form.id != null){
        form.patch(route("customer-apointment.update",{id:form.id}), {
        onError: (error) => {
            this.form.errors = error.errors;
        },
    });
    }
    else{
        form.post(route("unavailable-dates.store"), {
        onError: (error) => {
            this.form.errors = error.errors;
        },
    });
    }
    
};
</script>

<template>
    <AuthenticatedLayout>
     
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
                    <!-- <div class="mt-4">
                        <InputLabel for="time_start" value="Time" />

                        <select v-model="form.time_start" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">Select an option</option>
                            <option
                                v-for="option in timeOptions"
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
                    </div> -->
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
                        {{ form.id != null? 'Update' : 'Add' }}  
                    </PrimaryButton>
                </div>
            </form>
        </div>
        <div class="max-w-4xl mx-auto">
    <div class="my-4">
      
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
        <tr v-for="data in appointmentData.data" :key="data" class="border">
          <td class="py-2 px-4 border">{{ data.date }}</td>
          <td class="py-2 px-4 border">{{ data.time_start }}</td>
          <td class="py-2 px-4 border">{{ data.type }}</td>
          <td class="py-2 px-4 border">{{ data.status }}</td>
          <td class="py-2 px-4 border">
            <a href="javascript:void(0)" @click="editTime(data)">edit</a> |
            <a href="javascript:void(0)" @click="deleteTime(data.id)">delete</a>
          </td>
        </tr>
        
      </tbody>
    </table>
  </div>
    </AuthenticatedLayout>
</template>

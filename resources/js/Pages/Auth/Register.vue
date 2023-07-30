<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import axios from "axios";

const form = useForm({
    first_name: "",
    last_name: "",
    barangay: "",
    mobile_no: "",
    city: "",
    province: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const provinceOptions = ref([]);
const cityOptions = ref([]);
const barangayOptions = ref([]);

const getCity = () => {
    axios
        .get(
            `https://psgc.gitlab.io/api/provinces/${form.province}/municipalities.json`
        )
        .then((response) => {
            cityOptions.value = response.data;
            console.log(response.data);
        })
        .catch((error) => {
            console.error(error);
        });
};
const getBarangay = () => {
    axios
        .get(
            `https://psgc.gitlab.io/api/municipalities/${form.city}/barangays.json`
        )
        .then((response) => {
            barangayOptions.value = response.data;
        })
        .catch((error) => {
            console.error(error);
        });
};
onMounted(() => {
    axios.get("https://psgc.gitlab.io/api/provinces.json").then((response) => {
        provinceOptions.value = response.data;
    });
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />
        <!-- {{ cityOptions }} -->
        <form @submit.prevent="submit" class="w-full">
            <div>
                <InputLabel for="first_name" value="First Name" />

                <TextInput
                    id="first_name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.first_name"
                    required
                    autofocus
                    autocomplete="first_name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>
            <div class="mt-4">
                <InputLabel for="last_name" value="Last Name" />

                <TextInput
                    id="last_name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.last_name"
                    required
                    autocomplete="last_name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="mobile_no" value="Mobile No." />

                <TextInput
                    id="mobile_no"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.mobile_no"
                    required
                    autocomplete="mobile_no"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>
            <div class="d-flex gap-2">
                <div class="mt-4">
                    <InputLabel for="province" value="Province" />

                    <select
                        v-model="form.province"
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        @change="getCity"
                    >
                        <option value="">Select an option</option>
                        <option
                            v-for="option in provinceOptions"
                            :key="option.code"
                            :value="option.code"
                        >
                            {{ option.name }}
                        </option>
                    </select>

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div class="mt-4">
                    <InputLabel for="city" value="City/Municipality" />

                    <select
                        v-model="form.city"
                        @change="getBarangay"
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    >
                        <option value="">Select an option</option>
                        <option
                            v-for="option in cityOptions"
                            :key="option.code"
                            :value="option.code"
                        >
                            {{ option.name }}
                        </option>
                    </select>

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div class="mt-4">
                    <InputLabel for="barangay" value="Barangay" />

                    <select
                        v-model="form.barangay"
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    >
                        <option value="">Select an option</option>
                        <option
                            v-for="option in barangayOptions"
                            :key="option.code"
                            :value="option.code"
                        >
                            {{ option.name }}
                        </option>
                    </select>

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>

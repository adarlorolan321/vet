<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    first_name: user.first_name,
    last_name: user.last_name,
    mobile_no: user.mobile_no,
    email: user.email,
    barangay: user.barangay,
    city: user.city,
    province: user.province,
    
});
</script>

<template>
    <section class="mx-auto">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Profile Information
            </h2>
        </header>

        <form
            @submit.prevent="form.patch(route('profile.update'))"
            class="mt-6 space-y-6"
        >
            <div class="d-flex w-full gap-2">
                <div class="w-full">
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
                <div class="w-100">
                    <InputLabel for="last_name" value="Last Name" />

                    <TextInput
                        id="last_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.last_name"
                        required
                        autofocus
                        autocomplete="last_name"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
            </div>
            <div class="d-flex w-full gap-2">
                <div class="w-full">
                    <InputLabel for="email" value="Email" />

                    <TextInput
                        id="email"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="email"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div class="w-100">
                    <InputLabel for="mobile_no" value="Mobile No" />

                    <TextInput
                        id="mobile_no"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.mobile_no"
                        required
                        autofocus
                        autocomplete="mobile_no"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                
            </div>
            <div class="d-flex w-full gap-2">
                <div class="w-full">
                    <InputLabel for="barangay" value="Barangay" />

                    <TextInput
                        id="barangay"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.barangay"
                        required
                        autofocus
                        autocomplete="barangay"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div class="w-100">
                    <InputLabel for="city" value="City" />

                    <TextInput
                        id="city"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.city"
                        required
                        autofocus
                        autocomplete="city"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                
            </div>
            <div class="d-flex w-full gap-2">
                <div class="w-full">
                    <InputLabel for="province" value="Province" />

                    <TextInput
                        id="province"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.province"
                        required
                        autofocus
                        autocomplete="province"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                
                
            </div>
           
           

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>

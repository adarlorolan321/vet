<script setup>
import CustomerLayout from '@/Layouts/CustomerLayout.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pets from './Partials/Pets.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;
const pets = usePage().props.pets;
const Layouts = usePage().props.auth.user.role == 'Admin'?AuthenticatedLayout:CustomerLayout


</script>

<template>
    <Head title="Profile" />

    <component :is="Layouts">
      
        

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <Pets :data="pets" class="max-w-xl" />
                </div>
            </div>
        </div>
    </component>
</template>

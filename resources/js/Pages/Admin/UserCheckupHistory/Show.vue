<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, router, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useCrud } from "@/Composables/Crud.js";
import { computed, ref } from "vue";
import axios from "axios";

const data = computed(()=>usePage().props)


</script>

<template>
    <AuthenticatedLayout>
        <div class="container mx-auto ">
          {{ data }}
           
    
        </div>
    </AuthenticatedLayout>
</template>

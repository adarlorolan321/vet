<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"
    >
        <div class="flex">
            <div
                class="justify-center w-full align-middle"><div >
                    <Link href="/">
                        <ApplicationLogo
                            class="w-50 h-50 fill-current text-gray-500 m-auto "
                        />
                    </Link>
                </div>
            </div>
            
                <div
                    class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
                >
                    <slot /></div
            >
        </div>
    </div>
</template>

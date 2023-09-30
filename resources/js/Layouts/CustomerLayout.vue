<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";
import SideNav from "@/Components/Nav/SideNav.vue";
import { useLink } from "@/Composables/Link.js";
const links = useLink().sideNavLinks;

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <div class="container-fluid border-bottom d-none d-lg-block">
                <div class="row gx-0">
                    <div class="col-lg-4 text-center py-2">
                        <div class="d-inline-flex align-items-center">
                            <i class="bi bi-geo-alt fs-1 text-primary me-3"></i>
                            <div class="text-start">
                                <h6 class="text-uppercase mb-1">Our Office</h6>
                                <span>123 Street, New York, USA</span>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-lg-4 text-center border-start border-end py-2"
                    >
                        <div class="d-inline-flex align-items-center">
                            <i
                                class="bi bi-envelope-open fs-1 text-primary me-3"
                            ></i>
                            <div class="text-start">
                                <h6 class="text-uppercase mb-1">Email Us</h6>
                                <span>info@example.com</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center py-2">
                        <div class="d-inline-flex align-items-center">
                            <i
                                class="bi bi-phone-vibrate fs-1 text-primary me-3"
                            ></i>
                            <div class="text-start">
                                <h6 class="text-uppercase mb-1">Call Us</h6>
                                <span>+012 345 6789</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <nav
                class="navbar navbar-expand-lg bg-white navbar-light shadow-sm py-3 py-lg-0 px-3 px-lg-0"
            >
                <a href="/" class="navbar-brand ms-lg-5">
                    <h1 class="m-0 text-uppercase text-dark">
                        <i class="bi bi-shop fs-1 text-primary me-3"></i>VCMSC
                        Vet
                    </h1>
                </a>
                <button class="navbar-toggler" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a
                            href="/"
                            :class="{ active: $page.url == '/' }"
                            class="nav-item nav-link"
                            >Home
                        </a>
                        <a
                            class="nav-item nav-link"
                            :class="{
                                active: $page.url == '/get-my-apointment',
                            }"
                            :href="route('getMyAppointment')"
                            >Active Appointment</a
                        >
                        <a
                            class="nav-item nav-link"
                            :href="route('slots.index')"
                            :class="{
                                active: $page.url == '/customer/slots',
                            }"
                            >Calendar</a
                        >
                        <a
                            class="mx-2 nav-item nav-link"
                            :href="route('services.index')"
                            :class="{
                                active: $page.url == '/customer/services',
                            }"
                            >Services</a
                        >
                        <div
                            class="ml-3 relative my-auto"
                            v-if="$page.props.auth"
                        >
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button
                                            type="button"
                                            class="inline-flex items-center px-3 py-2 border-none border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                        >
                                            {{ $page.props.auth?.user?.name }}

                                            <svg
                                                class="ml-2 -mr-0.5 h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <DropdownLink :href="route('profile.edit')">
                                        Profile
                                    </DropdownLink>
                                    <DropdownLink
                                        :href="route('logout')"
                                        method="post"
                                        as="button"
                                    >
                                        Log Out
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main>
                <slot></slot>
            </main>
        </div>
        <div class="container-fluid bg-light mt-5 py-5">
            <div class="container pt-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h5
                            class="text-uppercase border-start border-5 border-primary ps-3 mb-4"
                        >
                            Get In Touch
                        </h5>
                        <p class="mb-4">
                            No dolore ipsum accusam no lorem. Invidunt sed clita
                            kasd clita et et dolor sed dolor
                        </p>
                        <p class="mb-2">
                            <i class="bi bi-geo-alt text-primary me-2"></i>123
                            Street, New York, USA
                        </p>
                        <p class="mb-2">
                            <i class="bi bi-envelope-open text-primary me-2"></i
                            >info@example.com
                        </p>
                        <p class="mb-0">
                            <i class="bi bi-telephone text-primary me-2"></i
                            >+012 345 67890
                        </p>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <h5
                            class="text-uppercase border-start border-5 border-primary ps-3 mb-4"
                        >
                            Newsletter
                        </h5>
                        <form action="">
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control p-3"
                                    placeholder="Your Email"
                                />
                                <button class="btn btn-primary">Sign Up</button>
                            </div>
                        </form>
                        <h6 class="text-uppercase mt-4 mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a
                                class="btn btn-outline-primary btn-square me-2"
                                href="#"
                                ><i class="bi bi-twitter"></i
                            ></a>
                            <a
                                class="btn btn-outline-primary btn-square me-2"
                                href="#"
                                ><i class="bi bi-facebook"></i
                            ></a>
                            <a
                                class="btn btn-outline-primary btn-square me-2"
                                href="#"
                                ><i class="bi bi-linkedin"></i
                            ></a>
                            <a
                                class="btn btn-outline-primary btn-square"
                                href="#"
                                ><i class="bi bi-instagram"></i
                            ></a>
                        </div>
                    </div>
                    <div class="col-12 text-center text-body">
                        <a class="text-body" href="">Terms & Conditions</a>
                        <span class="mx-1">|</span>
                        <a class="text-body" href="">Privacy Policy</a>
                        <span class="mx-1">|</span>
                        <a class="text-body" href="">Customer Support</a>
                        <span class="mx-1">|</span>
                        <a class="text-body" href="">Payments</a>
                        <span class="mx-1">|</span>
                        <a class="text-body" href="">Help</a>
                        <span class="mx-1">|</span>
                        <a class="text-body" href="">FAQs</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-dark text-white-50 py-4">
            <div class="container">
                <div class="row g-5">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-md-0">
                            &copy;
                            <a class="text-white" href="#">Your Site Name</a>.
                            All Rights Reserved.
                        </p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p class="mb-0">
                            Designed by
                            <a class="text-white" href="https://htmlcodex.com"
                                >HTML Codex</a
                            >
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary py-3 fs-4 back-to-top"
            ><i class="bi bi-arrow-up"></i
        ></a>
    </div>
</template>

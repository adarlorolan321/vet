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
            <div class="container-fluid bg-light ps-5 pe-0 d-none d-lg-block">
                <div class="row gx-0">
                    <div
                        class="col-md-6 text-center text-lg-start mb-2 mb-lg-0"
                    >
                        <div class="d-inline-flex align-items-center">
                            <small class="py-2"
                                ><i class="far fa-clock text-primary me-2"></i
                                >Opening Hours: Mon - Tues : 6.00 am - 10.00 pm,
                                Sunday Closed
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6 text-center text-lg-end">
                        <div
                            class="position-relative d-inline-flex align-items-center bg-green text-white top-shape px-5"
                        >
                            <div class="me-3 pe-3 border-end py-2">
                                <p class="m-0">
                                    <i class="fa fa-envelope-open me-2"></i
                                    >info@example.com
                                </p>
                            </div>
                            <div class="py-2">
                                <p class="m-0">
                                    <i class="fa fa-phone-alt me-2"></i>+012 345
                                    6789
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <nav
                class="navbar navbar-expand-lg bg-white navbar-light shadow-sm px-5 py-3 py-lg-0"
            >
                <a href="/" class="flex navbar-brand p-0">
                    <ApplicationLogo
                        class="block h-20 w-auto fill-current text-gray-800"
                    />
                    <h4 class="mt-7 text-green">Castillet Dental</h4>
                </a>
                <!-- Primary Navigation Menu -->
                <div class="py-2 ms-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')"> </Link>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <a
                                class="mx-2 nav-item nav-link decoration-none"
                                :href="route('dashboard')"
                                >Home</a
                            >
                            <a
                                class="mx-2 nav-item nav-link decoration-none"
                                :href="route('getMyAppointment')"
                                >My Appointment</a
                            >
                            <a
                                class="mx-2 nav-item nav-link"
                                :href="route('slots.index')"
                                >Slot</a
                            >
                            <a
                                class="mx-2 nav-item nav-link"
                                :href="route('services.index')"
                                >Services</a
                            >
                            <a class="mx-2 nav-item nav-link"  :href="route('histories.index')">History</a>
                            <div class="ml-3 relative" v-if="$page.props.auth">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
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
                                        <DropdownLink
                                            :href="route('profile.edit')"
                                        >
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
                            <Link
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border text-decoration-none border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"

                            v-else :href="route('login')">Login</Link>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            Dashboard
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <!-- <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </div> -->
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')">
                                Profile
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main>
                <slot></slot>
            </main>
        </div>
        <div
            class="container-fluid bg-dark text-light py-5 wow fadeInUp"
            data-wow-delay="0.3s"
           
        >
            <div class="container pt-5">
                <div class="row g-5 pt-4">
                    <div class="col-lg-3 col-md-6">
                        <h3 class="text-white mb-4">Quick Links</h3>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-light mb-2" href="#"
                                ><i
                                    class="bi bi-arrow-right text-primary me-2"
                                ></i
                                >Home</a
                            >
                            <a class="text-light mb-2" href="#"
                                ><i
                                    class="bi bi-arrow-right text-primary me-2"
                                ></i
                                >About Us</a
                            >
                            <a class="text-light mb-2" href="#"
                                ><i
                                    class="bi bi-arrow-right text-primary me-2"
                                ></i
                                >Our Services</a
                            >
                            <a class="text-light mb-2" href="#"
                                ><i
                                    class="bi bi-arrow-right text-primary me-2"
                                ></i
                                >Latest Blog</a
                            >
                            <a class="text-light" href="#"
                                ><i
                                    class="bi bi-arrow-right text-primary me-2"
                                ></i
                                >Contact Us</a
                            >
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3 class="text-white mb-4">Popular Links</h3>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-light mb-2" href="#"
                                ><i
                                    class="bi bi-arrow-right text-primary me-2"
                                ></i
                                >Home</a
                            >
                            <a class="text-light mb-2" href="#"
                                ><i
                                    class="bi bi-arrow-right text-primary me-2"
                                ></i
                                >About Us</a
                            >
                            <a class="text-light mb-2" href="#"
                                ><i
                                    class="bi bi-arrow-right text-primary me-2"
                                ></i
                                >Our Services</a
                            >
                            <a class="text-light mb-2" href="#"
                                ><i
                                    class="bi bi-arrow-right text-primary me-2"
                                ></i
                                >Latest Blog</a
                            >
                            <a class="text-light" href="#"
                                ><i
                                    class="bi bi-arrow-right text-primary me-2"
                                ></i
                                >Contact Us</a
                            >
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3 class="text-white mb-4">Get In Touch</h3>
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
                        <h3 class="text-white mb-4">Follow Us</h3>
                        <div class="d-flex">
                            <a
                                class="btn btn-lg btn-primary bg-green btn-lg-square rounded me-2"
                                href="#"
                                ><i class="fab fa-twitter fw-normal"></i
                            ></a>
                            <a
                                class="btn btn-lg btn-primary bg-green btn-lg-square rounded me-2"
                                href="#"
                                ><i class="fab fa-facebook-f fw-normal"></i
                            ></a>
                            <a
                                class="btn btn-lg btn-primary bg-green btn-lg-square rounded me-2"
                                href="#"
                                ><i class="fab fa-linkedin-in fw-normal"></i
                            ></a>
                            <a
                                class="btn btn-lg btn-primary bg-green btn-lg-square rounded"
                                href="#"
                                ><i class="fab fa-instagram fw-normal"></i
                            ></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="container-fluid text-light py-4"
            style="background: #051225"
        >
            <div class="container">
                <div class="row g-0">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-md-0">
                            &copy;
                            <a class="text-white border-bottom" href="#"
                                >Your Site Name</a
                            >. All Rights Reserved.
                        </p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p class="mb-0">
                            Designed by
                            <a
                                class="text-white border-bottom"
                                href="https://htmlcodex.com"
                                >HTML Codex</a
                            >
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

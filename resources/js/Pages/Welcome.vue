<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import Appointment from "../Pages/Customer/Index.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
    service: {
        type: Object,
        default: null,
    },
});
const showingNavigationDropdown = ref(false);
</script>

<template>
    <!-- Spinner Start -->
    <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-dark m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-secondary m-1" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> -->
    <!-- Spinner End -->

    <!-- Topbar Start -->
    <div class="container-fluid bg-light ps-5 pe-0 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <small class="py-2"
                        ><i class="far fa-clock text-primary me-2"></i>Opening
                        Hours: Mon - Tues : 6.00 am - 10.00 pm, Sunday Closed
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
                            <i class="fa fa-phone-alt me-2"></i>+012 345 6789
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav
        class="navbar navbar-expand-lg bg-white navbar-light shadow-sm px-5 py-3 py-lg-0"
    >
        <a href="index.html" class="flex navbar-brand p-0">
            <ApplicationLogo
                class="block h-20 w-auto fill-current text-gray-800"
            />
            <h4 class="mt-7 text-primary">Castillet Dental</h4>
        </a>
        <!-- Primary Navigation Menu -->
        <div class="py-2 ms-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <Link :href="route('dashboard')"> </Link>
                    </div>

                    <!-- Navigation Links -->
                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <!-- Settings Dropdown -->
                    <a
                        class="mx-2 nav-item nav-link decoration-none"
                        :href="route('dashboard')"
                        >Home</a
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
                    <a class="mx-2 nav-item nav-link">History</a>
                    <div class="ml-3 relative">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button
                                        type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                    >
                                        {{ $page.props.auth.user.name }}

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
                                    'inline-flex': !showingNavigationDropdown,
                                }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{
                                    hidden: !showingNavigationDropdown,
                                    'inline-flex': showingNavigationDropdown,
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
                    <div class="font-medium text-base text-gray-800">
                        {{ $page.props.auth.user.name }}
                    </div>
                    <div class="font-medium text-sm text-gray-500">
                        {{ $page.props.auth.user.email }}
                    </div>
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
    <!-- Navbar End -->

    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(9, 30, 62, 0.7)">
                <div class="modal-header border-0">
                    <button
                        type="button"
                        class="btn bg-white btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div
                    class="modal-body d-flex align-items-center justify-content-center"
                >
                    <div class="input-group" style="max-width: 600px">
                        <input
                            type="text"
                            class="form-control bg-transparent border-primary p-3"
                            placeholder="Type search keyword"
                        />
                        <button class="btn btn-primary bg-green px-4">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->

    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div
            id="header-carousel"
            class="carousel slide carousel-fade"
            data-bs-ride="carousel"
        >
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="/img/carousel-1.jpg" alt="Image" />
                    <div
                        class="carousel-caption d-flex flex-column align-items-center justify-content-center"
                    >
                        <div class="p-3" style="max-width: 900px">
                            <h5
                                class="text-white text-uppercase mb-3 animated slideInDown"
                            >
                                Keep Your Teeth Healthy
                            </h5>
                            <h1
                                class="display-1 text-white mb-md-4 animated zoomIn"
                            >
                                Take The Best Quality Dental Treatment
                            </h1>
                            <Appointment></Appointment>
                            <a
                                href=""
                                class="btn btn-secondary py-md-3 px-md-5 animated slideInRight"
                                >Contact Us</a
                            >
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/carousel-2.jpg" alt="Image" />
                    <div
                        class="carousel-caption d-flex flex-column align-items-center justify-content-center"
                    >
                        <div class="p-3" style="max-width: 900px">
                            <h5
                                class="text-white text-uppercase mb-3 animated slideInDown"
                            >
                                Keep Your Teeth Healthy
                            </h5>
                            <h1
                                class="display-1 text-white mb-md-4 animated zoomIn"
                            >
                                Take The Best Quality Dental Treatment
                            </h1>
                            <Appointment></Appointment>
                            <a
                                href=""
                                class="btn btn-secondary py-md-3 px-md-5 animated slideInRight"
                                >Contact Us</a
                            >
                        </div>
                    </div>
                </div>
            </div>
            <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#header-carousel"
                data-bs-slide="prev"
            >
                <span
                    class="carousel-control-prev-icon"
                    aria-hidden="true"
                ></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button
                class="carousel-control-next"
                type="button"
                data-bs-target="#header-carousel"
                data-bs-slide="next"
            >
                <span
                    class="carousel-control-next-icon"
                    aria-hidden="true"
                ></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="container-fluid mb-5">
        <div class="container">
            <div class="row gx-0">
                <div class="col-lg-6 wow zoomIn" data-wow-delay="0.1s">
                    <div
                        class="bg-green d-flex flex-column p-5"
                        style="height: 300px"
                    >
                        <h3 class="text-white mb-3">Opening Hours</h3>
                        <div
                            class="d-flex justify-content-between text-white mb-3"
                        >
                            <h6 class="text-white mb-0">Mon - Fri</h6>
                            <p class="mb-0">8:00am - 9:00pm</p>
                        </div>
                        <div
                            class="d-flex justify-content-between text-white mb-3"
                        >
                            <h6 class="text-white mb-0">Saturday</h6>
                            <p class="mb-0">8:00am - 7:00pm</p>
                        </div>
                        <div
                            class="d-flex justify-content-between text-white mb-3"
                        >
                            <h6 class="text-white mb-0">Sunday</h6>
                            <p class="mb-0">8:00am - 5:00pm</p>
                        </div>
                        <a class="btn btn-light" href="/dashboard"
                            >Appointment</a
                        >
                    </div>
                </div>

                <div class="col-lg-6 wow zoomIn" data-wow-delay="0.6s">
                    <div
                        class="bg-secondary d-flex flex-column p-5"
                        style="height: 300px"
                    >
                        <h3 class="text-white mb-3">Make Appointment</h3>
                        <p class="text-white">
                            Ipsum erat ipsum dolor clita rebum no rebum dolores
                            labore, ipsum magna at eos et eos amet.
                        </p>
                        <h2 class="text-white mb-0">+012 345 6789</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Start -->

    <!-- About Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title mb-4">
                        <h5
                            class="position-relative d-inline-block text-primary text-uppercase"
                        >
                            About Us
                        </h5>
                        <h1 class="display-5 mb-0">
                            The World's Best Dental Clinic That You Can Trust
                        </h1>
                    </div>
                    <h4 class="text-body fst-italic mb-4">
                        Diam dolor diam ipsum sit. Clita erat ipsum et lorem
                        stet no lorem sit clita duo justo magna dolore
                    </h4>
                    <p class="mb-4">
                        Tempor erat elitr rebum at clita. Diam dolor diam ipsum
                        et tempor sit. Aliqu diam amet diam et eos labore. Clita
                        erat ipsum et lorem et sit, sed stet no labore lorem
                        sit. Sanctus clita duo justo et tempor eirmod magna
                        dolore erat amet
                    </p>
                    <div class="row g-3">
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.3s">
                            <h5 class="mb-3">
                                <i
                                    class="fa fa-check-circle text-primary me-3"
                                ></i
                                >Award Winning
                            </h5>
                            <h5 class="mb-3">
                                <i
                                    class="fa fa-check-circle text-primary me-3"
                                ></i
                                >Professional Staff
                            </h5>
                        </div>
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.6s">
                            <h5 class="mb-3">
                                <i
                                    class="fa fa-check-circle text-primary me-3"
                                ></i
                                >24/7 Opened
                            </h5>
                            <h5 class="mb-3">
                                <i
                                    class="fa fa-check-circle text-primary me-3"
                                ></i
                                >Fair Prices
                            </h5>
                        </div>
                    </div>
                    <a
                        href="appointment.html"
                        class="btn btn-primary bg-green py-3 px-5 mt-4 wow zoomIn"
                        data-wow-delay="0.6s"
                        >Make Appointment</a
                    >
                </div>
                <div class="col-lg-5" style="min-height: 500px">
                    <div class="position-relative h-100">
                        <img
                            class="position-absolute w-100 h-100 rounded wow zoomIn"
                            data-wow-delay="0.9s"
                            src="img/about.jpg"
                            style="object-fit: cover"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Appointment Start -->
    <div
        class="container-fluid bg-green bg-appointment my-5 wow fadeInUp"
        data-wow-delay="0.1s"
    >
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-6 py-5">
                    <div class="py-5">
                        <h1 class="display-5 text-white mb-4">
                            We Are A Certified and Award Winning Dental Clinic
                            You Can Trust
                        </h1>
                        <p class="text-white mb-0">
                            Eirmod sed tempor lorem ut dolores. Aliquyam sit
                            sadipscing kasd ipsum. Dolor ea et dolore et at sea
                            ea at dolor, justo ipsum duo rebum sea invidunt
                            voluptua. Eos vero eos vero ea et dolore eirmod et.
                            Dolores diam duo invidunt lorem. Elitr ut dolores
                            magna sit. Sea dolore sanctus sed et. Takimata
                            takimata sanctus sed.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->

    <!-- Service Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-5 mb-5">
                <div
                    class="col-lg-5 wow zoomIn"
                    data-wow-delay="0.3s"
                    style="min-height: 400px"
                >
                    <div
                        class="twentytwenty-container position-relative h-100 rounded overflow-hidden"
                    >
                        <img
                            class="position-absolute w-100 h-100"
                            src="img/before.jpg"
                            style="object-fit: cover"
                        />
                        <img
                            class="position-absolute w-100 h-100"
                            src="img/after.jpg"
                            style="object-fit: cover"
                        />
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="section-title mb-5">
                        <h5
                            class="position-relative d-inline-block text-primary text-uppercase"
                        >
                            Our Services
                        </h5>
                        <h1 class="display-5 mb-0">
                            We Offer The Best Quality Dental Services
                        </h1>
                    </div>
                    <div class="row g-5">
                        <div
                            class="col-md-6 service-item wow zoomIn"
                            data-wow-delay="0.6s"
                        >
                            <div class="rounded-top overflow-hidden">
                                <img
                                    class="img-fluid"
                                    src="img/service-1.jpg"
                                    alt=""
                                />
                            </div>
                            <div
                                class="position-relative bg-light rounded-bottom text-center p-4"
                            >
                                <h5 class="m-0">Cosmetic Dentistry</h5>
                            </div>
                        </div>
                        <div
                            class="col-md-6 service-item wow zoomIn"
                            data-wow-delay="0.9s"
                        >
                            <div class="rounded-top overflow-hidden">
                                <img
                                    class="img-fluid"
                                    src="img/service-2.jpg"
                                    alt=""
                                />
                            </div>
                            <div
                                class="position-relative bg-light rounded-bottom text-center p-4"
                            >
                                <h5 class="m-0">Dental Implants</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-7">
                    <div class="row g-5">
                        <div
                            class="col-md-6 service-item wow zoomIn"
                            data-wow-delay="0.3s"
                        >
                            <div class="rounded-top overflow-hidden">
                                <img
                                    class="img-fluid"
                                    src="img/service-3.jpg"
                                    alt=""
                                />
                            </div>
                            <div
                                class="position-relative bg-light rounded-bottom text-center p-4"
                            >
                                <h5 class="m-0">Dental Bridges</h5>
                            </div>
                        </div>
                        <div
                            class="col-md-6 service-item wow zoomIn"
                            data-wow-delay="0.6s"
                        >
                            <div class="rounded-top overflow-hidden">
                                <img
                                    class="img-fluid"
                                    src="img/service-4.jpg"
                                    alt=""
                                />
                            </div>
                            <div
                                class="position-relative bg-light rounded-bottom text-center p-4"
                            >
                                <h5 class="m-0">Teeth Whitening</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="col-lg-5 service-item wow zoomIn"
                    data-wow-delay="0.9s"
                >
                    <div
                        class="position-relative bg-green rounded h-100 d-flex flex-column align-items-center justify-content-center text-center p-4"
                    >
                        <h3 class="text-white mb-3">Make Appointment</h3>
                        <p class="text-white mb-3">
                            Clita ipsum magna kasd rebum at ipsum amet dolor
                            justo dolor est magna stet eirmod
                        </p>
                        <h2 class="text-white mb-0">+012 345 6789</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Offer Start -->
    <div
        class="container-fluid bg-offer my-5 py-5 wow fadeInUp"
        data-wow-delay="0.1s"
    >
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-7 wow zoomIn" data-wow-delay="0.6s">
                    <div class="offer-text text-center rounded p-5">
                        <h1 class="display-5 text-white">
                            Save 30% On Your First Dental Checkup
                        </h1>
                        <p class="text-white mb-4">
                            Eirmod sed tempor lorem ut dolores sit kasd ipsum.
                            Dolor ea et dolore et at sea ea at dolor justo ipsum
                            duo rebum sea. Eos vero eos vero ea et dolore eirmod
                            diam duo lorem magna sit dolore sed et.
                        </p>
                        <a
                            href="appointment.html"
                            class="btn btn-dark py-3 px-5 me-3"
                            >Appointment</a
                        >
                        <a href="" class="btn btn-light py-3 px-5">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->

    <!-- Pricing Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5">
                    <div class="section-title mb-4">
                        <h5
                            class="position-relative d-inline-block text-primary text-uppercase"
                        >
                            Pricing Plan
                        </h5>
                        <h1 class="display-5 mb-0">
                            We Offer Fair Prices for Dental Treatment
                        </h1>
                    </div>
                    <p class="mb-4">
                        Tempor erat elitr rebum at clita. Diam dolor diam ipsum
                        et tempor sit. Aliqu diam amet diam et eos labore. Clita
                        erat ipsum et lorem et sit, sed stet no labore lorem
                        sit. Sanctus clita duo justo eirmod magna dolore erat
                        amet
                    </p>
                    <h5
                        class="text-uppercase text-primary wow fadeInUp"
                        data-wow-delay="0.3s"
                    >
                        Call for Appointment
                    </h5>
                    <h1 class="wow fadeInUp" data-wow-delay="0.6s">
                        +012 345 6789
                    </h1>
                </div>
                <div class="col-lg-7">
                    <div
                        class="owl-carousel price-carousel wow zoomIn"
                        data-wow-delay="0.9s"
                    >
                        <div class="price-item pb-4">
                            <div class="position-relative">
                                <img
                                    class="img-fluid rounded-top"
                                    src="img/price-1.jpg"
                                    alt=""
                                />
                                <div
                                    class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle"
                                    style="z-index: 2"
                                >
                                    <h2 class="text-primary m-0">$35</h2>
                                </div>
                            </div>
                            <div
                                class="position-relative text-center bg-light border-bottom border-primary py-5 p-4"
                            >
                                <h4>Teeth Whitening</h4>
                                <hr class="text-primary w-50 mx-auto mt-0" />
                                <div
                                    class="d-flex justify-content-between mb-3"
                                >
                                    <span>Modern Equipment</span
                                    ><i
                                        class="fa fa-check text-primary pt-1"
                                    ></i>
                                </div>
                                <div
                                    class="d-flex justify-content-between mb-3"
                                >
                                    <span>Professional Dentist</span
                                    ><i
                                        class="fa fa-check text-primary pt-1"
                                    ></i>
                                </div>
                                <div
                                    class="d-flex justify-content-between mb-2"
                                >
                                    <span>24/7 Call Support</span
                                    ><i
                                        class="fa fa-check text-primary pt-1"
                                    ></i>
                                </div>
                                <a
                                    href="appointment.html"
                                    class="btn btn-primary bg-green py-2 px-4 position-absolute top-100 start-50 translate-middle"
                                    >Appointment</a
                                >
                            </div>
                        </div>
                        <div class="price-item pb-4">
                            <div class="position-relative">
                                <img
                                    class="img-fluid rounded-top"
                                    src="img/price-2.jpg"
                                    alt=""
                                />
                                <div
                                    class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle"
                                    style="z-index: 2"
                                >
                                    <h2 class="text-primary m-0">$49</h2>
                                </div>
                            </div>
                            <div
                                class="position-relative text-center bg-light border-bottom border-primary py-5 p-4"
                            >
                                <h4>Dental Implant</h4>
                                <hr class="text-primary w-50 mx-auto mt-0" />
                                <div
                                    class="d-flex justify-content-between mb-3"
                                >
                                    <span>Modern Equipment</span
                                    ><i
                                        class="fa fa-check text-primary pt-1"
                                    ></i>
                                </div>
                                <div
                                    class="d-flex justify-content-between mb-3"
                                >
                                    <span>Professional Dentist</span
                                    ><i
                                        class="fa fa-check text-primary pt-1"
                                    ></i>
                                </div>
                                <div
                                    class="d-flex justify-content-between mb-2"
                                >
                                    <span>24/7 Call Support</span
                                    ><i
                                        class="fa fa-check text-primary pt-1"
                                    ></i>
                                </div>
                                <a
                                    href="appointment.html"
                                    class="btn btn-primary bg-green py-2 px-4 position-absolute top-100 start-50 translate-middle"
                                    >Appointment</a
                                >
                            </div>
                        </div>
                        <div class="price-item pb-4">
                            <div class="position-relative">
                                <img
                                    class="img-fluid rounded-top"
                                    src="img/price-3.jpg"
                                    alt=""
                                />
                                <div
                                    class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle"
                                    style="z-index: 2"
                                >
                                    <h2 class="text-primary m-0">$99</h2>
                                </div>
                            </div>
                            <div
                                class="position-relative text-center bg-light border-bottom border-primary py-5 p-4"
                            >
                                <h4>Root Canal</h4>
                                <hr class="text-primary w-50 mx-auto mt-0" />
                                <div
                                    class="d-flex justify-content-between mb-3"
                                >
                                    <span>Modern Equipment</span
                                    ><i
                                        class="fa fa-check text-primary pt-1"
                                    ></i>
                                </div>
                                <div
                                    class="d-flex justify-content-between mb-3"
                                >
                                    <span>Professional Dentist</span
                                    ><i
                                        class="fa fa-check text-primary pt-1"
                                    ></i>
                                </div>
                                <div
                                    class="d-flex justify-content-between mb-2"
                                >
                                    <span>24/7 Call Support</span
                                    ><i
                                        class="fa fa-check text-primary pt-1"
                                    ></i>
                                </div>
                                <a
                                    href="appointment.html"
                                    class="btn btn-primary bg-green py-2 px-4 position-absolute top-100 start-50 translate-middle"
                                    >Appointment</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pricing End -->

    <!-- Testimonial Start -->
    <div
        class="container-fluid bg-green bg-testimonial py-5 my-5 wow fadeInUp"
        data-wow-delay="0.1s"
    >
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div
                        class="owl-carousel testimonial-carousel rounded p-5 wow zoomIn"
                        data-wow-delay="0.6s"
                    >
                        <div class="testimonial-item text-center text-white">
                            <img
                                class="img-fluid mx-auto rounded mb-4"
                                src="img/testimonial-1.jpg"
                                alt=""
                            />
                            <p class="fs-5">
                                Dolores sed duo clita justo dolor et stet lorem
                                kasd dolore lorem ipsum. At lorem lorem magna ut
                                et, nonumy labore diam erat. Erat dolor rebum
                                sit ipsum.
                            </p>
                            <hr class="mx-auto w-25" />
                            <h4 class="text-white mb-0">Client Name</h4>
                        </div>
                        <div class="testimonial-item text-center text-white">
                            <img
                                class="img-fluid mx-auto rounded mb-4"
                                src="img/testimonial-2.jpg"
                                alt=""
                            />
                            <p class="fs-5">
                                Dolores sed duo clita justo dolor et stet lorem
                                kasd dolore lorem ipsum. At lorem lorem magna ut
                                et, nonumy labore diam erat. Erat dolor rebum
                                sit ipsum.
                            </p>
                            <hr class="mx-auto w-25" />
                            <h4 class="text-white mb-0">Client Name</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.1s">
                    <div class="section-title bg-light rounded h-100 p-5">
                        <h5
                            class="position-relative d-inline-block text-primary text-uppercase"
                        >
                            Our Dentist
                        </h5>
                        <h1 class="display-6 mb-4">
                            Meet Our Certified & Experienced Dentist
                        </h1>
                        <a
                            href="appointment.html"
                            class="btn btn-primary bg-green py-3 px-5"
                            >Appointment</a
                        >
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                    <div class="team-item">
                        <div
                            class="position-relative rounded-top"
                            style="z-index: 1"
                        >
                            <img
                                class="img-fluid rounded-top w-100"
                                src="img/team-1.jpg"
                                alt=""
                            />
                            <div
                                class="position-absolute top-100 start-50 translate-middle bg-light rounded p-2 d-flex"
                            >
                                <a
                                    class="btn btn-primary bg-green btn-square m-1"
                                    href="#"
                                    ><i class="fab fa-twitter fw-normal"></i
                                ></a>
                                <a
                                    class="btn btn-primary bg-green btn-square m-1"
                                    href="#"
                                    ><i class="fab fa-facebook-f fw-normal"></i
                                ></a>
                                <a
                                    class="btn btn-primary bg-green btn-square m-1"
                                    href="#"
                                    ><i class="fab fa-linkedin-in fw-normal"></i
                                ></a>
                                <a
                                    class="btn btn-primary bg-green btn-square m-1"
                                    href="#"
                                    ><i class="fab fa-instagram fw-normal"></i
                                ></a>
                            </div>
                        </div>
                        <div
                            class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5"
                        >
                            <h4 class="mb-2">Dr. John Doe</h4>
                            <p class="text-primary mb-0">Implant Surgeon</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
                    <div class="team-item">
                        <div
                            class="position-relative rounded-top"
                            style="z-index: 1"
                        >
                            <img
                                class="img-fluid rounded-top w-100"
                                src="img/team-2.jpg"
                                alt=""
                            />
                            <div
                                class="position-absolute top-100 start-50 translate-middle bg-light rounded p-2 d-flex"
                            >
                                <a
                                    class="btn btn-primary bg-green btn-square m-1"
                                    href="#"
                                    ><i class="fab fa-twitter fw-normal"></i
                                ></a>
                                <a
                                    class="btn btn-primary bg-green btn-square m-1"
                                    href="#"
                                    ><i class="fab fa-facebook-f fw-normal"></i
                                ></a>
                                <a
                                    class="btn btn-primary bg-green btn-square m-1"
                                    href="#"
                                    ><i class="fab fa-linkedin-in fw-normal"></i
                                ></a>
                                <a
                                    class="btn btn-primary bg-green btn-square m-1"
                                    href="#"
                                    ><i class="fab fa-instagram fw-normal"></i
                                ></a>
                            </div>
                        </div>
                        <div
                            class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5"
                        >
                            <h4 class="mb-2">Dr. John Doe</h4>
                            <p class="text-primary mb-0">Implant Surgeon</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <div
                            class="position-relative rounded-top"
                            style="z-index: 1"
                        >
                            <img
                                class="img-fluid rounded-top w-100"
                                src="img/team-3.jpg"
                                alt=""
                            />
                            <div
                                class="position-absolute top-100 start-50 translate-middle bg-light rounded p-2 d-flex"
                            >
                                <a
                                    class="btn btn-primary bg-green btn-square m-1"
                                    href="#"
                                    ><i class="fab fa-twitter fw-normal"></i
                                ></a>
                                <a
                                    class="btn btn-primary bg-green btn-square m-1"
                                    href="#"
                                    ><i class="fab fa-facebook-f fw-normal"></i
                                ></a>
                                <a
                                    class="btn btn-primary bg-green btn-square m-1"
                                    href="#"
                                    ><i class="fab fa-linkedin-in fw-normal"></i
                                ></a>
                                <a
                                    class="btn btn-primary bg-green btn-square m-1"
                                    href="#"
                                    ><i class="fab fa-instagram fw-normal"></i
                                ></a>
                            </div>
                        </div>
                        <div
                            class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5"
                        >
                            <h4 class="mb-2">Dr. John Doe</h4>
                            <p class="text-primary mb-0">Implant Surgeon</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                    <div class="team-item">
                        <div
                            class="position-relative rounded-top"
                            style="z-index: 1"
                        >
                            <img
                                class="img-fluid rounded-top w-100"
                                src="img/team-4.jpg"
                                alt=""
                            />
                            <div
                                class="position-absolute top-100 start-50 translate-middle bg-light rounded p-2 d-flex"
                            >
                                <a
                                    class="btn btn-primary bg-green btn-square m-1"
                                    href="#"
                                    ><i class="fab fa-twitter fw-normal"></i
                                ></a>
                                <a
                                    class="btn btn-primary bg-green btn-square m-1"
                                    href="#"
                                    ><i class="fab fa-facebook-f fw-normal"></i
                                ></a>
                                <a
                                    class="btn btn-primary bg-green btn-square m-1"
                                    href="#"
                                    ><i class="fab fa-linkedin-in fw-normal"></i
                                ></a>
                                <a
                                    class="btn btn-primary bg-green btn-square m-1"
                                    href="#"
                                    ><i class="fab fa-instagram fw-normal"></i
                                ></a>
                            </div>
                        </div>
                        <div
                            class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5"
                        >
                            <h4 class="mb-2">Dr. John Doe</h4>
                            <p class="text-primary mb-0">Implant Surgeon</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
                    <div class="team-item">
                        <div
                            class="position-relative rounded-top"
                            style="z-index: 1"
                        >
                            <img
                                class="img-fluid rounded-top w-100"
                                src="img/team-5.jpg"
                                alt=""
                            />
                            <div
                                class="position-absolute top-100 start-50 translate-middle bg-light rounded p-2 d-flex"
                            >
                                <a
                                    class="btn btn-primary bg-green btn-square m-1"
                                    href="#"
                                    ><i class="fab fa-twitter fw-normal"></i
                                ></a>
                                <a
                                    class="btn btn-primary bg-green btn-square m-1"
                                    href="#"
                                    ><i class="fab fa-facebook-f fw-normal"></i
                                ></a>
                                <a
                                    class="btn btn-primary bg-green btn-square m-1"
                                    href="#"
                                    ><i class="fab fa-linkedin-in fw-normal"></i
                                ></a>
                                <a
                                    class="btn btn-primary bg-green btn-square m-1"
                                    href="#"
                                    ><i class="fab fa-instagram fw-normal"></i
                                ></a>
                            </div>
                        </div>
                        <div
                            class="team-text position-relative bg-light text-center rounded-bottom p-4 pt-5"
                        >
                            <h4 class="mb-2">Dr. John Doe</h4>
                            <p class="text-primary mb-0">Implant Surgeon</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->

    <!-- Newsletter Start -->
    <div
        class="container-fluid position-relative pt-5 wow fadeInUp"
        data-wow-delay="0.1s"
        style="z-index: 1"
    >
        <div class="container">
            <div class="bg-green p-5">
                <form class="mx-auto" style="max-width: 600px">
                    <div class="input-group">
                        <input
                            type="text"
                            class="form-control border-white p-3"
                            placeholder="Your Email"
                        />
                        <button class="btn btn-dark px-4">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Newsletter End -->

    <!-- Footer Start -->
    <div
        class="container-fluid bg-dark text-light py-5 wow fadeInUp"
        data-wow-delay="0.3s"
        style="margin-top: -75px"
    >
        <div class="container pt-5">
            <div class="row g-5 pt-4">
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Quick Links</h3>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="#"
                            ><i class="bi bi-arrow-right text-primary me-2"></i
                            >Home</a
                        >
                        <a class="text-light mb-2" href="#"
                            ><i class="bi bi-arrow-right text-primary me-2"></i
                            >About Us</a
                        >
                        <a class="text-light mb-2" href="#"
                            ><i class="bi bi-arrow-right text-primary me-2"></i
                            >Our Services</a
                        >
                        <a class="text-light mb-2" href="#"
                            ><i class="bi bi-arrow-right text-primary me-2"></i
                            >Latest Blog</a
                        >
                        <a class="text-light" href="#"
                            ><i class="bi bi-arrow-right text-primary me-2"></i
                            >Contact Us</a
                        >
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Popular Links</h3>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="#"
                            ><i class="bi bi-arrow-right text-primary me-2"></i
                            >Home</a
                        >
                        <a class="text-light mb-2" href="#"
                            ><i class="bi bi-arrow-right text-primary me-2"></i
                            >About Us</a
                        >
                        <a class="text-light mb-2" href="#"
                            ><i class="bi bi-arrow-right text-primary me-2"></i
                            >Our Services</a
                        >
                        <a class="text-light mb-2" href="#"
                            ><i class="bi bi-arrow-right text-primary me-2"></i
                            >Latest Blog</a
                        >
                        <a class="text-light" href="#"
                            ><i class="bi bi-arrow-right text-primary me-2"></i
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
                        <i class="bi bi-telephone text-primary me-2"></i>+012
                        345 67890
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
    <div class="container-fluid text-light py-4" style="background: #051225">
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
    <!-- Footer End -->

    <!-- Back to Top -->
    <a
        href="#"
        class="btn btn-lg btn-primary bg-green btn-lg-square rounded back-to-top"
        ><i class="bi bi-arrow-up"></i
    ></a>

    <!-- JavaScript Libraries -->

    <!-- Template Javascript -->
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>

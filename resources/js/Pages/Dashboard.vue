<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <!-- <Head title="Dashboard" /> -->

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        Hi <strong>IKONIC Team</strong>, <br />
                        This task is almost complete, i have completed the core
                        functionality of this system including
                        <ul class="list-disc p-5 space-y-2">
                            <li
                                class="border px-2 py-1 w-fit rounded bg-gray-200"
                            >
                                User Authentication
                            </li>
                            <li
                                class="border px-2 py-1 w-fit rounded bg-gray-200"
                            >
                                Feedback Submission
                            </li>
                            <li
                                class="border px-2 py-1 w-fit rounded bg-gray-200"
                            >
                                Feedback Listing
                            </li>
                            <li
                                class="border px-2 py-1 w-fit rounded bg-gray-200"
                            >
                                Feedback Voting
                            </li>
                            <li
                                class="border px-2 py-1 w-fit rounded bg-gray-200"
                            >
                                Commenting System
                            </li>
                            <li
                                class="border px-2 py-1 w-fit rounded bg-gray-200"
                            >
                                User Profiles
                            </li>
                            <li
                                class="border px-2 py-1 w-fit rounded bg-gray-200"
                            >
                                Notifications
                            </li>
                            <li
                                class="border px-2 py-1 w-fit rounded bg-gray-200"
                            >
                                Admin Panel
                            </li>
                            <li
                                class="border px-2 py-1 w-fit rounded bg-gray-200"
                            >
                                Advanced Commenting Features
                            </li>
                            <li
                                class="border px-2 py-1 w-fit rounded bg-gray-200"
                            >
                                Search Functionality
                            </li>
                            <li
                                class="border px-2 py-1 w-fit rounded bg-gray-200"
                            >
                                User Experience (UX)
                            </li>
                        </ul>
                        Please do check the functionality  of the system.
                        I <strong>have not</strong> done the <strong>Real Time Notifications</strong> because there were lot of things to do in such a short time and there was also electricity issue in my area.
                        I think this system still needs to be updated with better toasts and other things which can be improved.
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Layouts/Pagination.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, Link } from "@inertiajs/vue3";


export default {
    name: "Index",
    components: {
    AuthenticatedLayout,
    Pagination,
    Head,
    PrimaryButton,
    Link
},
    props: {
        feedbacks: {
            type: Object,
        },
        categories: {
            type: Object,
        },
    },
    data() {
        return {
            // Categories data
            selectedCategory: "Select Category", // Selected category ID
            searchQuery: "", // Search query
            feedbackData: [], // Store the provided JSON data here
            filteredFeedback: [],
        };
    },
    methods: {
        searchWithCateogry() {
            this.$inertia.get('/feedbacks',{search: this.selectedCategory},{
                preserveScroll: true,
                preserveState: true

            });
        },
    },
    watch:{
        searchQuery(value){
            this.$inertia.get('/feedbacks',{search: value},{
                preserveScroll: true,
                preserveState: true

            });
        }
    }


};
</script>

<template>
    <Head title="Feedbacks" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                Feedbacks
            </h2>
        </template>
        <div class="">
            <div
                class="px-2 py-2 md:flex-1 md:p-5 md:overflow-y-auto flex flex-col justify-between items-center"
                scroll-region=""
            >
                <div class="w-3/4">
                    <!---->
                    <h1 class="mb-8 text-3xl text-white font-bold">
                        Feedbacks
                    </h1>
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center mr-4 w-full max-w-lg">
                            <div
                                class="flex w-full bg-white rounded shadow"
                            >
                                <select
                                    class="form-select w-full"
                                    v-model="selectedCategory"
                                    @change="searchWithCateogry"
                                >
                                    <option selected value="">Select Category</option>
                                    <option
                                        v-for="category in categories"
                                        :value="category.id"
                                    >
                                        {{ category.name }}
                                    </option>
                                </select>

                                <input
                                    class="relative px-6 py-3 w-full rounded-r focus:shadow-outline"
                                    autocomplete="off"
                                    type="text"
                                    name="search"
                                    v-model="searchQuery"
                                    @keydown="searchWithInput"
                                    placeholder="Search…"
                                />

                            </div>
                        </div>
                        <div>
                            <Link as="button" :href="route('feedbacks.create')" class="bg-white  px-6 rounded hover:bg-gray-800 hover:text-white transition-all duration-150 ease-in py-2 hover:border-white hover:border" >Create</Link>
                        </div>
                    </div>
                    <div class="bg-white rounded-md shadow overflow-x-auto">
                        <table class="w-full whitespace-nowrap">
                            <thead>
                                <tr class="text-left font-bold">
                                    <th class="pb-4 pt-6 px-6">Title</th>
                                    <th class="pb-4 pt-6 px-6">Description</th>
                                    <th class="pb-4 pt-6 px-6">Vote Count</th>
                                    <th class="pb-4 pt-6 px-6">Category</th>
                                    <th class="pb-4 pt-6 px-6">User Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="feedback in feedbacks.data"
                                    :key="feedback.id"
                                    class="hover:bg-gray-100 focus-within:bg-gray-100"
                                >
                                    <td class="border-t">
                                        <Link
                                            class="flex items-center px-6 py-4 focus:text-indigo-500"
                                            :href="route('feedbacks.show',feedback.id)"
                                            >{{ feedback.title ?? "" }}
                                        </Link
                                        >
                                    </td>
                                    <td class="border-t">
                                        <Link
                                            class="flex items-center px-6 py-4"
                                            tabindex="-1"
                                            :href="route('feedbacks.show',feedback.id)"
                                            >{{
                                                feedback.description.substring(
                                                    0,
                                                    7
                                                ) ?? ""
                                            }}</Link
                                        >
                                    </td>
                                    <td class="border-t">
                                        <Link
                                            class="flex items-center px-6 py-4"
                                            tabindex="-1"
                                            :href="route('feedbacks.show',feedback.id)"
                                            >{{
                                                feedback.votes
                                                    ? feedback.votes.length
                                                    : "No Votes"
                                            }}</Link
                                        >
                                    </td>
                                    <td class="border-t">
                                        <Link                                           class="flex items-center px-6 py-4"
                                            tabindex="-1"
                                            :href="route('feedbacks.show',feedback.id)"
                                            >{{
                                                feedback.category
                                                    ? feedback.category.name
                                                    : "No Votes"
                                            }}</Link
                                        >
                                    </td>
                                    <td class="border-t">
                                        <Link
                                            class="flex items-center px-6 py-4"
                                            tabindex="-1"
                                            :href="route('feedbacks.show',feedback.id)"
                                            >{{
                                                feedback.user
                                                    ? feedback.user.name
                                                    : "No Name"
                                            }}</Link
                                        >
                                    </td>
                                    <td class="w-px border-t">
                                        <Link
                                            class="flex items-center px-4"
                                            tabindex="-1"
                                            :href="route('feedbacks.show',feedback.id)"
                                            ><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                class="block w-6 h-6 fill-gray-400"
                                            >
                                                <polygon
                                                    points="12.95 10.707 13.657 10 8 4.343 6.586 5.757 10.828 10 6.586 14.243 8 15.657 12.95 10.707"
                                                ></polygon></svg
                                        ></Link>
                                    </td>
                                </tr>
                                <!---->
                            </tbody>
                        </table>
                    </div>
                    <!---->
                </div>
                <div class="flex items-end justify-end">
                    <Pagination class="mt-6" :links="feedbacks.links" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

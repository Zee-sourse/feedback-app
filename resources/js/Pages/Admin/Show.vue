<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import { Inertia } from "@inertiajs/inertia";
import { reactive } from "vue";
import { Head, Link } from "@inertiajs/vue3";


defineProps({
    feedback: {
        type: Object,
    },
    users: {
        type: Object,
    },
});

const form = reactive({
    input: "",
    textarea: "",
    feedback_id: null,
});

const timeAgo = (timestamp) => {
    const date = new Date(timestamp);
    const now = new Date();
    const seconds = Math.floor((now - date) / 1000);

    // Define time intervals in seconds
    const intervals = {
        year: 31536000,
        month: 2592000,
        week: 604800,
        day: 86400,
        hour: 3600,
        minute: 60,
        second: 1,
    };

    // Calculate time difference
    let counter;
    for (const interval in intervals) {
        counter = Math.floor(seconds / intervals[interval]);
        if (counter > 0) {
            if (counter === 1) {
                return counter + " " + interval + " ago";
            } else {
                return counter + " " + interval + "s ago";
            }
        }
    }

    return "Just now";
};


const deleteFeedback = (id) => {
    const data = { feedback_id: id };
    Inertia.post(route("feedbacks.admin.delete"), data);
};


function formatString(inputString) {
    // Check if the string contains the "@" symbol
    if (inputString.includes("@")) {
        // Remove the "@" symbol
        // inputString = inputString.replace('@', '');

        // Split the string into words
        const words = inputString.split(" ");

        // Check if there are at least two words
        if (words.length >= 2) {
            // Format the first and second words with <strong> tags
            inputString = `<strong>${words[0]}</strong> <strong>${
                words[1]
            }</strong> ${words.slice(2).join(" ")}`;
        }
    }

    return inputString;
}

const convertComment = (jsonString) => {
    // const jsonString = '{"ops":[{"insert":"simple"},{"attributes":{"bold":true},"insert":"Bold"},{"insert":null},{"attributes":{"italic":true},"insert":"Italics"},{"insert":null},{"attributes":{"underline":true,"italic":true},"insert":"underline"},{"insert":"asdas"},{"attributes":{"code-block":true},"insert":null},{"insert":null}]}';

    // Parse the JSON string into a JavaScript object
    const jsonObject = JSON.parse(jsonString);

    // Initialize variables to store the formatted text
    let formattedText = "";

    // Iterate through the "ops" array
    for (const op of jsonObject.ops) {
        if (op.insert !== null) {
            // Check for formatting attributes and apply HTML tags
            if (op.attributes && op.attributes.bold) {
                formattedText += `<strong>${op.insert}</strong> `;
            } else if (op.attributes && op.attributes.italic) {
                formattedText += `<em>${op.insert}</em> `;
            } else if (op.attributes && op.attributes.underline) {
                formattedText += `<u>${op.insert}</u> `;
            } else {
                formattedText += op.insert + " ";
            }
        }
    }

    return formattedText.trim();
};
</script>

<template>
    <AuthenticatedLayout>
        <!-- component -->
        <div class="bg-gray-900 flex items-center justify-center">
            <div class="bg-white p-8 rounded-lg shadow-md w-3/4">
                <!-- User Info with Three-Dot Menu -->
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-2">
                        <div>
                            <p class="text-gray-800 font-semibold">
                                {{ feedback.user.name }}
                                <span
                                    >(Category :
                                    {{ feedback.category.name }})</span
                                >
                            </p>
                            <p class="text-gray-500 text-sm">
                                {{ timeAgo(feedback.created_at) }}
                            </p>
                        </div>
                    </div>
                    <div class="text-gray-500 cursor-pointer space-x-2">
                            <Link as="button" :href="route('feedbacks.admin.edit',feedback.id)" class="bg-gray-800 text-white  px-6 rounded hover:bg-gray-600 hover:text-gray-white transition-all duration-150 ease-in py-2 hover:border-white hover:border" >Edit</Link>
                            <Link as="button" @click="deleteFeedback(feedback.id)" class="bg-red-800 text-white  px-6 rounded hover:bg-red-600 hover:text-gray-white transition-all duration-150 ease-in py-2 hover:border-white hover:border" >Delete</Link>
                    </div>
                </div>
                <!-- Message -->
                <div class="mb-4">
                    <p class="text-gray-800">{{ feedback.title }}</p>
                </div>
                <!-- Image -->
                <div class="mb-4">
                    <p>{{ feedback.description }}</p>
                </div>
                <!-- Like and Comment Section -->
                <div class="flex items-center justify-between text-gray-500">
                    <div class="flex items-center space-x-2">
                        <button
                          
                            class="flex justify-center items-center gap-2 px-2 hover:bg-gray-50 rounded-full p-1"
                        >
                            <img src="/images/up.png" alt="" class="w-6" />
                            <span>{{ feedback.upvotes.length }} Upvotes</span>
                        </button>
                        <button

                            class="flex justify-center items-center gap-2 px-2 hover:bg-gray-50 rounded-full p-1"
                        >
                            <img src="/images/down.png" alt="" class="w-6" />
                            <span
                                >{{ feedback.downvotes.length }} Downvotes</span
                            >
                        </button>
                    </div>
                    <button
                        class="flex justify-center items-center gap-2 px-2 hover:bg-gray-50 rounded-full p-1"
                    >
                        <svg
                            width="22px"
                            height="22px"
                            viewBox="0 0 24 24"
                            class="w-5 h-5 fill-current"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g
                                id="SVGRepo_tracerCarrier"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            ></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 13.5997 2.37562 15.1116 3.04346 16.4525C3.22094 16.8088 3.28001 17.2161 3.17712 17.6006L2.58151 19.8267C2.32295 20.793 3.20701 21.677 4.17335 21.4185L6.39939 20.8229C6.78393 20.72 7.19121 20.7791 7.54753 20.9565C8.88837 21.6244 10.4003 22 12 22ZM8 13.25C7.58579 13.25 7.25 13.5858 7.25 14C7.25 14.4142 7.58579 14.75 8 14.75H13.5C13.9142 14.75 14.25 14.4142 14.25 14C14.25 13.5858 13.9142 13.25 13.5 13.25H8ZM7.25 10.5C7.25 10.0858 7.58579 9.75 8 9.75H16C16.4142 9.75 16.75 10.0858 16.75 10.5C16.75 10.9142 16.4142 11.25 16 11.25H8C7.58579 11.25 7.25 10.9142 7.25 10.5Z"
                                ></path>
                            </g>
                        </svg>
                        <span>{{ feedback.comments.length }} Comment</span>
                    </button>
                </div>
                <div class="mt-4">
                    <!-- Comment 1 -->
                    <div
                        v-for="comment in feedback.comments"
                        class="flex gap-y-3 my-3 items-center space-x-2"
                    >
                        <div class="border p-2 w-full border-gray-500 rounded">
                            <p class="text-gray-800 font-semibold">
                                {{ comment.user.name }}
                                <span class="text-gray-600 text-xs">
                                    ( {{ timeAgo(comment.created_at) }} )</span
                                >
                            </p>
                            <p
                                class="text-gray-700 text-sm ml-2"
                                v-html="formatString(comment.text)"
                            ></p>
                            <p
                                class="text-gray-700 text-sm ml-3"
                                v-html="convertComment(comment.content)"
                            ></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

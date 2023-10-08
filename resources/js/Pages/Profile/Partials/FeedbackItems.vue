<script setup>
defineProps({
    user_feedbacks: {
        type: Object,
    },
});
</script>

<template>
    <div class="bg-white rounded-md shadow overflow-x-auto">
        <h2 class="text-xl font-bold underline text-gray-700" >Feedbacks</h2>
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
                    v-for="feedback in user_feedbacks.feedbacks"
                    :key="feedback.id"
                    class="hover:bg-gray-100 focus-within:bg-gray-100"
                >
                    <td class="border-t">
                        <p
                            class="flex items-center px-6 py-4 focus:text-indigo-500"

                            >{{ feedback.title ?? "" }}
                        </p>
                    </td>
                    <td class="border-t">
                        <p
                            class="flex items-center px-6 py-4"
                            >{{
                                feedback.description.substring(0, 7) ?? ""
                            }}</p
                        >
                    </td>
                    <td class="border-t">
                        <p
                            class="flex items-center px-6 py-4"
                            tabindex="-1"

                            >{{
                                feedback.votes
                                    ? feedback.votes.length
                                    : "No Votes"
                            }}</p
                        >
                    </td>
                    <td class="border-t">
                        <p
                            class="flex items-center px-6 py-4"
                            tabindex="-1"

                            >{{
                                feedback.category
                                    ? feedback.category.name
                                    : "No Votes"
                            }}</p
                        >
                    </td>
                    <td class="border-t">
                        <p
                            class="flex items-center px-6 py-4"
                            tabindex="-1"

                            >{{
                                feedback.user ? feedback.user.name : "No Name"
                            }}</p
                        >
                    </td>
                </tr>
            </tbody>

            <p v-if="user_feedbacks.feedbacks.length < 0" class="p-2 text-center">No records found</p>
        </table>
    </div>
</template>

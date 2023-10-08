
<script>
import { Mentionable } from "vue-mention";
import "floating-vue/dist/style.css";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

export default {
    components: {
        Mentionable,
        QuillEditor,
    },
    props: {
        users: {
            type: Array,
        },
    },

    data() {
        return {
            text: "",
            items: [
                { value: 'Judd Jaskolski', label: "Judd Jaskolski" },
                { id: 2, name: "Sven Bednar" },
                { id: 3, name: "Stone Corkery" },
                { id: 4, name: "Dimitri Abbott II" },
                { id: 5, name: "Prof. Alexandro Ankunding" },
                { id: 6, name: "Prof. Ahmed Cronin" },
                { id: 7, name: "Monserrat Grimes" },
                { id: 8, name: "Prof. Edison Okuneva Sr." },
                { id: 9, name: "Dr. Autumn VonRueden DDS" },
                { id: 10, name: "Jayme Klocko" },
                { id: 11, name: "Mrs. Aubree Ebert III" },
                { id: 12, name: "Ms. Trisha Hahn" },
                { id: 13, name: "Oran Keebler Sr." },
                { id: 14, name: "Prof. Reece Heidenreich" },
                { id: 15, name: "Cassandre Haley" },
                { id: 16, name: "Pat Berge" },
                { id: 17, name: "Estelle Kunze" },
                { id: 18, name: "Hunter Koss" },
                { id: 19, name: "Joshua Hermann" },
                { id: 20, name: "Griffin Kuvalis" },
                { id: 21, name: "Kelsie Cruickshank" },
                { id: 22, name: "Adelle Goodwin" },
                { id: 23, name: "Halie Reichel" },
                { id: 24, name: "Tanya Stroman" },
                { id: 25, name: "Earnestine Erdman PhD" },
                { id: 26, name: "Miller Weissnat" },
                { id: 27, name: "Domenic Macejkovic MD" },
                { id: 28, name: "Stella Senger" },
                { id: 29, name: "Jacinto Rice Sr." },
                { id: 30, name: "Emmalee Bogisich" },
                { id: 31, name: "Price Solis" },
                { id: 32, name: "Darius Maynard" },
            ],
        };
    },
};
</script>
<template>
    <Mentionable :keys="['@']" :items="items" offset="6">
        <QuillEditor
            theme="snow"
            v-model="text"
            :toolbar="['bold', 'italic', 'underline', 'code-block']"
        />
    </Mentionable>
</template>
<style>
.mention-item {
    padding: 4px 10px;
    border-radius: 4px;
}

.mention-selected {
    background: rgb(192, 250, 153);
}
</style>

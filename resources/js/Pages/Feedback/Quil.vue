<script>
import VueQuillEditor from "@vueup/vue-quill";
export default {
    name: "Quil",
    components: {
        VueQuillEditor,
    },
    data() {
        return {
            editorContent: "",
            editorOptions: {
                modules: {
                    toolbar: [
                        [{ header: "1" }, { header: "2" }],
                        ["bold", "italic", "underline"],
                        ["link"],
                        [{ list: "ordered" }, { list: "bullet" }],
                        ["image"],
                        ["code-block"],
                    ],
                },
            },
        };
    },
};
</script>
<template>
    <div>
        <vue-quill-editor  :options="editorOptions" />
    </div>
</template>

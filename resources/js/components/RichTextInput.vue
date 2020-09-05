<template>
    <div>
        <quill-editor
            ref="quillEditorPl"
            v-model="content_pl"
            :options="editorOption"
            @change="onEditorChange($event)"
        />

        <input type="text" id="content_pl" name="content_pl" :value="contentPl" hidden>

        <quill-editor
            ref="quillEditorEn"
            v-model="content_en"
            v-if="multilang"
            :options="editorOption"
            @change="onEditorChange($event)"
        />

        <input type="text" id="content_en" name="content_en" :value="contentEn" hidden>
    </div>
</template>

<script>
import { quillEditor } from 'vue-quill-editor';

const { mathquill4quill } = window;

import 'quill/dist/quill.core.css';
import 'quill/dist/quill.snow.css';
import 'quill/dist/quill.bubble.css';

export default {
    components: {
        quillEditor
    },
    props: [
        'initialContentPl',
        'initialContentEn',
        'language',
        'multilang',
    ],
    data() {
        return {
            contentPl: this.initialContentPl,
            contentEn: this.initialContentEn,
            editorOption: {
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'script': 'sub'}, { 'script': 'super' }],
                        [{ 'indent': '-1'}, { 'indent': '+1' }],
                        // [{ 'size': ['small', false, 'large', 'huge'] }],
                        // [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                        // [{ 'color': [] }, { 'background': [] }],
                        [{ 'align': [] }],
                        ['formula'],
                        ['clean'],
                    ],
                },
                placeholder: (this.language === 'pl') ? 'Wpisz tutaj treść zadania...' : 'Type text of the assignment here...',
            },
        };
    },
    methods: {
        onEditorChange({ quill, html, text}) {
            this.$root.$emit('content_exists', (!!text && text !== '\n'));
        }
    },
    computed: {
        editorPl() {
            return this.$refs.quillEditorPl.quill;
        },
        editorEn() {
            return this.$refs.quillEditorEn.quill;
        }
    },
    mounted() {
        const enableMathQuillFormulaAuthoring = mathquill4quill();
        enableMathQuillFormulaAuthoring(this.editorPl);
        enableMathQuillFormulaAuthoring(this.editorEn);
    }
}
</script>

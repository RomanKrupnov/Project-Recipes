<template>
    <div
        :class="'col-md-9 ckeditir-class'"
        :data-type="context.type"
    >
        <ckeditor id="ckeditor" :editor="editor" v-model="context.model"></ckeditor>
    </div>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        name: 'HtmlEditor',
        props: {
            context: {
                type: Object,
                required: true
            },
        },
        data() {
            return {
                editor: ClassicEditor,
                editorData: '',
                editorConfig: {
                    language: 'ru'
                }
            }
        },
        computed: {
            model() {
                return this.context.model
            }
        }
    }
</script>

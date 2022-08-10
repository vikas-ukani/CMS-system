<template>
    <div>
        <div class="mb-3">
            <label for="title" class="form-label">Page title</label>
            <input type="email" v-model="title" class="form-control" id="title" placeholder="name@example.com">
        </div>
        <div class="form-group">
            <ckeditor tag-name="textarea" ref="cktext" :editor="editor" v-model="content" :config="editorConfig"
            >
            </ckeditor>
        </div>
    </div>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {

    data() {
        return {
            editor: ClassicEditor,
            editorConfig: {
                // The configuration of the editor.
            },
            parentPages: [],
            title: '',
            slug: '',
            content: '<p>Content of the editor.</p>',
            parent_id: null
        }
    },

} 
</script>

<style>
</style>
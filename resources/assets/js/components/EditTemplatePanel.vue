<template>
    <div class="editor-container">
        <CodeEditor
            :code="code"
            :onSave="saveTemplate"
        ></CodeEditor>

        <v-snackbar
            v-model="snackbar.visible"
            :color="snackbar.color"
            :timeout="2000"
        >
            {{ snackbar.message }}
            <v-btn
                dark flat
                @click="hideSnackbar"
            >Close</v-btn>
        </v-snackbar>
    </div>
</template>

<script>
    import axios from 'axios';
    import CodeEditor from './CodeEditor.vue'

    export default {
        components: {
            CodeEditor
        },
        beforeCreate() {
            document.body.setAttribute('data-edit-template', '')
        },
        beforeDestroy() {
            document.body.removeAttribute('data-edit-template')
        },
        created() {
            this.templateId = this.$route.params.templateId

            // load template
            this.loadTemplate()
        },
        data() {
            return {
                loading: true,
                templateId: null,
                templates: [],
                code: '',
                snackbar: {
                    message: '',
                    visible: false,
                    color: '',
                },
            }
        },
        methods: {
            loadTemplate() {
                return axios
                    .get('/api/admin/settings/templates/' + this.templateId, {
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + window.user.accessToken,
                        }
                    })
                    .then(response => {
                        this.code = response.data.content
                    })
                    .catch(err => {
                        console.error(err.message)
                    })
            },
            hideSnackbar() {
                this.snackbar.visible = false
            },
            showSnackbar(message, color, icon) {
                this.snackbar.message = message
                this.snackbar.visible = true
                this.snackbar.color = color ? color : ''
            },
            saveTemplate(code) {
                return axios
                    .put('/api/admin/settings/templates/' + this.templateId, {
                        _method: 'PUT',
                        content: code,
                    }, {
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + window.user.accessToken,
                        }
                    })
                    .then(response => {
                        this.showSnackbar('Saved', 'success', 'check_circle')
                    })
                    .catch(err => {
                        this.showSnackbar('Error saving', 'error', 'error')
                    })
                    .finally(() => {
                        // ensure code is synced with editor
                        this.code = code
                    })
            },
        },
    }
</script>

<style>
    body[data-edit-template] .container,
    .editor-container,
    .code-editor {
        height: 100%;
        padding: 0;
    }
</style>

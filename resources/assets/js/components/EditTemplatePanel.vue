<template>
    <div class="content">
        <CodeEditor :code="code" :onSave="saveTemplate"></CodeEditor>
    </div>
</template>

<script>
    import axios from 'axios';
    import CodeEditor from './CodeEditor.vue'

    export default {
        props: [
            'templateId'
        ],
        components: {
            CodeEditor
        },
        created() {
            // load template
            this.loadTemplate()
        },
        data() {
            return {
                loading: true,
                templates: [],
                code: '',
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
                        M.toast({html: 'Saved!'})
                    })
                    .catch(err => {
                        console.error(err.message)
                        M.toast({html: 'Error saving!'})
                    })
                    .finally(() => {
                        // ensure code is synced with editor
                        this.code = code
                    })
            },
        },
    }
</script>

<style scoped>
    h1 {
        margin-left: 2rem;
    }

    .code-editor {
        height: calc(100vh - 64px);
    }
</style>

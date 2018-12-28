<template>
    <div class="content">
        <CodeEditor></CodeEditor>
    </div>
</template>

<script>
    import CodeEditor from './CodeEditor.vue'

    export default {
        data() {
            return {
                loading: true,
                templates: [],
                code: '',
            }
        },
        components: {
            CodeEditor
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

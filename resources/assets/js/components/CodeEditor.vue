<template>
    <div class="code-editor">
        <codemirror v-model="code" :options="editorOptions" ref="cm"></codemirror>
        <div class="code-editor__actions">
            <button type="button" class="btn-floating btn-small" v-on:click="openSettings">
                <i class="material-icons">tune</i>
            </button>
        </div>

        <div id="settings-modal" class="modal">
            <div class="modal-content">
                <button type="button" class="btn-flat modal-close right">
                    <i class="material-icons">close</i>
                </button>

                <h4>Editor Settings</h4>

                <h5>Theme</h5>
                <p>
                    <label>
                        <input type="radio" v-model="editorOptions.theme" value="default" checked />
                        <span>Light</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input type="radio" v-model="editorOptions.theme" value="dracula" />
                        <span>Dark</span>
                    </label>
                </p>

                <h5>Key Map</h5>
                <p>
                    <label>
                        <input type="radio" v-model="editorOptions.keyMap" value="default" checked />
                        <span>Normal</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input type="radio" v-model="editorOptions.keyMap" value="vim" />
                        <span>Vim</span>
                    </label>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    import { codemirror } from 'vue-codemirror'
    import 'codemirror/lib/codemirror.css'
    import 'codemirror/theme/dracula.css'
    import 'codemirror/keymap/vim.js'

    export default {
        mounted() {
            // init settings modal
            const modalEl = document.querySelector('#settings-modal')
            M.Modal.init(modalEl, {})
            this.settingsModal = M.Modal.getInstance(modalEl)

            // init inputs
            const inputEls = modalEl.querySelectorAll('select');
            M.FormSelect.init(inputEls, {});

            this.codemirror.save = () => {
                const toast = M.toast({html: 'Saving...'})

                setTimeout(() => {
                    toast.dismiss()
                    M.toast({html: 'Saved!'})
                }, 2000)
            }
        },
        data() {
            return {
                code: '',
                editorOptions: {
                    // codemirror options
                    tabSize: 2,
                    mode: 'text/html',
                    theme: 'default',
                    keyMap: 'default',
                    line: true,
                    lineNumbers: true,
                }
            }
        },
        components: {
            codemirror
        },
        computed: {
            codemirror() {
                return this.$refs.cm.codemirror
            }
        },
        methods: {
            openSettings() {
                this.settingsModal.open()
            }
        },
    }
</script>

<style>
    .code-editor {
        position: relative;
    }

    .code-editor .vue-codemirror,
    .code-editor .CodeMirror {
        height: 100%;
    }

    .code-editor__actions {
        position: absolute;
        right: 1rem;
        bottom: 1rem;
        z-index: 999;
    }
</style>

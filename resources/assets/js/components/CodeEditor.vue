<template>
    <div class="code-editor">
        <codemirror v-model="content" :options="editorOptions" ref="cm"></codemirror>
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
                        <input
                            type="radio"
                            v-model="editorOptions.theme"
                            value="default"
                            checked
                        />
                        <span>Light</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input
                            type="radio"
                            v-model="editorOptions.theme"
                            value="blackboard"
                        />
                        <span>Dark</span>
                    </label>
                </p>

                <h5>Key Map</h5>
                <p>
                    <label>
                        <input
                            type="radio"
                            v-model="editorOptions.keyMap"
                            value="default"
                            checked
                        />
                        <span>Normal</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input
                            type="radio"
                            v-model="editorOptions.keyMap"
                            value="vim"
                        />
                        <span>Vim</span>
                    </label>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import { codemirror } from 'vue-codemirror'
    import 'codemirror/lib/codemirror.css'
    import 'codemirror/theme/blackboard.css'
    import 'codemirror/keymap/vim.js'

    export default {
        props: [
            'code',
            'onSave',
        ],
        data() {
            return {
                content: '',
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
        watch: {
            editorOptions: {
                deep: true,
                handler() {
                    this.saveSettings()
                }
            },
            code(newVal, oldVal) {
                if (newVal === oldVal) {
                    return
                }

                this.content = this.code
            },
        },
        mounted() {
            // load user settings
            this.loadSettings()

            // init settings modal
            const modalEl = document.querySelector('#settings-modal')
            M.Modal.init(modalEl, {})
            this.settingsModal = M.Modal.getInstance(modalEl)

            // init inputs
            const inputEls = modalEl.querySelectorAll('select');
            M.FormSelect.init(inputEls, {});

            this.codemirror.save = () => {
                this.save()
            }
        },
        components: {
            codemirror
        },
        computed: {
            codemirror() {
                return this.$refs.cm.codemirror
            },
        },
        methods: {
            save() {
                if (typeof this.onSave === 'function') {
                    this.onSave(this.content)
                }
            },
            openSettings() {
                this.settingsModal.open()
            },
            loadSettings() {
                return axios
                    .get('/api/admin/settings/code-editor/' + user.id, {
                        headers: {
                            'Authorization': 'Bearer ' + user.accessToken
                        }
                    })
                    .then(response => {
                        const settings = response.data

                        this.editorOptions.theme = settings.theme || 'default'
                        this.editorOptions.keyMap = settings.keymap || 'default'
                    })
            },
            saveSettings() {
                return axios
                    .put('/api/admin/settings/code-editor/' + user.id, {
                        _method: 'PUT',
                        theme: this.editorOptions.theme,
                        keymap: this.editorOptions.keyMap,
                    }, {
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + user.accessToken
                        }
                    })
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
        top: 1rem;
        z-index: 999;
    }
</style>

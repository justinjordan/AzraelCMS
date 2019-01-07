<template>
    <div class="code-editor">
        <codemirror v-model="content" :options="editorOptions" ref="cm"></codemirror>
        <div class="code-editor__actions">
            <!-- Setting Dialog -->
            <v-dialog width="300" v-model="settingsDialog">
                <v-btn
                    fab small
                    slot="activator"
                >
                    <v-icon>tune</v-icon>
                </v-btn>
                <v-card>
                    <v-card-title
                        primary-title
                        class="headline blue white--text"
                    >
                        Editor Settings
                    </v-card-title>
                    <v-card-text>
                        <!-- Theme -->
                        <v-select
                            label="Theme"
                            :items="themeOptions"
                            v-model="editorOptions.theme"
                        ></v-select>

                        <!-- Key Map -->
                        <v-select
                            label="Key Map"
                            :items="keyMapOptions"
                            v-model="editorOptions.keyMap"
                        ></v-select>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>

                        <v-btn
                            @click="settingsDialog = false"
                        >Close</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import hotkeys from 'hotkeys-js'
    import { codemirror } from 'vue-codemirror'
    import 'codemirror/lib/codemirror.css'
    import 'codemirror/theme/blackboard.css'
    import 'codemirror/keymap/vim.js'

    export default {
        props: [
            'code',
        ],
        data() {
            return {
                content: '',
                settingsDialog: false,
                themeOptions: [
                    {
                        text: 'Light',
                        value: 'default',
                    },
                    {
                        text: 'Dark',
                        value: 'blackboard',
                    },
                ],
                keyMapOptions: [
                    {
                        text: 'Normal',
                        value: 'default',
                    },
                    {
                        text: 'Vim',
                        value: 'vim',
                    },
                ],
                editorOptions: {
                    // codemirror options
                    tabSize: 2,
                    mode: 'text/html',
                    theme: 'default',
                    keyMap: 'default',
                    line: true,
                    lineNumbers: true,
                    extraKeys: {
                        'Ctrl-S': this.save,
                        'Cmd-S': this.save,
                    },
                }
            }
        },
        watch: {
            editorOptions: {
                deep: true,
                handler() {
                    if (this.ignoreSettingsChange) {
                        this.ignoreSettingsChange = false
                        return
                    }

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

            // setup vim save
            this.codemirror.save = () => {
                this.save()
            }

            // setup key combo save
            hotkeys('ctrl+s,cmd+s', (event, handler) => {
                event.preventDefault()
                this.save()
            })
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
                this.$emit('save', this.content)
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

                        this.ignoreSettingsChange = true
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

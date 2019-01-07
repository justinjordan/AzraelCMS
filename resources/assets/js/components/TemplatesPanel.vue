<template>
    <v-layout child-flex>
        <v-data-table
            :headers="headers"
            :items="templates"
            no-data-text="No templates"
            class="elevation-1"
        >
            <template slot="items" slot-scope="props">
                <td>
                    <router-link
                        :to="'/admin/settings/templates/' + props.item.id"
                    >{{ props.item.name }}</router-link>
                </td>
                <td>{{ props.item.type }}</td>
                <td>{{ props.item.active ? 'Active' : 'Inactive' }}</td>
                <td>
                    <!-- Edit Button -->
                    <v-btn
                        fab small outline
                        color="primary"
                        @click="openEditDialog(props.item)"
                    >
                        <v-icon>edit</v-icon>
                    </v-btn>

                    <!-- delete button and dialog -->
                    <v-dialog width="400" v-model="props.item.deleteDialog">
                        <v-btn
                            fab small outline
                            color="red white--text"
                            slot="activator"
                        >
                            <v-icon>delete</v-icon>
                        </v-btn>
                        <v-card>
                            <v-card-title
                                primary-title
                                class="headline blue white--text"
                            >Delete Template</v-card-title>
                            <v-card-text>
                                Would you like to permanently delete the template?
                            </v-card-text>

                            <v-divider></v-divider>

                            <v-card-actions>
                                <v-spacer></v-spacer>

                                <v-btn
                                    @click="props.item.deleteDialog = false"
                                >Cancel</v-btn>

                                <v-btn
                                    color="red white--text"
                                    @click="deleteTemplate(props.item.id); props.item.deleteDialog = false"
                                >Delete</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </td>
            </template>
        </v-data-table>

        <!-- Create Dialog -->
        <v-btn
            fab fixed bottom right
            color="primary"
            @click="openCreateDialog"
        >
            <v-icon>add</v-icon>
        </v-btn>
        <v-dialog width="400" v-model="showCreateDialog">
            <v-card>
                <v-card-title
                    primary-title
                    class="headline blue white--text"
                >Create Template</v-card-title>
                <v-card-text>
                    <!-- Form -->
                    <v-text-field
                        label="Name"
                        ref="createTemplateName"
                        v-model="newTemplateData.name"
                    ></v-text-field>

                    <v-select
                        label="Type"
                        :items="templateTypes"
                        v-model="newTemplateData.type"
                    ></v-select>

                    <v-switch
                        label="Active"
                        v-model="newTemplateData.active"
                    ></v-switch>
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn
                        @click="showCreateDialog = false"
                    >Discard</v-btn>

                    <v-btn
                        color="primary"
                        @click="createTemplate(); showCreateDialog = false"
                    >Create</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <!-- Edit Dialog -->
        <v-dialog width="400" v-model="showEditDialog">
            <v-card>
                <v-card-title
                    primary-title
                    class="headline blue white--text"
                >Edit Template</v-card-title>
                <v-card-text>
                    <!-- Edit Form -->
                    <v-text-field
                        label="Name"
                        v-model="editTemplateData.name"
                    ></v-text-field>

                    <v-select
                        label="Type"
                        :items="templateTypes"
                        v-model="editTemplateData.type"
                    ></v-select>

                    <v-switch
                        label="Active"
                        v-model="editTemplateData.active"
                    ></v-switch>
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn
                        @click="showEditDialog = false"
                    >Discard</v-btn>

                    <v-btn
                        color="primary"
                        @click="editTemplate(); showEditDialog = false"
                    >Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-layout>
</template>

<script>
    import axios from 'axios'

    export default {
        data: function() {
            return {
                selection: null,
                headers: [
                    {
                        text: 'Name',
                        value: 'name',
                    },
                    {
                        text: 'Type',
                        value: 'type',
                    },
                    {
                        text: 'Active',
                        value: 'active',
                    },
                    {
                        text: 'Edit',
                        value: 'edit',
                    },
                ],
                templateTypes: [
                    'layout',
                    'snippet',
                ],
                templates: [],
                newTemplateData: {},
                editTemplateData: {},
                showEditDialog: false,
                showCreateDialog: false,
            }
        },
        mounted() {
            this.loadTemplates()
        },
        created() {
            this.$store.commit('addBreadcrumb', {
                text    : 'Settings',
                to      : '/admin/settings',
            })
            this.$store.commit('addBreadcrumb', {
                text    : 'Templates',
                to      : '/admin/settings/templates',
            })
        },
        destroyed() {
            this.$store.commit('clearBreadcrumbs')
        },
        methods: {
            loadTemplates() {
                axios.get('/api/admin/settings/templates', {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + window.user.accessToken,
                    }
                }).then(response => {
                    this.templates = response.data
                })
            },
            createTemplate() {
                axios.post('/api/admin/settings/templates', {
                    name: this.newTemplateData.name,
                    type: this.newTemplateData.type,
                    active: this.newTemplateData.active,
                }, {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + window.user.accessToken,
                    }
                }).then(response => {
                    this.loadTemplates()
                }).finally(() => {
                    this.newTemplateData = {}
                })
            },
            deleteTemplate(id) {
                if (!id) return

                axios.delete('/api/admin/settings/templates/' + id, {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + window.user.accessToken,
                    }
                }).then(response => {
                    this.loadTemplates()
                }).finally(() => {
                    this.deleteModal.close()
                })
            },
            editTemplate() {
                axios.put('/api/admin/settings/templates/' + this.editTemplateData.id, {
                    _method: 'PUT',
                    name: this.editTemplateData.name,
                    type: this.editTemplateData.type,
                    active: this.editTemplateData.active,
                }, {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + window.user.accessToken,
                    }
                })
                .then(response => {
                    // refresh templates
                    this.loadTemplates()
                })
                .catch(err => {
                    console.error(err.message)
                })
                .finally(() => {
                    this.editTemplateData = {}
                })
            },
            openEditDialog(template) {
                this.editTemplateData = {
                    id : template.id,
                    name: template.name,
                    type: template.type,
                    active: template.active,
                }

                this.showEditDialog = true
            },
            openCreateDialog() {
                this.newTemplateData = {
                    name: '',
                    type: 'layout',
                    active: true,
                }

                this.showCreateDialog = true

                setTimeout(() => {
                    this.$refs.createTemplateName.focus()
                }, 0)
            },
        },
    }
</script>

<style>
</style>

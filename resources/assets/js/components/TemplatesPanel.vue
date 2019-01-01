<template>
    <div class="content">
        <div class="actions">
            <a href="/admin/pages/new" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Active</th>
                </tr>
            </thead>
            <tbody>
                <template v-if="!templates || templates.length <= 0">
                    <tr>
                        <td colspan="3"><em>No templates</em></td>
                    </tr>
                </template>
                <template v-else>
                    <tr v-for="template in templates" v-bind:key="template.id">
                        <td>
                            <a :href="'/admin/settings/templates/' + template.id + '/edit'">{{ template.name }}</a>
                        </td>
                        <td>{{ template.type }}</td>
                        <td>{{ template.active ? 'yes' : 'no' }}</td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        data: function() {
            return {
                templates: []
            }
        },
        mounted() {
            axios.get('/api/admin/settings/templates', {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + window.user.accessToken,
                }
            }).then(templates => {
                this.templates = templates.data
            })
        }
    }
</script>

<style>
    h1 {
        margin-left: 2rem;
    }

    .content {
        min-height: 100vh;
        padding: 2rem;
    }
</style>

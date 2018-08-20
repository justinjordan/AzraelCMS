<template>
    <div class="content-inner-wrapper">
        <h1>Pages</h1>

        <div class="actions">
            <a href="/admin/pages/new" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>
        </div>

        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-if="!pages">
                        <tr>
                            <td colspan="3"><em>No pages.</em></td>
                        </tr>
                    </template>
                    <template v-else>
                        <tr v-for="page in pages">
                            <td><a :href="'/admin/pages/edit/' + page.id">{{ page.name }}</a></td>
                            <td>{{ page.type }}</td>
                            <td>{{ page.status }}</td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    module.exports = {
        data: function() {
            return {
                pages: [
                    {
                        id: 1,
                        name: "Test Page",
                        type: "Test",
                        status: "Active"
                    }
                ]
            };
        }
    }
</script>

<style>
    h1 {
        margin: 2rem 2rem;
    }

    .content {
        position: absolute;
        min-height: 100vh;
        top: 6rem; right: 0; left: 0;
        padding: 2rem;
        background-color: #fff;
        border-top: 1px solid #ccc;
    }

    .actions {
        position: absolute;
        top: 1.2rem;
        right: 1rem;
    }
</style>

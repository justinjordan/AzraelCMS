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
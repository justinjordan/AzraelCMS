<template>
    <v-layout>
        TODO: create pages panel
    </v-layout>
</template>

<script>
    module.exports = {
        created() {
            // Set breadcrumbs
            this.$store.commit('setBreadcrumbs', [
                {
                    text: 'Pages',
                    disabled: true,
                },
            ])
        },
        data() {
            return {
                pages: []
            }
        },
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

<template>
    <v-layout>
        TODO: create dashboard panel
    </v-layout>
</template>

<script>
    export default {
        created() {
            // Set breadcrumbs
            this.$store.commit('setBreadcrumbs', [
                {
                    text: 'Dashboard',
                    disabled: true,
                },
            ])
        },
    }
</script>

<style scoped></style>
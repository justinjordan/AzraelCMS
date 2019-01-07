<template>
    <router-link :to="to">
        <v-btn
            outline
            large
            fab
            color="indigo"
        >
            <v-icon>{{ icon }}</v-icon>
        </v-btn>
        <p class="label">{{ label }}</p>
    </router-link>
</template>

<script>
    export default {
        props: [
            'icon',
            'label',
            'to',
        ],
    }
</script>

<style scoped>
    .label {
        color: #000;
        text-decoration: none;
        text-align: center;
    }
</style>
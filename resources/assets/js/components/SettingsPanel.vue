<template>
    <v-layout justify-start align-start>
        <settings-icon
            v-for="(category, i) in categories"
            :key="i"
            :icon="category.icon"
            :label="category.label"
            :to="category.href"
        ></settings-icon>
    </v-layout>
</template>

<script>
    import axios from 'axios'
    import SettingsIcon from './SettingsIcon'

    export default {
        components: {
            SettingsIcon
        },
        created() {
            // Set breadcrumbs
            this.$store.commit('setBreadcrumbs', [
                {
                    text: 'Settings',
                    disabled: true,
                },
            ])

            axios.get('/api/admin/settings/categories', {
                headers: {
                    'Authorization': 'Bearer ' + user.accessToken
                }
            })
                .then(response => {
                    this.categories = response.data
                })
                .catch(err => {
                    this.error = 'API Error: ' + err.message
                })
                .finally(() => {
                    this.loading = false
                })
        },
        data() {
            return {
                error: null,
                loading: true,
                categories: []
            }
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

    .category {
        display: inline-block;
        padding-right: 1rem;
        padding-bottom: 1rem;
    }

    .category__btn {
        display: inline-block;
        padding: 1rem;
        background: none;
        outline: none;
        border: none;
        text-align: center;
        color: black;
    }
    .category__btn:hover {
        background-color: #ddd;
    }

    .category__icon i {
        font-size: 3rem;
    }
</style>

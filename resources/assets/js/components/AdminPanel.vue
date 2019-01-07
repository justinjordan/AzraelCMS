<template>
    <v-app>
        <v-navigation-drawer app>
            <v-list>
                <v-list-tile
                    :key="i"
                    v-for="(navItem,i) in navItems"
                    :to="navItem.path"
                >
                    <v-list-tile-action>
                        <v-icon>{{ navItem.icon }}</v-icon>
                    </v-list-tile-action>

                    <v-list-tile-content>
                        <v-list-tile-title>{{ navItem.label }}</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>

                <v-divider></v-divider>

                <v-list-tile
                    @click="signout"
                >
                    <v-list-tile-action>
                        <v-icon>exit_to_app</v-icon>
                    </v-list-tile-action>

                    <v-list-tile-content>
                        <v-list-tile-title>Sign Out</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar app>
            <v-breadcrumbs :items="breadcrumbs"></v-breadcrumbs>
        </v-toolbar>
        <v-content>
            <v-container fluid>
                <router-view></router-view>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                navItems: [
                    {
                        label: 'Dashboard',
                        icon: 'dashboard',
                        path: '/admin/dashboard',
                    },
                    {
                        label: 'Pages',
                        icon: 'description',
                        path: '/admin/pages',
                    },
                    {
                        label: 'Settings',
                        icon: 'settings',
                        path: '/admin/settings',
                    },
                ]
            }
        },
        computed: {
            breadcrumbs() {
                return this.$store.state.breadcrumbs
            },
        },
        methods: {
            signout() {
                window.location.pathname = '/admin/signout'
            }
        },
    }
</script>

<style scoped>
    /**/
</style>

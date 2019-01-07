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
                const pathParts = this.$route.path.split('/')
                let currentPath = ''
                const crumbs = [];

                for (var i = 0, l = pathParts.length; i < l; i++) {
                    let part = pathParts[i]
                    currentPath += part ? '/' + part : ''

                    if (!part || part === 'admin') {
                        continue
                    }

                    let label = part.replace('-', ' ').replace(/\b\w/g, l => l.toUpperCase())

                    crumbs.push({
                        text: label,
                        to: currentPath,
                        disabled: i === l-1,
                        exact: true,
                    })
                }

                return crumbs
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

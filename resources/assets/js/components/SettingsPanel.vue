<template>
    <div class="content">
        <h1>Settings</h1>
        <div class="content__inner-wrap">
            <ul>
                <li v-for="(category, i) in categories" :key="i">
                    <a :href="category.href" class="btn-large">
                        <i class="material-icons left">{{ category.icon }}</i>
                        <span>{{ category.label }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import Settings from '../providers/settings.js';

    export default {
        created() {
            Settings.getCategories().then(cats => {
                this.categories = cats
                this.loading = false
            })
        },
        data() {
            return {
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

    .content__inner-wrap {
        min-height: 100vh;
        padding: 2rem;
        background-color: #fff;
        border-top: 1px solid #ccc;
    }
</style>

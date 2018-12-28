<template>
    <div class="content">
        <div class="preloader-wrapper big active" v-if="loading">
            <div class="spinner-layer spinner-blue-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        
        <ul v-if="!loading">
            <li class="category" v-for="(category, i) in categories" :key="i">
                <a class="category__btn" :href="category.href">
                    <div class="category__icon">
                        <i class="material-icons">{{ category.icon }}</i>
                    </div>
                    <span class="category__label">{{ category.label }}</span>
                </a>
            </li>
        </ul>
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
        background-color: white;
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

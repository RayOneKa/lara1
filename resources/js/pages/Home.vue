<template>
    <div>
        <div class="row">
            <div v-for="category in categories" :key="category.id" class="col-3">
                <router-link :to="'categories/' + category.id">
                    <div class="card mb-4" style="width: 18rem;">
                        <img :src="`/storage/img/categories/` + category.picture" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{category.name}}
                            </h5>
                            <p class="card-text">
                                {{ category.description }}
                            </p>
                        </div>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                categories: []
            }
        },
        methods: {
            redirect () {
                this.$router.push('/categories/1')
            }
        },
        mounted () {
            axios.get('/api/categories/get')
                .then((response) => {
                    this.categories = response.data
                })
        },
        destroyed () {
            console.log('вышли со страницы home')
        }
    }
</script>
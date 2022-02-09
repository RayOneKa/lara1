<template>
    <div>
        <table class="table table-borderd mb-5">
            <tbody>
                <tr v-for='user in users' :key='user.id'>
                    <td>{{user.id}}</td>
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td>
                        <a :href="`/admin/enterAsUser/${user.id}`">
                            Войти
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>


        <button
            :disabled='currentPage == 1'
            @click='getUsers(currentPage - 1)'
            class="btn btn-link"
        >
            Назад
        </button>
        <button
            v-for='(link, idx) in links'
            :key='idx'
            :disabled='link.label == currentPage'
            @click='getUsers(link.label)'
            class="btn btn-link"
            :class='getCurrentPageClass(link.label)'
        >
            {{ link.label }}
        </button>
        <button
            :disabled='currentPage == links.length'
            @click='getUsers(currentPage + 1)'
            class="btn btn-link"
        >
            Вперед
        </button>

        <br>

        <button @click='exportCategories' class="btn btn-link">Выгрузить категории</button>

        <div v-if="processing" class="alert alert-warning mt-4">
            Выгружаем категории
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div v-else-if="exportFinish" class="alert alert-success mt-4">
            Категории выгружены! <a :href='downloadLink'>(Скачать!)</a>
        </div>

    </div>
</template>

<script>

export default {
    data () {
        return {
            processing: false,
            exportFinish: false,
            downloadLink: null,
            users: [],
            links: [],
            currentPage: null
        }
    },
    methods: {
        exportCategories () {
            this.processing = true
            this.exportFinish = false
            // axios.post(this.routeExportCategories)
        },
        getUsers (page = 1) {
            if (page == this.currentPage)
                return false
            const newLink = `/admin?page=${page}`
            if (this.$route.fullPath != newLink) {
                this.$router.push(newLink) 
            }
            const params = {
                page
            }
            axios.get('/api/admin/users', {params})
                .then(response => {
                    this.users = response.data.data
                    const links = response.data.links.splice(1, response.data.links.length - 2)
                    this.links = links
                    this.currentPage = response.data.current_page
                })
        },
        getCurrentPageClass (page) {
            return page == this.currentPage ? 'current-page' : ''
        }
    },
    mounted () {
        const page = this.$route.query.page
        this.getUsers(page)
        Echo.channel('general')
            .listen('.categories-export-finish', (e) => {
                this.downloadLink = `/storage/${e.message}`
                this.processing = false
                this.exportFinish = true
            });
    },
    destroyed () {
        Echo.channel('general')
            .stopListening('.categories-export-finish')
    }
}
</script>

<style scoped>
    .current-page {
        color: green;
        background-color: aquamarine;
    }
</style>
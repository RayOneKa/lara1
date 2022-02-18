<template>
    <div>
        <table class="table table-borderd mb-5" :class="{updating: updating}">
            <thead>
                <tr>
                    <th style="width: 10%;">
                        <label @click='sort("id")' class="sort-label">ID <span v-html="getSortArrow('id')"></span></label>
                        <input v-model='filters.id.value' @input="filter()" class="form-control">
                    </th>
                    <th style="width: 40%;">
                        <label @click='sort("name")' class="sort-label">Имя <span v-html="getSortArrow('name')"></span></label>
                        <input v-model='filters.name.value' @input="filter()" class="form-control">
                    </th>
                    <th style="width: 40%;">
                        <label @click='sort("email")' class="sort-label">Почта <span v-html="getSortArrow('email')"></span></label>
                        <input v-model='filters.email.value' @input="filter()" class="form-control">
                    </th>
                    <th style="width: 10%;"></th>
                </tr>
            </thead>
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
                <tr v-if='!users.length'>
                    <td colspan="4" class="text-muted text-center">Загрузка...</td>
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

        <select v-model='length' @change='getUsers()' class="form-control users-per-page">
            <option v-for='(length, idx) in usersPerPage' :key='idx'>{{length}}</option>
        </select>

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
            usersPerPage: [3, 5, 10, 50],
            length: 3,
            processing: false,
            exportFinish: false,
            downloadLink: null,
            users: [],
            links: [],
            currentPage: null,
            updating: false,
            sortColumn: {
                column: 'id',
                direction: 'asc'
            },
            currentDirection: 'asc',
            filters: {
                id: {
                    value: null,
                    type: '='
                },
                name: {
                    value: null,
                    type: 'like'
                },
                email: {
                    value: null,
                    type: 'like'
                },
            },
            delay: null
        }
    },
    methods: {
        getSortArrow (column) {
            if (column != this.sortColumn.column) {
                return '&udarr;'
            } else {
                return this.currentDirection == 'asc' ? '&uarr;' : '&darr;'
            }
        },
        sort (column) {
            if (column == this.sortColumn.column) {
                this.currentDirection = this.currentDirection == 'asc' ? 'desc' : 'asc'
                this.sortColumn.direction = this.currentDirection
            } else {
                this.currentDirection = 'asc'
                this.sortColumn.direction = this.currentDirection
                this.sortColumn.column = column
            }
            this.getUsers()
        },
        filter () {
            clearTimeout(this.delay)
            this.delay = setTimeout(() => {
                this.getUsers()
            }, 1000)
        },
        exportCategories () {
            this.processing = true
            this.exportFinish = false
            // axios.post(this.routeExportCategories)
        },
        getUsers (page = 1) {
            this.updating = true
            // if (page == this.currentPage)
            //     return false
            const newLink = `/admin?page=${page}`
            if (this.$route.fullPath != newLink) {
                this.$router.push(newLink) 
            }
            const params = {
                page,
                length: this.length,
                filters: this.filters,
                sortColumn: this.sortColumn
            }

            axios.post('/api/admin/users', params)
                .then(response => {
                    this.users = response.data.data
                    const links = response.data.links.splice(1, response.data.links.length - 2)
                    this.links = links
                    this.currentPage = response.data.current_page
                })
                .finally(() => {
                    this.updating = false
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
    .users-per-page {
        width: 50px;
        display: inline;
        float: right;
    }

    .updating {
        transition: all 0.3s ease;
    }

    table.updating {
        position: relative;
        color: rgba(0, 0, 0, 0.3);
    }

    table.updating a {
        color: rgba(0, 0, 0, 0.3);
    }

    table.updating tbody:after {
        transition: all 0.3s ease;
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        background-color: rgba(0, 0, 0, 0.05);
    }

    .sort-label {
        cursor: pointer;
    }
</style>
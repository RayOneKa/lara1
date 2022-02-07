<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <router-link class="nav-link" to="/">
                SHOP
            </router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/basket" >
                            Корзина
                        </router-link>
                    </li>

                    <li v-if='!user.name' class="nav-item">
                        <router-link class="nav-link" to='/login'>Авторизация</router-link>
                    </li>
                    <li v-if='!user.name' class="nav-item">
                        <router-link class="nav-link" to='/register'>Регистрация</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to='/admin'>Админка</router-link>
                    </li>
                    <li v-if='user.name' class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link nav-link-picture dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <img
                            src="/storage/img/users/nopicture.png"
                            style="height:40px;width:40px;border-radius: 100px;border: 1px solid grey;"
                            
                        >
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <span class="dropdown-login">
                                <strong>{{ user.name }}</strong>
                            </span>
                            <router-link class="nav-link" to='/profile'>Личный кабинет</router-link>
                            <router-link class="nav-link" to='/orders'>Заказы</router-link>
                            <button @click='logout' class="btn btn-link nav-link">Выход</button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        computed: {
            quantity () {
                const qn = this.$store.state.basketProductsQuantity
                return qn ? `(${qn})` : ''
            },
            user () {
                return this.$store.state.user
            }
        },
        methods: {
            logout () {
                axios.post('/api/logout')
                    .then(() => {
                        this.$store.dispatch('getUser', {})
                        if (this.$route.path != '/')
                            this.$router.push('/')
                    })
            }
        },
        mounted () {
            this.$store.dispatch('getBasketProductsQuantity', {})
            if (!this.user.name) {
                axios.get('/api/user')
                    .then(response => {
                        this.$store.dispatch('getUser', response.data)
                    })
            }
        }
    }
</script>

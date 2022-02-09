import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const Foo = { template: '<div>foo</div>' }
const Bar = { template: '<div>bar</div>' }
const Page404 = { template: '<div>404</div>' }

import HomePage from '../pages/Home'
import CategoryPage from '../pages/Category'
import BasketPage from '../pages/Basket'
import LoginPage from '../pages/Auth/Login'
import RegisterPage from '../pages/Auth/Register'
import AdminPage from '../pages/Admin/Users'

const routes = [
  { path: '*', redirect: '404'},
  { path: '/', component: HomePage},
  { path: '/categories/:id', component: CategoryPage},
  { path: '/basket', component: BasketPage},
  { path: '/login', component: LoginPage},
  { path: '/register', component: RegisterPage},
  { path: '/admin', component: AdminPage},
  { path: '/404', component: Page404, name: '404' },
  { path: '/foo', component: Foo },
  { path: '/bar', component: Bar }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

export default router
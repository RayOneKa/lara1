import axios from 'axios'
import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        user: {},
        basketProductsQuantity: 0
    },
    getters: {

    },
    mutations: {
        setUser (state, payload) {
            state.user = payload
        },
        setBasketProductsQuantity (state, payload) {
            state.basketProductsQuantity = payload
        }
    },
    actions: {
        getUser (context, payload) {
            context.commit('setUser', payload)
        },
        changeBasketProductsQuantity (context, payload) {
            context.commit('setBasketProductsQuantity', payload)
        },
        getBasketProductsQuantity (context, payload) {
            axios.get('/basket/getProductsQuantity')
                .then((response) => {
                    context.commit('setBasketProductsQuantity', response.data)
                })
        }
    }
})

export default store
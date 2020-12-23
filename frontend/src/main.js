import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

import axios from "axios"
axios.defaults.baseURL = 'http://localhost:8000/'

import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.css'
import '@/assets/css/style.css'
import '@/assets/vendors/mdi/css/materialdesignicons.min.css'

import Toasted from 'vue-toasted'

const api_token = localStorage.getItem('api_token')
if (api_token) {
  axios.defaults.headers.common['Authorization'] = 'Bearer ' + api_token
}
Vue.config.productionTip = false
Vue.use(Toasted)

store.dispatch('auth/get_user').then(() => {
  new Vue({
    router,
    store,
    render: h => h(App)
  }).$mount('#app')
}).catch((error) => {
  console.error(error)
})



import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

import axios from 'axios'
axios.defaults.baseURL = 'http://localhost:8000'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap'

const api_token = localStorage.getItem('api_token')

if (api_token) {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + api_token
}

store.dispatch('auth/get_user', api_token).then(() => {
    createApp(App).use(store).use(router).mount('#app')
}).catch((error) => {
    console.error(error)
})

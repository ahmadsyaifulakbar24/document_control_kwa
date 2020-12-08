import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

import axios from "axios"
axios.defaults.baseURL = process.env.VUE_APP_API_ENDPOINT

import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.css'

import Toasted from 'vue-toasted'

Vue.config.productionTip = false
Vue.use(Toasted)

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')

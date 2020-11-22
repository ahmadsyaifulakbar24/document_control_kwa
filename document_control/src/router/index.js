import { createRouter, createWebHistory } from 'vue-router'
import Login from '../views/Login.vue'
import Dashboard from '../views/Dashboard.vue'
import Upload from '../views/fileManager/Upload.vue'
import store from "../store";

const routes = [
  {
    path: '/',
    name: 'login',
    component: Login,
    meta: {
      guest: true,
    }
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: Dashboard,
    meta: {
      auth: true
    }
  },

  {
    path: '/file_manager/upload/:folder_path?',
    name: 'file_manager.upload',
    component: Upload,
    meta: {
      auth: true
    }
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  linkActiveClass: 'active',
  routes
})
router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.auth)) {
    if (store.getters['auth/isLoggedIn'] && store.getters['auth/user']) {
      next()
      return
    }
    next('/')
  }

  if (to.matched.some(record => record.meta.guest)) {
    if (!store.getters['auth/isLoggedIn']) {
      next()
      return
    }
    next('dashboard')
  }
  next()
})
export default router

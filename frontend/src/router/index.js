import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../views/Login.vue'
import Dashboard from '../views/Dashboard.vue'
import ListProject from '../views/project/ListProject'
import CreateProject from '../views/project/CreateProject'
import EditProject from '../views/project/EditProject'
import ListSubProject from '../views/project/sub_project/ListSubProject'
import CreateSubProject from '../views/project/sub_project/CreateSubProject'
import EditSubProject from '../views/project/sub_project/EditSubProject'
import store from '../store'

Vue.use(VueRouter)

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
    name: 'dashboard',
    component: Dashboard,
    meta: {
      auth: true,
    }
  },

  {
    path: '/project',
    name: 'project',
    component: ListProject,
    meta: {
      auth: true
    }
  },
  {
    path: '/project/create',
    name: 'project.create',
    component: CreateProject,
    meta: {
      auth: true
    }
  },
  {
    path: '/project/:projectID/edit',
    name: 'project.edit',
    component: EditProject,
    meta: {
      auth: true
    }
  },
  {
    path: '/project/:projectID/sub_project',
    name: 'subProject.listSubProject',
    component: ListSubProject,
    meta: {
      auth: true
    }
  },
  {
    path: '/project/:projectID/create_project',
    name: 'subProject.createSubProject',
    component: CreateSubProject,
    meta: {
      auth: true
    }
  },
  {
    path: '/sub_project/:projectID/:subProjectID',
    name: 'subProject.EditSubProject',
    component: EditSubProject,
    meta: {
      auth: true
    }
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
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

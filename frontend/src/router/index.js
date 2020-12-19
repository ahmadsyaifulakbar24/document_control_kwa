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
import UploadFileSubProject from '../views/project/sub_project/UploadFile'
import Ppjab from '../views/ppjab/ppjab/ListPpjab'
import CreatePpjab from '../views/ppjab/ppjab/CreatePpjab'
import EditPpjab from '../views/ppjab/ppjab/EditPpjab'
import FolderDocument from '../views/ppjab/document/FolderDocument'
import ListDocumentPpajb from '../views/ppjab/document/ListDocument'
import UploadDocumentPpajb from '../views/ppjab/document/UploadDocument'
import ListKontrak from '../views/kontrak/kontrak/ListKontrak'
import CreateKontrak from '../views/kontrak/kontrak/CreateKontrak'
import UpdateKontrak from '../views/kontrak/kontrak/UpdateKontrak'
import ListAmandemen from '../views/kontrak/amandemen/ListAmandemen'
import CreateAmandemen from '../views/kontrak/amandemen/CreateAmandemen'
import UpdateAmandemen from '../views/kontrak/amandemen/UpdateAmandemen'
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
  },
  {
    path: '/sub_project/:projectID/:subProjectID/upload_file',
    name: 'subProject.UploadFileSubProject',
    component: UploadFileSubProject,
    meta: {
      auth: true
    }
  },
  {
    path: '/ppjab',
    name: 'ppjab',
    component: Ppjab,
    meta: {
      auth: true
    }
  },
  {
    path: '/ppjab/create',
    name: 'ppjab.create',
    component: CreatePpjab,
    meta: {
      auth: true
    }
  },
  {
    path: '/ppjab/:ppjabID/edit',
    name: 'ppjab.edit',
    component: EditPpjab,
    meta: {
      auth: true
    }
  },
  {
    path: '/ppjab/:ppjabID/folder_document',
    name: 'ppjab.folderDocument',
    component: FolderDocument,
    meta: {
      auth: true
    }
  },
  {
    path: '/ppjab/:ppjabID/:groupID/document',
    name: 'ppjab.document',
    component: ListDocumentPpajb,
    meta: {
      auth: true
    }
  },
  {
    path: '/ppjab/:ppjabID/:groupID/upload_document',
    name: 'ppjab.uploadDocument',
    component: UploadDocumentPpajb,
    meta: {
      auth: true
    }
  },
  {
    path: '/kontrak',
    name: 'kontrak',
    component: ListKontrak,
    meta: {
      auth: true
    }
  },
  {
    path: '/kontrak/create',
    name: 'kontrak.create',
    component: CreateKontrak,
    meta: {
      auth: true
    }
  },
  {
    path: '/kontrak/:kontrakID/update',
    name: 'kontrak.update',
    component: UpdateKontrak,
    meta: {
      auth: true
    }
  },
  {
    path: '/amandemen/:kontrakID',
    name: 'amandemen',
    component: ListAmandemen,
    meta: {
      auth: true
    }
  },
  {
    path: '/amandemen/:kontrakID/create',
    name: 'amandemen.create',
    component: CreateAmandemen,
    meta: {
      auth: true
    }
  },
  {
    path: '/amandemen/:kontrakID/:amandemenID/update',
    name: 'amandemen.update',
    component: UpdateAmandemen,
    meta: {
      auth: true
    }
  },

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

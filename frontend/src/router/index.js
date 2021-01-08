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
import admin from './middleware/admin'
import auth from './middleware/auth'
import financeAndManager from './middleware/financeAndManager'
import manager from './middleware/manager'
import managerAndDirecture from './middleware/managerAndDirecture'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'login',
    component: Login,
    meta: {
      guest: true,
      title: 'Login'
    }
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
    meta: {
      middleware: [auth],
      title: 'Dashboard'
    }
  },

  {
    path: '/project',
    name: 'project',
    component: ListProject,
    meta: {
      middleware: [auth],
      title: 'Project'
    }
  },
  {
    path: '/project/create',
    name: 'project.create',
    component: CreateProject,
    meta: {
      middleware: [auth, admin],
      title: 'Create Project'
    }
  },
  {
    path: '/project/:projectID/edit',
    name: 'project.edit',
    component: EditProject,
    meta: {
      middleware: [auth, admin],
      title: 'Edit Project'
    }
  },
  {
    path: '/project/:projectID/sub_project',
    name: 'subProject.listSubProject',
    component: ListSubProject,
    meta: {
      middleware: [auth],
      title: 'Dokumen Project'
    }
  },
  {
    path: '/project/:projectID/create_project',
    name: 'subProject.createSubProject',
    component: CreateSubProject,
    meta: {
      middleware: [auth, admin],
      title: 'Create Project'
    }
  },
  {
    path: '/sub_project/:projectID/:subProjectID',
    name: 'subProject.EditSubProject',
    component: EditSubProject,
    meta: {
      middleware: [auth, admin],
      title: 'Edit Dokumen Project'
    }
  },
  {
    path: '/sub_project/:projectID/:subProjectID/upload_file',
    name: 'subProject.UploadFileSubProject',
    component: UploadFileSubProject,
    meta: {
      middleware: [auth, financeAndManager],
      title: 'Upload Dokumen Project'
    }
  },
  {
    path: '/ppjab',
    name: 'ppjab',
    component: Ppjab,
    meta: {
      middleware: [auth],
      title: 'PPJAB'
    }
  },
  {
    path: '/ppjab/create',
    name: 'ppjab.create',
    component: CreatePpjab,
    meta: {
      middleware: [auth, admin],
      title: 'Create PPJAB'
    }
  },
  {
    path: '/ppjab/:ppjabID/edit',
    name: 'ppjab.edit',
    component: EditPpjab,
    meta: {
      middleware: [auth, admin],
      title: 'Edit PPJAB'
    }
  },
  {
    path: '/ppjab/:ppjabID/folder_document',
    name: 'ppjab.folderDocument',
    component: FolderDocument,
    meta: {
      middleware: [auth],
      title: 'PPJAB Folder'
    }
  },
  {
    path: '/ppjab/:ppjabID/:groupID/document',
    name: 'ppjab.document',
    component: ListDocumentPpajb,
    meta: {
      middleware: [auth],
      title: 'PPJAB Document'
    }
  },
  {
    path: '/ppjab/:ppjabID/:groupID/upload_document',
    name: 'ppjab.uploadDocument',
    component: UploadDocumentPpajb,
    meta: {
      middleware: [auth, manager],
      title: 'Upload Documen PPJAB'
    }
  },
  {
    path: '/kontrak',
    name: 'kontrak',
    component: ListKontrak,
    meta: {
      middleware: [auth, managerAndDirecture],
      title: 'Kontrak'
    }
  },
  {
    path: '/kontrak/create',
    name: 'kontrak.create',
    component: CreateKontrak,
    meta: {
      middleware: [auth, manager],
      title: 'Create Kontrak'
    }
  },
  {
    path: '/kontrak/:kontrakID/update',
    name: 'kontrak.update',
    component: UpdateKontrak,
    meta: {
      auth: true,
      middleware: [auth, manager],
      title: 'Edit Kontrak'
    }
  },
  {
    path: '/amandemen/:kontrakID',
    name: 'amandemen',
    component: ListAmandemen,
    meta: {
      middleware: [auth, managerAndDirecture],
      title: 'amandemen'
    }
  },
  {
    path: '/amandemen/:kontrakID/create',
    name: 'amandemen.create',
    component: CreateAmandemen,
    meta: {
      middleware: [auth, manager],
      title: 'Create Amandemen'
    }
  },
  {
    path: '/amandemen/:kontrakID/:amandemenID/update',
    name: 'amandemen.update',
    component: UpdateAmandemen,
    meta: {
      middleware: [auth, manager],
      title: 'Edit Amandemen'
    }
  },

]

const router = new VueRouter({
  mode: 'history',
  linkActiveClass: 'active',
  base: process.env.BASE_URL,
  routes
})

function nextFactory(context, middleware, index) {
  const subsequentMiddleware = middleware[index]
  if (!subsequentMiddleware) {
    return context.next
  }
  return (...parameters) => {
    context.next(...parameters)
    const nextMiddleware = nextFactory(context, middleware, index + 1)
    subsequentMiddleware({ ...context, next: nextMiddleware })
  }
}

const DEFAULT_TITLE = 'Dokumen Kontrol';
router.beforeEach((to, from, next) => {
  Vue.nextTick(() => {
    document.title = to.meta.title != '' ? to.meta.title+' - '+DEFAULT_TITLE : DEFAULT_TITLE
  })
  
  if (to.meta.middleware) {
    const middleware = Array.isArray(to.meta.middleware) ? to.meta.middleware : [to.meta.middleware]
    const context = { from, next, router, to }
    const nextMiddleware = nextFactory(context, middleware, 1)
    return middleware[0]({...context, next: nextMiddleware})
  }

  if (to.matched.some(record => record.meta.guest)) {
    if (!store.getters['auth/isLoggedIn']) {
      next()
      return
    }
    next('/dashboard')
  }
  
  return next()
})
export default router

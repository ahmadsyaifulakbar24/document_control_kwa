import store from '../../store'

export default function auth({ next }) {
    if (store.getters['auth/isLoggedIn'] && store.getters['auth/user']) {
        return next()    
    }
    return next('/')
}
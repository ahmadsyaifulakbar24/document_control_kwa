import store from '../../store'

export default function admin({ next }) {
    let user = store.getters['auth/user']
    if (user.user_level_id == 100) {
        return next()
    }
    return next('/dashboard')
}
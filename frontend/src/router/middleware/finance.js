import store from '../../store'

export default function finance({ next }) {
    let user = store.getters['auth/user']
    if (user.user_level_id == 103) {
        return next()
    }
    return next('/dashboard')
}
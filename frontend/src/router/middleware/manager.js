import store from '../../store'

export default function manager({ next }) {
    let user = store.getters['auth/user']
    if (user.user_level_id == 102) {
        return next()
    }
    return next('/dashboard')
}
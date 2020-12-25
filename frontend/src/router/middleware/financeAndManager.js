import store from '../../store'

export default function financeAndManager({ next }) {
    let user = store.getters['auth/user']
    if (user.user_level_id == 102 || user.user_level_id == 103) {
        return next()
    }
    return next('/dashboard')
}
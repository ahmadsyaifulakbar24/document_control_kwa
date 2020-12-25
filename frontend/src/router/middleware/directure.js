import store from '../../store'

export default function directure({ next }) {
    let user = store.getters['auth/user']
    if (user.user_level_id == 101) {
        return next()
    }
    return next('/dashboard')
}
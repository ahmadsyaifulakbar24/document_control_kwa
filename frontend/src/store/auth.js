import axios from 'axios'
export default {
    namespaced: true,
    state: {
        user: null,
        isLoggedIn: false
    },
    mutations: {
        set_user(state, data) {
            state.user = data
            state.isLoggedIn = true
        },

        reset_user(state) {
            state.user = null
            state.isLoggedIn = false
        }
    },

    actions: {
        login({commit }, data) {
            return new Promise((resolve, reject) => {
                axios.post('auth/login', data).then((response) => {
                    let data = response.data
                    const api_token = data.api_token
                    localStorage.setItem('api_token', api_token)
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + api_token
                    commit('set_user', data.data)
                    resolve(response)
                }).catch((err) => {
                    commit('reset_user')
                    localStorage.removeItem('api_token')
                    reject(err)
                })
            }) 
        },

        async get_user({ commit }) {
            if (!localStorage.getItem('api_token')) {
                return
            }
            try {
                let response = await axios.get('user/get_user')
                commit('set_user', response.data.data)
            } catch(error) {
                commit('reset_user')
                axios.defaults.headers.common['Authorization']
                localStorage.removeItem('api_token')
                return error
            }
        },
        
        logout({ commit }) {
            return new Promise((resolve, reject) => {
                axios.post('auth/logout').then(() => {
                    commit('reset_user')
                    localStorage.removeItem('api_token')
                    axios.defaults.headers.common['Authorization']
                    resolve()
                }).catch((err) => {
                    reject(err)
                })
            })
        }
    },
    
    getters: {
        isLoggedIn(state) {
            return state.isLoggedIn
        },

        user(state) {
            return state.user
        }
    }
}
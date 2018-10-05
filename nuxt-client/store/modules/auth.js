import axios from './../../plugins/axios'
const Cookie = require('js-cookie')

export default {
    namespaced: true,
    state: {
        token: null,
        name: null,
        email: null
    },

    mutations: {
        SET_USER(state, user) {
            state.name = user.name
            state.email = user.email
        },
        SET_TOKEN(state, token) {
            state.token = token
        }
    },
    actions: {
        async login({ commit, state }, params) {
            try {
                await axios
                    .post('api/login', {
                        name: state.name,
                        email: state.email
                    })
                    .then(response => {
                        //console.log(response.data.data.token)
                        commit('SET_TOKEN', response.data.data.token)
                        Cookie.set('token_cookie', response.data.data.token)
                        this.$router.push({ path: '/secret' })
                    })
                //console.log(data)
                //commit('SET_USER', data)
            } catch (error) {
                if (error.response && error.response.status === 401) {
                    throw new Error('Bad credentials')
                }
                throw error
                commit('SET_USER', null)
                commit('SET_TOKEN', null)
            }
        },
        async logout({ commit }) {
            await axios.post('/api/logout')
            commit('SET_USER', null)
            commit('SET_TOKEN', null)
        },
        async accessToken({ commit, state }) {
            try {
                await axios
                    .get('api/user-info', {
                        headers: {
                            Authorization: `Bearer ${Cookie.get(
                                'token_cookie'
                            )}`
                        }
                    })
                    .then(response => {
                        //console.log(response)
                        commit('SET_USER', response.data.result)
                        commit('SET_TOKEN', Cookie.get('token_cookie'))
                    })
            } catch (error) {
                if (error.response && error.response.status === 401) {
                    throw new Error('Bad credentials')
                }
                throw error
                commit('SET_USER', null)
                commit('SET_TOKEN', null)
            }
        }
    }
}

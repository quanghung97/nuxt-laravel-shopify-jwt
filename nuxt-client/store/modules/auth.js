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
            //console.log(params)
            commit('SET_USER', params)
            await axios
                .post('/api/login', {
                    name: params.name,
                    email: params.email
                })
                .then(response => {
                    // console.log(response.data.data.token)
                    commit('SET_TOKEN', response.data.data.token)
                    //Cookie.set('token_cookie', response.data.data.token)
                    //this.$router.push({ path: '/secret' })
                })
                .catch(error => {
                    console.log(error)
                })
        },
        async logout({ commit }) {
            await axios.post('/api/logout')
            commit('SET_USER', '')
            commit('SET_TOKEN', '')
        },
        async accessToken({ commit, state }) {
            await axios
                .get('api/user-info', {
                    headers: {
                        Authorization: `Bearer ${Cookie.get('token_cookie')}`
                    }
                })
                .then(response => {
                    console.log(response)
                    commit('SET_USER', response.data.result)
                    commit('SET_TOKEN', Cookie.get('token_cookie'))
                })
                .catch(error => {
                    commit('SET_USER', '')
                    commit('SET_TOKEN', '')
                })
        }
    }
}

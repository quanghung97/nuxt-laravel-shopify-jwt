import axios from './../../plugins/axios'

export default {
    namespaced: true,
    state: {
        status: null
    },
    mutations: {
        SET_JSON(state, status) {
            state.status = status
        }
    },
    actions: {
        async addJsonLd({ commit, state, rootState }) {
            //console.log(rootState.auth.token)
            await axios
                .get('api/themes', {
                    headers: {
                        Authorization: `Bearer ${rootState.auth.token}`
                    }
                })
                .then(response => {
                    if (response.data.result == 'successfully') {
                        commit('SET_JSON', response.data.result)
                        this.$router.push({ path: '/' })
                    }
                })
        }
    }
}

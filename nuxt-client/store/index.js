import Vuex from 'vuex'
import Vue from 'vue'
//import _ from 'lodash'
import auth from './modules/auth'
import axios from 'axios'
const cookieparser = process.server ? require('cookieparser') : undefined

Vue.use(Vuex)

const createStore = () => {
    return new Vuex.Store({
        modules: {
            auth
        },
        actions: {
            async nuxtServerInit({ dispatch, commit }, { req }) {
                await dispatch('auth/accessToken')
                if (req.headers.cookie) {
                    const parsed = cookieparser.parse(req.headers.cookie)
                    try {
                        //console.log(parsed.token_cookie)
                        commit('auth/SET_TOKEN', parsed.token_cookie)
                    } catch (err) {
                        // No valid cookie found
                    }
                }
            }
        }
    })
}

export default createStore

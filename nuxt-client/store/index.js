import Vuex from 'vuex'
import Vue from 'vue'
//import _ from 'lodash'
import auth from './modules/auth'
import addJson from './modules/addJson'
import axios from 'axios'
const cookieparser = process.server ? require('cookieparser') : undefined
const Cookie = require('js-cookie')

Vue.use(Vuex)

const createStore = () => {
    return new Vuex.Store({
        modules: {
            auth,
            addJson
        },
        actions: {
            async nuxtServerInit({ dispatch, commit }, { req }) {
                if (req.headers.cookie) {
                    const parsed = cookieparser.parse(req.headers.cookie)
                    try {
                        //console.log(parsed.token_cookie)
                        await dispatch('auth/login', parsed)
                        //commit('auth/SET_TOKEN', parsed.token_cookie)
                        //commit('auth/SET_USER', parsed)
                    } catch (err) {
                        // No valid cookie found
                    }
                } else {
                    commit('auth/SET_TOKEN', null)
                    commit('auth/SET_USER', '')
                }
            }
        }
    })
}

export default createStore

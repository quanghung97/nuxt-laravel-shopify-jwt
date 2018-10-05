import axios from 'axios'
import store from './../store/index'

let instance = axios.create()

axios.defaults.baseURL = 'https://testapp.test/'

export default instance

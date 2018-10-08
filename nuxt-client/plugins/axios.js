import axios from 'axios'
import https from 'https'
// import store from './../store/index'
//

// //instance.get('https://testapp.test/')
//
let instance = axios.create({
    baseURL: 'https://testapp.test/',
    httpsAgent: new https.Agent({ rejectUnauthorized: false })
})
// instance.defaults.
// instance.defaults.httpsAgent = new https.Agent({ rejectUnauthorized: false })
// instance.defaults.headers.post['Content-Type'] =
//     'application/x-www-form-urlencoded'

export default instance

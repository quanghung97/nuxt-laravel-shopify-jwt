const Cookie = require('js-cookie')

export default function({ store, redirect, error }) {
    // If the user is not authenticated
    //let token = Cookie.get('token_cookie')
    //store.commit('auth/SET_TOKEN', token)
    if (store.state.auth.token == null || store.state.auth.token == '') {
        return error({ statusCode: 404, message: 'You need login to use this App' })
    }
}

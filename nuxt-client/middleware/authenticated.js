const Cookie = require('js-cookie')

export default function({ store, redirect }) {
    // If the user is not authenticated
    //let token = Cookie.get('token_cookie')
    //store.commit('auth/SET_TOKEN', token)
    if (store.state.auth.token == '') {
        return redirect('/login')
    }
}

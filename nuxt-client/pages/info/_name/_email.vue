<template>
    <div>
        <h1></h1>
    </div>
</template>

<script>
import { mapActions } from 'vuex'
const Cookie = require('js-cookie')

export default {
    //middleware: 'notAuthenticated',
    async fetch({ store, params }) {
        //store.commit('auth/SET_USER', params)
        await store.dispatch('auth/login', params)
        //redirect('localhost:3000/secret')
    },
    mounted() {
        this.$nextTick(() => {
            this.$nuxt.$loading.start()
            setTimeout(() => this.$nuxt.$loading.finish(), 1000)
        })
        //console.log(this.$store.state.auth.token)
        if (this.$store.state.auth.token != null || this.$store.state.auth.token != '') {
            Cookie.set('token_cookie', this.$store.state.auth.token)
            Cookie.set('name', this.$store.state.auth.name)
            Cookie.set('email', this.$store.state.auth.email)
        } else {
            Cookies.remove('token_cookie')
            Cookies.remove('name')
            Cookies.remove('email')
        }
        this.$router.push({ path: '/secret' })
    }
}
</script>

<style scoped="">
</style>

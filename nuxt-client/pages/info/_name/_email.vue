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
    async fetch({ store, params, redirect }) {
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
        Cookie.set('token_cookie', this.$store.state.auth.token)
        this.$router.push({ path: '/secret' })
    }
}
</script>

<style scoped="">
</style>

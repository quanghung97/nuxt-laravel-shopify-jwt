<template>
    <div>
        <h1></h1>
    </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
    middleware: 'notAuthenticated',
    async fetch({ store, params }) {
        await store.commit('auth/SET_USER', params)
        store.dispatch('auth/login', params)
    }
}
</script>

<style scoped="">
</style>

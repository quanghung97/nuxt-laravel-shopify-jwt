<template>
    <div>
        <no-ssr>
        <TopHeader
                v-if="token !== null"
                app-name="Add JSON-LD"
                :user-name="email"
                :shop-name="name">
            <template slot="actions">
                <TopHeaderQuickStart
                        :show="true"
                        :step="1"
                        :steps="2"
                        title="Publish to shop" class="ml-auto">
                    <div class="form-group">
                        Let's publish change to your store.
                    </div>
                    <div class="form-group text-right mb-1">
                        <Button class="btn-info ml-2 ml-sm-3 mr-auto">Publish</Button>
                    </div>
                </TopHeaderQuickStart>
            </template>
        </TopHeader>
        <div v-if="token !== null" class="container-fluid">
          <div class="row">
            <SideBar :items="items"/>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-0 px-md-4 pt-5 mt-5">
                <nuxt />
            </main>
          </div>
        </div>
        <nuxt v-if="token === null"/>
        </no-ssr>
    </div>
</template>
<script>
import { mapActions } from 'vuex'
//import Logo from '~/components/Logo.vue'
import TopHeader from './../node_modules/polaris-vue/src/components/TopHeader'
import SideBar from './../node_modules/polaris-vue/src/components/sidebar/SideBar'
import TopHeaderQuickStart from './../node_modules/polaris-vue/src/components/TopHeaderQuickStart'
import Button from './../node_modules/polaris-vue/src/components/polaris/Button'
import nav from '../nav'
import { mapState } from 'vuex'

export default {
    components: {
        TopHeader,
        SideBar,
        TopHeaderQuickStart,
        Button
    },
    data() {
        return {
            items: nav.items
        }
    },
    mounted() {
        this.$nextTick(() => {
            this.$nuxt.$loading.start()

            setTimeout(() => this.$nuxt.$loading.finish(), 1000)
        })
    },
    computed: {
        ...mapState('auth', {
            token: state => state.token,
            name: state => state.name,
            email: state => state.email
        })
    }
}
</script>

<style>
</style>

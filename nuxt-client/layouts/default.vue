<template>
    <div>
        <no-ssr>
        <TopHeader
                app-name="JSON-LD"
                user-name="Thierry Nguyen"
                shop-name="shop-dev">
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
        <div class="container-fluid">
          <div class="row">
            <SideBar :items="items"/>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-0 px-md-4 pt-5 mt-2">
                <nuxt />
            </main>
          </div>
        </div>
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
    }
}
</script>

<style>
html {
    font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont,
        'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    font-size: 16px;
    word-spacing: 1px;
    -ms-text-size-adjust: 100%;
    -webkit-text-size-adjust: 100%;
    -moz-osx-font-smoothing: grayscale;
    -webkit-font-smoothing: antialiased;
    box-sizing: border-box;
}

*,
*:before,
*:after {
    box-sizing: border-box;
    margin: 0;
}

.button--green {
    display: inline-block;
    border-radius: 4px;
    border: 1px solid #3b8070;
    color: #3b8070;
    text-decoration: none;
    padding: 10px 30px;
}

.button--green:hover {
    color: #fff;
    background-color: #3b8070;
}

.button--grey {
    display: inline-block;
    border-radius: 4px;
    border: 1px solid #35495e;
    color: #35495e;
    text-decoration: none;
    padding: 10px 30px;
    margin-left: 15px;
}

.button--grey:hover {
    color: #fff;
    background-color: #35495e;
}
</style>

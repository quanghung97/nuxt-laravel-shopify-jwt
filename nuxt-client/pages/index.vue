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
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-0 px-md-4">
              <router-view></router-view>
            </main>
          </div>
        </div>
        </no-ssr>
    </div>
</template>

<script>
//import Logo from '~/components/Logo.vue'
import TopHeader from './../node_modules/polaris-vue/src/components/TopHeader'
import SideBar from './../node_modules/polaris-vue/src/components/sidebar/SideBar'
import TopHeaderQuickStart from './../node_modules/polaris-vue/src/components/TopHeaderQuickStart'
import Button from './../node_modules/polaris-vue/src/components/polaris/Button'
import nav from './../node_modules/polaris-vue/src/nav'

export default {
    components: {
        TopHeader,
        SideBar,
        TopHeaderQuickStart,
        Button,
        nav
    },
    data() {
        return {
            items: nav.items
        }
    }
}
</script>

<style>
.container {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
}

.title {
    font-family: 'Quicksand', 'Source Sans Pro', -apple-system,
        BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial,
        sans-serif;
    display: block;
    font-weight: 300;
    font-size: 100px;
    color: #35495e;
    letter-spacing: 1px;
}

.subtitle {
    font-weight: 300;
    font-size: 42px;
    color: #526488;
    word-spacing: 5px;
    padding-bottom: 15px;
}

.links {
    padding-top: 15px;
}
</style>

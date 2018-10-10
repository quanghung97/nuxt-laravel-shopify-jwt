<template>
    <b-card title="Card Title"
         img-src="https://picsum.photos/600/300/?image=25"
         img-alt="Image"
         img-top
         tag="article"
         style="max-width: 20rem;"
         class="mb-2">
   <p class="card-text">
     Some quick example text to build on the card title and make up the bulk of the card's content.
   </p>
   <b-button @click="addJsonLd" variant="primary">Add JSON-LD</b-button>
 </b-card>
</template>
<script>
import { mapActions } from 'vuex'

export default {
    middleware: 'authenticated',
    methods: {
        ...mapActions({
            addJsonLd: 'addJson/addJsonLd'
        })
    }
}
</script>

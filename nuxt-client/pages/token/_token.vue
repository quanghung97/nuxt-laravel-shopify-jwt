<template>
    <div>
        <h1>{{ title }}</h1>
    </div>
</template>

<script>
export default {
    asyncData({ params }) {
        console.log(params.token)
    }
}
</script>

<style scoped="">
</style>

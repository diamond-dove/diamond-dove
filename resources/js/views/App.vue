<template>
        <router-view></router-view>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        name: "App",
        computed: {
            ...mapGetters([
                'isLogged'
            ])
        }
    }
</script>

<style scoped>

</style>

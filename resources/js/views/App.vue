<template>
    <div >
        <button v-if="isLogged" @click="logout" >
            Logout
        </button>
        <router-view></router-view>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        name: "App",
        computed: {
            ...mapGetters([
                'isLogged'
            ])
        },
        methods: {
            logout () {
                this.$store.dispatch('logout')
            }
        }
    }
</script>

<style scoped>

</style>

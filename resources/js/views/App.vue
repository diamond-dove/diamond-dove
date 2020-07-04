<template>
    <div>
        <h1>Prestame hello world</h1>

        <p>
            <router-link :to="{ name: 'home' }">Home</router-link>
        </p>

        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        name: "App"
    }
</script>

<style scoped>

</style>

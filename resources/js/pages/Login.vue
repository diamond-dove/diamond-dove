<template>
    <div class="content">
        <div class="md-layout md-alignment-center-center">
            <div class="md-layout-item md-medium-size-100 md-size-50">
                <login-form id="login-form" data-background-color="green" ></login-form>
            </div>
        </div>
    </div>
</template>

<script>
    import LoginForm from "../components/LoginForm";

    export default {
        name: "Login",
        components: {
            LoginForm
        }
    }
</script>

<style scoped>
    #login-form {
        margin-top: 100px;
    }
</style>

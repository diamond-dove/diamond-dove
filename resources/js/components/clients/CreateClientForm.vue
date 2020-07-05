<template>
    <form>
        <md-card>
            <md-card-header data-background-color="green">
                <h4 class="title">Nuevo Cliente</h4>
                <p class="category">Complete el formulario para registrar cliente</p>
            </md-card-header>

            <md-card-content>
                <div class="md-layout">
                    <div class="md-layout-item md-small-size-100 md-size-100">
                        <div class="alert alert-danger" v-if="error" >
                            <button type="button" aria-hidden="true" class="close">
                                ×
                            </button>
                            <span
                            ><b> Error - </b> Su login fue invalido, verifique su usuario y contraseña</span
                            >
                        </div>
                    </div>
                    <div class="md-layout-item md-small-size-100 md-size-100">
                        <md-field>
                            <label>Email</label>
                            <md-input v-model="email" type="text"></md-input>
                        </md-field>
                    </div>
                    <div class="md-layout-item md-small-size-100 md-size-100">
                        <md-field>
                            <label>Password</label>
                            <md-input v-model="password" type="password"></md-input>
                        </md-field>
                    </div>
                    <div class="md-layout-item md-size-100 text-right">
                        <md-button @click="login" class="md-raised md-success">Login</md-button>
                    </div>
                </div>
            </md-card-content>
        </md-card>
    </form>
</template>

<script>
    export default {
        name: "CreateClientForm"
    }
</script>

<style scoped>

</style>

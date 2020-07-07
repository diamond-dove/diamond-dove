<template>
    <form>
        <md-card>
            <md-card-header data-background-color="green">
                <h4 class="title">Actualizar Cliente</h4>
                <p class="category">Complete el formulario para actualizar cliente</p>
            </md-card-header>

            <md-card-content>
                <div class="md-layout" v-if="loading">
                    Loading ...
                </div>
                <div class="md-layout" v-if="!loading">
                    <div class="md-layout-item md-small-size-100 md-size-50">
                        <md-field :class="[ errors.first_name ? 'md-invalid' : '']" >
                            <label>Nombre</label>
                            <md-input v-model="client.first_name" type="text" required></md-input>
                        </md-field>
                    </div>
                    <div class="md-layout-item md-small-size-100 md-size-50">
                        <md-field :class="[ errors.last_name ? 'md-invalid' : '']">
                            <label>Apellido</label>
                            <md-input v-model="client.last_name" type="text"></md-input>
                        </md-field>
                    </div>
                    <div class="md-layout-item md-small-size-100 md-size-100">
                        <md-field :class="[ errors.address ? 'md-invalid' : '']">
                            <label>Direcci&oacute;n</label>
                            <md-input v-model="client.address" type="text"></md-input>
                        </md-field>
                    </div>
                    <div class="md-layout-item md-small-size-100 md-size-33">
                        <md-field :class="[ errors.identifier ? 'md-invalid' : '']">
                            <label>Ced&uacute;la</label>
                            <md-input v-model="client.identifier" v-mask="'###-#######-#'" type="text"></md-input>
                        </md-field>
                    </div>
                    <div class="md-layout-item md-small-size-100 md-size-33">
                        <md-field :class="[ errors.cell_phone ? 'md-invalid' : '']">
                            <label>Celular</label>
                            <md-input v-model="client.cell_phone" v-mask="'(###)###-####'" type="text"></md-input>
                        </md-field>
                    </div>
                    <div class="md-layout-item md-small-size-100 md-size-33">
                        <md-field>
                            <label>Telefono</label>
                            <md-input v-model="client.phone" v-mask="'(###)###-####'" type="text"></md-input>
                        </md-field>
                    </div>
                    <div class="md-layout-item md-small-size-100 md-size-100">
                        <md-field>
                            <label>Nota</label>
                            <md-textarea v-model="client.note" type="text-area"></md-textarea>
                        </md-field>
                    </div>
                    <div class="md-layout-item md-size-100 text-right">
                        <md-button @click="save" class="md-raised md-success">ACTUALIZAR CLIENTE</md-button>
                    </div>
                </div>
                <md-dialog :md-active.sync="showDialog">
                    <md-dialog-title>Cliente Guardado Correctamente</md-dialog-title>
                    <hr />
                    <md-dialog-actions class="justify-content-center">
                        <md-button class="md-raised md-success" @click="redirectToClients">Ver clientes</md-button>
                    </md-dialog-actions>
                </md-dialog>
            </md-card-content>
        </md-card>
    </form>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'

    export default {
        name: "EditClientForm",
        data() {
            return {
                errors: {},
                showDialog: false
            };
        },
        computed: {
            ...mapGetters({
                client: 'client/client',
                loaded: 'client/loaded'
            }),
            loading() {
                return !this.loaded;
            }
        },
        methods: {
            ...mapActions({
                updateClient: 'client/updateClient',
                getClient: 'client/getClient'
            }),

            async save() {
                try {
                    await this.updateClient(this.client);
                    this.showDialog = true;
                    setTimeout(this.redirectToClients, 5000);
                } catch (error) {
                    this.errors = error.response.data.errors;
                }
            },

            redirectToClients() {
                this.showDialog = false;
                this.$router.push({ name: 'Lista De Clientes' });
            }

        },

        created() {
            this.getClient(this.$route.params.client);
        }
    }
</script>

<style scoped>
    .md-dialog-actions {
        justify-content: center !important;
    }
</style>

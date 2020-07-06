<template>
    <form>
        <md-card>
            <md-card-header data-background-color="green">
                <h4 class="title">Nuevo Cliente</h4>
                <p class="category">Complete el formulario para registrar cliente</p>
            </md-card-header>

            <md-card-content>
                <div class="md-layout">
                    <div class="md-layout-item md-small-size-100 md-size-50">
                        <md-field :class="[ errors.first_name ? 'md-invalid' : '']" >
                            <label>Nombre</label>
                            <md-input v-model="first_name" type="text" required></md-input>
                        </md-field>
                    </div>
                    <div class="md-layout-item md-small-size-100 md-size-50">
                        <md-field :class="[ errors.last_name ? 'md-invalid' : '']">
                            <label>Apellido</label>
                            <md-input v-model="last_name" type="text"></md-input>
                        </md-field>
                    </div>
                    <div class="md-layout-item md-small-size-100 md-size-100">
                        <md-field :class="[ errors.address ? 'md-invalid' : '']">
                            <label>Direcci&oacute;n</label>
                            <md-input v-model="address" type="text"></md-input>
                        </md-field>
                    </div>
                    <div class="md-layout-item md-small-size-100 md-size-33">
                        <md-field :class="[ errors.identifier ? 'md-invalid' : '']">
                            <label>Ced&uacute;la</label>
                            <md-input v-model="identifier" v-mask="'###-#######-#'" type="text"></md-input>
                        </md-field>
                    </div>
                    <div class="md-layout-item md-small-size-100 md-size-33">
                        <md-field :class="[ errors.cell_phone ? 'md-invalid' : '']">
                            <label>Celular</label>
                            <md-input v-model="cell_phone" v-mask="'(###)###-####'" type="text"></md-input>
                        </md-field>
                    </div>
                    <div class="md-layout-item md-small-size-100 md-size-33">
                        <md-field>
                            <label>Telefono</label>
                            <md-input v-model="phone" v-mask="'(###)###-####'" type="text"></md-input>
                        </md-field>
                    </div>
                    <div class="md-layout-item md-small-size-100 md-size-100">
                        <md-field>
                            <label>Nota</label>
                            <md-textarea v-model="note" type="text-area"></md-textarea>
                        </md-field>
                    </div>
                    <div class="md-layout-item md-size-100 text-right">
                        <md-button @click="save" class="md-raised md-success">GUARDAR CLIENTE</md-button>
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
    import { mapActions } from 'vuex'

    export default {
        name: "CreateClientForm",
        data() {
            return {
                first_name: null,
                last_name: null,
                address: null,
                identifier: null,
                cell_phone: null,
                phone: null,
                note: null,
                errors: {},
                showDialog: false
            };
        },
        methods: {
            ...mapActions({
                saveClient: 'client/saveClient'
            }),

            async save() {
                try {
                    await this.saveClient({
                        first_name: this.first_name,
                        last_name: this.last_name,
                        address: this.address,
                        identifier: this.identifier,
                        cell_phone: this.cell_phone,
                        phone: this.phone,
                        note: this.note
                    });
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

        }
    }
</script>

<style scoped>
    .md-dialog-actions {
        justify-content: center !important;
    }
</style>

<template>
    <form>
        <md-card>
            <md-card-header data-background-color="green">
                <h4 class="title">Buscar Cliente</h4>
                <p class="category">Seleccione el cliente para el prestamo</p>
            </md-card-header>

            <md-card-content>
                <div class="md-layout">
                    <div class="md-layout-item md-size-30">
                        <md-autocomplete
                                v-model="value"
                                :md-options="clients"
                                @md-selected="onSelectClient"
                                @md-changed="getClients"
                                @md-opened="getClients"
                        >
                            <label>Buscar cliente por nombre o cedula</label>

                            <template slot="md-autocomplete-item" slot-scope="{ item }">{{ item.name }}</template>
                        </md-autocomplete>
                    </div>
                </div>
                <div class="md-layout" v-if="client" >
                    <div
                            class="md-layout-item md-size-30"
                    >
                        <p><strong>Nombre: </strong>{{ client.name }}</p>
                    </div>
                    <div
                            class="md-layout-item md-size-70"
                    >
                        <p><strong>Direccion: </strong>{{ client.address }}</p>
                    </div>
                    <div
                            class="md-layout-item md-size-30"
                    >
                        <p><strong>Cedula: </strong>{{ client.identifier }}</p>
                    </div>
                    <div
                            class="md-layout-item md-size-70"
                    >
                        <p><strong>Celular: </strong>{{ client.cell_phone }}</p>
                    </div>
                </div>
            </md-card-content>
        </md-card>
        <md-card>
            <md-card-header data-background-color="green">
                <h4 class="title">Nuevo Prestamo</h4>
                <p class="category">Completa la informacion de abajo para registrar prestamo</p>
            </md-card-header>

            <md-card-content>
                <div class="md-layout">
                    <div
                            class="md-layout-item md-size-100"
                    >
                        <strong>Detalles de prestamo: </strong>
                    </div>
                    <div
                            class="md-layout-item md-size-20"
                    >
                        <md-field :class="[ errors.amount ? 'md-invalid' : '']" >
                            <label>Monto</label>
                            <md-input v-model="loan.amount" type="text" required></md-input>
                        </md-field>
                    </div>
                    <div
                            class="md-layout-item md-size-20"
                    >
                        <md-field :class="[ errors.rate ? 'md-invalid' : '']" >
                            <label>Interest%</label>
                            <md-input v-model="loan.rate" type="text" required></md-input>
                        </md-field>
                    </div>
                    <div
                            class="md-layout-item md-size-30"
                    >
                        <md-field :class="[ errors.frequency ? 'md-invalid' : '']">
                            <label for="frequency">Tipo de pago</label>
                            <md-select v-model="loan.frequency" name="frequency" id="frequency">
                                <md-option value="daily">Diario</md-option>
                                <md-option value="weekly">Semanal</md-option>
                                <md-option value="biweekly">Quincenal</md-option>
                                <md-option value="monthly">Mensual</md-option>
                            </md-select>
                        </md-field>
                    </div>
                    <div
                            class="md-layout-item md-size-20"
                    >
                        <md-field :class="[ errors.time ? 'md-invalid' : '']" >
                            <label>Tiempo</label>
                            <md-input v-model="loan.time" type="text" required></md-input>
                        </md-field>
                    </div>
                    <div class="md-layout-item md-size-100 text-right">
                        <md-button @click="save" class="md-raised md-success">GUARDAR</md-button>
                    </div>
                </div>
            </md-card-content>
        </md-card>
    </form>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'

    export default {
        name: "CreateLoanForm",
        data () {
            return {
                value: "",
                client: {},
                clients: [],
                errors: {},
                loan: {
                },
                showDialog: false
            };
        },
        computed: {
            ...mapGetters({
                clientList: 'client/clients'
            })
        },
        methods: {
            ...mapActions({
                saveClient: 'client/saveClient'
            }),

            async save () {
                try {

                    this.showDialog = true;
                    //setTimeout(this.redirectToClients, 5000);
                } catch (error) {
                    this.errors = error.response.data.errors;
                }
            },

            createClient () {
                this.$router.push({ name: 'Nuevo Cliente' });
            },

            redirectToClients () {
                this.showDialog = false;
                this.$router.push({ name: 'Prestamos' });
            },

            getClients (searchTerm) {
                if (!searchTerm) {
                    this.client = {};
                } else {
                    this.$store.dispatch('client/updateSeach', searchTerm);
                    this.loadClients(searchTerm);
                }
            },

            onSelectClient(client) {
                this.value = client.name;
                this.client = client;
            },

            loadClients (searchTerm) {
                this.clients = new Promise(resolve => {
                    window.setTimeout(async () => {
                        if (!searchTerm) {
                            resolve([])
                        } else {

                            resolve(await this.$store.dispatch('client/getClients'))
                        }
                    }, 500)
                });
            }

        }
    }
</script>

<style lang="scss" scoped>
    .md-autocomplete + strong {
        margin-top: 36px;
        display: block;
    }
</style>

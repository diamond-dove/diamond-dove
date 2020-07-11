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
                        <span class="md-error text-danger" v-if="errors.client_id" >Debe seleccionar un cliente</span>
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
                        <md-field :class="[ errors.fee ? 'md-invalid' : '']" >
                            <label>Tiempo</label>
                            <md-input v-model="loan.fee" type="text" required></md-input>
                        </md-field>
                    </div>
                    <div class="md-layout-item md-size-100 text-right">
                        <md-button @click="save" class="md-raised md-success">GUARDAR</md-button>
                    </div>
                </div>
            </md-card-content>
        </md-card>
        <md-dialog :md-active.sync="showDialog" @md-closed="redirectToLoans" @md-clicked-outside="redirectToLoans" >
            <md-dialog-title>Prestamo Guardado Correctamente</md-dialog-title>
            <md-dialog-content>
                <div class="md-layout" >
                    <div
                            class="md-layout-item md-size-100"
                    >
                        <strong>Detalles de prestamo: </strong>
                    </div>
                    <div
                            class="md-layout-item md-size-100"
                    >
                        <p><strong>Cliente: </strong>{{ client.name }}</p>
                    </div>
                    <div
                            class="md-layout-item md-size-100"
                    >
                        <p><strong>Cedula: </strong>{{ client.identifier }}</p>
                        <span class="md-error text-danger" v-if="errors.client_id" >Debe seleccionar un cliente</span>
                    </div>
                    <div
                            class="md-layout-item md-size-70"
                    >
                        <p><strong>Celular: </strong>{{ client.cell_phone }}</p>
                    </div>
                </div>
                <div class="md-layout" >
                    <div
                            class="md-layout-item md-size-40"
                    >
                        <p><strong>Monto: </strong>RD${{ loan.amount }}</p>
                    </div>
                    <div
                            class="md-layout-item md-size-60"
                    >
                        <p><strong>Tipo de pago: </strong>{{ frequencyLabel.label }}</p>
                    </div>
                    <div
                            class="md-layout-item md-size-40"
                    >
                        <p><strong>Interes: </strong>{{ loan.rate }}%</p>
                    </div>
                    <div
                            class="md-layout-item md-size-60"
                    >
                        <p><strong>Tiempo: </strong>{{ loan.fee }} {{frequencyLabel.fee}}</p>
                    </div>
                </div>
            </md-dialog-content>
            <md-dialog-actions class="text-right">
                <md-button class="md-raised" @click="redirectToLoans">cerrar</md-button>
            </md-dialog-actions>
        </md-dialog>
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
                showDialog: false,
                requesting: false,
                frequencies: [
                    { value: 'daily', label: 'Diario', fee: 'Dias'},
                    { value: 'weekly', label: 'Semanal', fee: 'Semanas'},
                    { value: 'biweekly', label: 'Quicenal', fee: 'Quincenas'},
                    { value: 'monthly', label: 'Mensual', fee: 'Meses'}
                ]
            };
        },
        computed: {
            ...mapGetters({
                clientList: 'client/clients'
            }),
            frequencyLabel() {
                return this.frequencies.find(frequency => frequency.value === this.loan.frequency)  || {};
            }
        },
        methods: {
            ...mapActions({
                saveLoan: 'loan/saveLoan'
            }),

            async save () {
                try {
                    if (!this.requesting) {
                        this.requesting = true;
                        this.loan.client_id = this.client.id;
                        await this.saveLoan(this.loan);
                        this.showDialog = true;
                    }
                    //setTimeout(this.redirectToClients, 5000);
                } catch (error) {
                    this.errors = error.response.data.errors;
                }

                this.requesting = false;
            },

            createClient () {
                this.$router.push({ name: 'Nuevo Cliente' });
            },

            redirectToLoans () {
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

        },
        created() {
            this.loadClients("");
        }
    }
</script>

<style lang="scss" scoped>
    .md-autocomplete + strong {
        margin-top: 36px;
        display: block;
    }
</style>

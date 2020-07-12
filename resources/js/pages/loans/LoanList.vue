<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout list-content-header">
                <div
                        class="md-layout-item md-size-100"
                >
                    <b>Buscar por:</b>
                </div>
                <div
                        class="md-layout-item md-size-25"
                >
                    <md-field >
                        <label>Nombre</label>
                        <md-input v-model="searchName" type="text" ></md-input>
                    </md-field>
                </div>
                <div
                        class="md-layout-item md-size-25"
                >
                    <md-field >
                        <label>Cedula</label>
                        <md-input v-model="searchIdentifier" type="text" ></md-input>
                    </md-field>
                </div>
                <div
                        class="md-layout-item md-size-50 text-right"
                >
                    <md-button @click="addLoan" class="md-raised md-success"><md-icon>attach_money</md-icon> AGREGAR PRESTAMO</md-button>
                </div>
            </div>
            <div
                    class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100"
            >
                <md-card>
                    <md-card-header data-background-color="green">
                        <h4 class="title">Consulta de prestamos</h4>
                        <p class="category">Busque aqui los prestamos que desea consultar</p>
                    </md-card-header>
                    <md-card-content>
                        <loan-table table-header-color="green"></loan-table>
                    </md-card-content>
                </md-card>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    import LoanTable from '../../components/Tables/LoanTable';

    export default {
        name: "LoanList",
        components: {
            LoanTable
        },
        data() {
            return {
                awaitingSearch: false,
                name: "",
                identifier: ""
            }
        },
        computed: {
            searchName: {
                get: function () {
                    return this.name;
                },

                set: function (value) {
                    this.$store.dispatch('loan/updateSeach', value);
                    this.name = value;
                    if (!this.awaitingSearch) {
                        setTimeout(() => {
                            this.$store.dispatch('loan/getLoans');
                            this.awaitingSearch = false;
                        }, 1000);
                    }
                    this.awaitingSearch = true;
                }
            },
            searchIdentifier: {
                get: function () {
                    return this.identifier;
                },

                set: function (value) {
                    this.$store.dispatch('loan/updateSearchIdentifier', value);
                    this.identifier = value;
                    if (!this.awaitingSearch) {
                        setTimeout(() => {
                            this.$store.dispatch('loan/getLoans');
                            this.awaitingSearch = false;
                        }, 1000);
                    }
                    this.awaitingSearch = true;
                }
            },
            ...mapGetters({
                search: 'loan/search'
            })
        },
        methods: {
            addLoan() {
                this.$router.push({ name: 'Nuevo Prestamo' });
            }
        }
    }
</script>

<style scoped>

</style>

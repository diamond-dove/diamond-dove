<template>
    <div class="content">
        <div class="md-layout">
            <div class="md-layout list-content-header">
                <div
                        class="md-layout-item md-size-30"
                >
                    <md-field >
                        <label>Buscar</label>
                        <md-input v-model="searchModel" type="text" ></md-input>
                    </md-field>
                </div>
                <div
                        class="md-layout-item md-size-70 text-right"
                >
                    <md-button @click="addClient" class="md-raised md-success"><md-icon>person_add</md-icon> AGREGAR CLIENTE</md-button>
                </div>
            </div>
            <div
                    class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100"
            >
                <md-card>
                    <md-card-header data-background-color="green">
                        <h4 class="title">Listado De Clientes</h4>
                        <p class="category">Seleccione debajo del cliente que desea trabajar</p>
                    </md-card-header>
                    <md-card-content>
                        <client-table table-header-color="green"></client-table>
                    </md-card-content>
                </md-card>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    import ClientTable from '../../components/Tables/ClientTable';

    export default {
        name: "ClientList",
        components: {
            ClientTable
        },
        computed: {
            searchModel: {
                get: function () {
                    return this.search;
                },

                set: function (value) {
                    this.$store.dispatch('client/updateSeach', value);
                    this.$store.dispatch('client/getClients');
                }
            },
            ...mapGetters({
                search: 'client/search'
            })
        },
        methods: {
            addClient() {
                this.$router.push({ name: 'Nuevo Cliente' });
            }
        }
    }
</script>

<style scoped>
</style>

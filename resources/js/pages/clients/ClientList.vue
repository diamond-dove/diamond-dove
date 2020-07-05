<template>
    <div class="content">
        <div class="md-layout">
            <div
                    class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100"
            >
                <div class="md-layout-item md-size-100 text-right">
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
    import ClientTable from '../../components/Tables/ClientTable';

    export default {
        name: "ClientList",
        components: {
            ClientTable
        },
        methods: {
            addClient() {
                this.$router.push({ name: 'AddClient' });
            }
        }
    }
</script>

<style scoped>

</style>

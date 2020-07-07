<template>
  <div>
    <md-table v-model="clients" :table-header-color="tableHeaderColor">
      <md-table-row @click="editClient(item)" slot="md-table-row" slot-scope="{ item }">
        <md-table-cell md-label="Nombre">{{ item.name }}</md-table-cell>
        <md-table-cell md-label="Cedula">{{ item.identifier }}</md-table-cell>
        <md-table-cell md-label="Sector">{{ item.sector }}</md-table-cell>
        <md-table-cell md-label="Deuda">{{ item.debt }}</md-table-cell>
      </md-table-row>
    </md-table>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'

  export default {
    name: "simple-table",
    props: {
      tableHeaderColor: {
        type: String,
        default: ""
      }
    },
    data() {
      return {
        selected: []
      };
    },
    computed: {
      ...mapGetters({
        clients: 'client/clients'
      })
    },
    methods: {
      editClient(client) {
        this.$router.push('clients/edit/' + client.id);
      }
    },
    created() {
      this.$store.dispatch('client/getClients');
    }
  };
</script>

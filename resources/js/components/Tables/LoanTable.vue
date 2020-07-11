<template>
  <div>
    <md-table v-model="loans" :table-header-color="tableHeaderColor">
      <md-table-row @click="editLoan(item)" slot="md-table-row" slot-scope="{ item }">
        <md-table-cell md-label="Nombre">{{ item.name }}</md-table-cell>
        <md-table-cell md-label="Cedula">{{ item.identifier }}</md-table-cell>
        <md-table-cell md-label="Fecha">{{ item.created_at }}</md-table-cell>
        <md-table-cell md-label="Deuda">{{ item.amount }}</md-table-cell>
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
        loans: 'loan/loans'
      })
    },
    methods: {
      editLoan(loan) {
        this.$router.push('loans/edit/' + loan.id);
      }
    },
    created() {
      this.$store.dispatch('loan/getLoans');
    }
  };
</script>

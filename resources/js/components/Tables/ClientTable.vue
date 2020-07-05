<template>
  <div>
    <md-table v-model="clients" :table-header-color="tableHeaderColor">
      <md-table-row @click="editClient" slot="md-table-row" slot-scope="{ item }">
        <md-table-cell md-label="Nombre">{{ item.name }}</md-table-cell>
        <md-table-cell md-label="Cedula">{{ item.identifier }}</md-table-cell>
        <md-table-cell md-label="Sector">{{ item.sector }}</md-table-cell>
        <md-table-cell md-label="Deuda">{{ item.debt }}</md-table-cell>
      </md-table-row>
    </md-table>
  </div>
</template>

<script>
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
      selected: [],
      clients: [
        {
          name: "Dakota Rice",
          debt: "$36,738",
          sector: "Niger",
          identifier: "500-2123207-9"
        }
      ]
    };
  },
  methods: {
    editClient() {
      this.$router.push({ name: 'EditClient' });
    }
  }
};
</script>

<template>
  <v-container>
    <v-data-table
      :headers="headers"
      :items="orders"
      class="elevation-1"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Order</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
        </v-toolbar>
      </template>
      <template v-slot:item.total="{ item }">
        <v-text>{{item.total}}JD</v-text>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-icon @click="navigate(item.id)" small class="mr-2"> mdi-pencil </v-icon>
      </template>
      <template v-slot:no-data>
        <v-text>No Orders</v-text>
      </template>
    </v-data-table>
  </v-container>
</template>
<script>
export default {
  data: () => ({
    headers: [
      {
        text: "Order Id",
        align: "start",
        sortable: false,
        value: "id",
      },
      {
        text: "Total",
        align: "start",
        sortable: false,
        value: "total",
      },
      {
        text: "Time",
        align: "start",
        sortable: false,
        value: "time",
      },
      {
        text: "Status",
        align: "start",
        sortable: false,
        value: "status",
      },
      { text: "Actions", value: "actions", sortable: false },
    ],
    orders: [],
  }),

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
        let vm = this;
        axios.get('/admin/orders/index').then(res => {
            vm.orders = res.data;
        }).catch(err => {
            console.log(err)
        });
    },
    navigate(id) {
      this.$router.push('OrderShow/' + id)
    }
  },
};
</script>
<template>
  <q-page class="q-pa-md q-gutter-md bg-light-gray text-black">
    <q-card>
      <q-card-section>
        <div class="row items-center justify-between">
          <div class="text-h6">Customer List</div>
          <q-btn flat label="Add Customer" color="primary" @click="addCustomer" />
        </div>
        <q-input v-model="search" placeholder="Search by ID, Name, or Email" dense outlined class="q-mt-md" />
      </q-card-section>
      <q-separator />
      <q-card-section>
        <q-table
          :rows="filteredCustomers"
          :columns="columns"
          row-key="id"
          :rows-per-page-options="[5, 10, 20]"
          @row-click="onRowClick"
        >
          <template v-slot:body-cell-actions="props">
            <q-td :props="props">
              <q-btn flat icon="edit" @click="editCustomer(props.row.id)" color="primary" />
              <q-btn flat icon="delete" @click="deleteCustomer(props.row.id)" color="negative" />
            </q-td>
          </template>
          <template v-slot:no-data>
            <div class="text-center">No data available</div>
          </template>
        </q-table>
      </q-card-section>
    </q-card>
  </q-page>
</template>

<script>
import axios from 'axios';

export default {
  name: 'CustomerList',
  data() {
    return {
      customers: [],
      search: '',
      columns: [
        { name: 'id', label: 'ID', field: 'id', align: 'left' },
        { name: 'first_name', label: 'First Name', field: 'first_name', align: 'left' },
        { name: 'last_name', label: 'Last Name', field: 'last_name', align: 'left' },
        { name: 'email', label: 'Email', field: 'email', align: 'left' },
        { name: 'actions', label: 'Actions', field: 'actions', align: 'right' }
      ]
    }
  },
  computed: {
    filteredCustomers() {
      return this.customers.filter(customer => {
        return (
          customer.id.toString().includes(this.search) ||
          customer.first_name.toLowerCase().includes(this.search.toLowerCase()) ||
          customer.last_name.toLowerCase().includes(this.search.toLowerCase()) ||
          customer.email.toLowerCase().includes(this.search.toLowerCase())
        );
      });
    }
  },
  created() {
    this.fetchCustomers();
  },
  methods: {
    fetchCustomers() {
      axios.get('/api/customers')
        .then(response => {
          if (response.headers['content-type'].includes('application/json')) {
            this.customers = response.data;
          } else {
            console.warn('Unexpected response format:', response.data);
            this.customers = [];
          }
        })
        .catch(error => {
          console.error('Error fetching customers:', error.response ? error.response.data : error.message);
          this.customers = [];
        });
    },
    editCustomer(id) {
      this.$router.push(`/customers/${id}/edit`);
    },
    deleteCustomer(id) {
      axios.delete(`/api/customers/${id}`)
        .then(() => {
          this.fetchCustomers();
        })
        .catch(error => {
          console.error('Error deleting customer:', error);
        });
    },
    addCustomer() {
      this.$router.push('/customers/create');
    },
    onRowClick(evt, row) {
      this.$router.push(`/customers/${row.id}`);
    }
  }
}
</script>

<style scoped>
.q-btn--action {
  margin: 0 5px;
}

.material-icons {
  font-family: 'Material Icons';
  font-weight: normal;
  font-style: normal;
  font-size: 24px;  /* Preferred icon size */
  display: inline-block;
  line-height: 1;
  text-transform: none;
  letter-spacing: normal;
  word-wrap: normal;
  white-space: nowrap;
  direction: ltr;
  -webkit-font-smoothing: antialiased;
  text-rendering: optimizeLegibility;
  -moz-osx-font-smoothing: grayscale;
  font-feature-settings: 'liga';
}

.q-pagination .q-btn.dropdown-toggle::after {
  content: "\f107"; /* Unicode for the down arrow icon */
  font-family: "Font Awesome 5 Free"; /* Ensure you have Font Awesome included */
  font-weight: 900;
}
</style>
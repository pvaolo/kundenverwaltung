<template>
  <q-page class="q-pa-md q-gutter-md bg-light-gray text-black">
    <q-card>
      <q-card-section>
        <div class="text-h6">Customer List</div>
        <q-btn flat label="Add Customer" color="primary" @click="addCustomer" />
      </q-card-section>
      <q-separator />
      <q-card-section>
        <q-table
          :rows="paginatedCustomers"
          :columns="columns"
          row-key="id"
          :pagination.sync="pagination"
          :rows-per-page-options="[5, 10, 20, 50]"
          @row-click="onRowClick"
        >
          <template v-slot:body-cell-actions="props">
            <q-td :props="props">
              <q-btn flat icon="edit" @click="editCustomer(props.row.id)" color="primary" />
              <q-btn flat @click="deleteCustomer(props.row.id)" color="negative">
                <span class="material-icons">delete</span>
              </q-btn>
            </q-td>
          </template>
          <template v-slot:no-data>
            <div class="text-center">No data available</div>
          </template>
        </q-table>
        <q-pagination
          v-model="pagination.page"
          :max="pagesNumber"
          class="q-mt-md"
          boundary-numbers
          size="lg"
          color="primary"
        />
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
      columns: [
        { name: 'id', label: 'ID', field: 'id', align: 'left' },
        { name: 'first_name', label: 'First Name', field: 'first_name', align: 'left' },
        { name: 'last_name', label: 'Last Name', field: 'last_name', align: 'left' },
        { name: 'email', label: 'Email', field: 'email', align: 'left' },
        { name: 'actions', label: 'Actions', field: 'actions', align: 'right' }
      ],
      pagination: {
        page: 1,
        rowsPerPage: 10,
        rowsNumber: 0
      }
    }
  },
  computed: {
    pagesNumber() {
      return Math.ceil(this.pagination.rowsNumber / this.pagination.rowsPerPage);
    },
    paginatedCustomers() {
      const start = (this.pagination.page - 1) * this.pagination.rowsPerPage;
      const end = start + this.pagination.rowsPerPage;
      return this.customers.slice(start, end);
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
            this.pagination.rowsNumber = response.data.length;
          } else {
            console.warn('Unexpected response format:', response.data);
            this.customers = [];
            this.pagination.rowsNumber = 0;
          }
        })
        .catch(error => {
          console.error('Error fetching customers:', error.response ? error.response.data : error.message);
          this.customers = [];
          this.pagination.rowsNumber = 0;
        });
    },
    editCustomer(id) {
      this.$router.push(`/customers/${id}/edit`);
    },
    deleteCustomer(id) {
      axios.delete(`/api/customers/${id}`)  // Changed from /customers/ to /api/customers/
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
</style>
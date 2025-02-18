<template>
  <q-page class="q-pa-md q-gutter-md bg-soft-blue text-primary">
    <q-table :rows="customers" :columns="columns">
      <template v-slot:body-cell-name="props">
        <q-td :props="props">
          <q-btn flat @click="viewCustomer(props.row.id)">{{ props.row.name }}</q-btn>
        </q-td>
      </template>
    </q-table>
  </q-page>
</template>

<script>
import axios from 'axios';
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';

export default {
  name: 'CustomerTable',
  setup() {
    const customers = ref([]);
    const router = useRouter();

    const fetchCustomers = async () => {
      const response = await axios.get('/api/customers');
      customers.value = response.data;
    };

    const viewCustomer = (id) => {
      router.push(`/customers/${id}`);
    };

    onMounted(fetchCustomers);

    return { customers, viewCustomer };
  },
};
</script>

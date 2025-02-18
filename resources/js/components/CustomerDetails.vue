<template>
  <q-page class="q-pa-md q-gutter-md bg-light-gray text-black">
    <q-card>
      <q-card-section>
        <div class="text-h6">Customer Details</div>
      </q-card-section>
      <q-separator />
      <q-card-section>
        <div><strong>First Name:</strong> {{ customer.first_name }}</div>
        <div><strong>Last Name:</strong> {{ customer.last_name }}</div>
        <div><strong>Email:</strong> {{ customer.email }}</div>
        <div><strong>Phone:</strong> {{ customer.phone }}</div>
        <div><strong>Street:</strong> {{ customer.street }}</div>
        <div><strong>Postal Code:</strong> {{ customer.postal_code }}</div>
        <div><strong>City:</strong> {{ customer.city }}</div>
        <q-btn flat label="Back to List" color="primary" @click="goBack" />
      </q-card-section>
    </q-card>
  </q-page>
</template>

<script>
import axios from 'axios';
import { ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';

export default {
  name: 'CustomerDetails',
  setup() {
    const customer = ref({});
    const router = useRouter();
    const route = useRoute();

    const fetchCustomer = async () => {
      const response = await axios.get(`/api/customers/${route.params.id}`);
      customer.value = response.data;
    };

    const goBack = () => {
      router.push('/customers');
    };

    onMounted(fetchCustomer);

    return { customer, goBack };
  },
};
</script>

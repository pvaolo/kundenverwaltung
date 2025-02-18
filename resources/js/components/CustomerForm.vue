<template>
  <q-page class="q-pa-md q-gutter-md bg-light-gray text-black">
    <q-card>
      <q-card-section>
        <div class="text-h6">{{ route.params.id ? 'Edit Customer' : 'Create New Customer' }}</div>
      </q-card-section>
      <q-separator />
      <q-card-section>
        <q-form @submit.prevent="submitForm">
          <q-input v-model="customer.first_name" label="First Name" dense outlined />
          <q-input v-model="customer.last_name" label="Last Name" dense outlined />
          <q-input v-model="customer.email" label="Email" dense outlined />
          <q-input v-model="customer.phone" label="Phone" dense outlined />
          <q-input v-model="customer.street" label="Street" dense outlined />
          <q-input v-model="customer.postal_code" label="Postal Code" dense outlined />
          <q-input v-model="customer.city" label="City" dense outlined />
          <q-btn flat label="Save" color="primary" class="q-mt-md" type="submit" />
        </q-form>
      </q-card-section>
    </q-card>
  </q-page>
</template>

<script>
import axios from 'axios'
import { ref, onMounted, watch } from 'vue';
import { useRouter, useRoute } from 'vue-router';

export default {
  name: 'CustomerForm',
  setup() {
    const customer = ref({
      first_name: '',
      last_name: '',
      email: '',
      phone: '',
      street: '',
      postal_code: '',
      city: '',
    });

    const router = useRouter();
    const route = useRoute();

    const fetchCustomer = async () => {
      if (route.params.id) {
        const response = await axios.get(`/api/customers/${route.params.id}`);
        customer.value = response.data;
      }
    };

    const submitForm = async () => {
      try {
        if (route.params.id) {
          await axios.put(`/api/customers/${route.params.id}`, customer.value);
          router.push(`/customers/${route.params.id}`); // Redirect to the customer's details page
        } else {
          const response = await axios.post('/api/customers', customer.value);
          router.push(`/customers/${response.data.id}`); // Redirect to the new customer's details page
        }
      } catch (error) {
        console.error('Error submitting form:', error);
      }
    };

    onMounted(fetchCustomer);
    watch(route, fetchCustomer); // Watch for route changes and fetch customer data

    return { customer, submitForm, route };
  },
};
</script>

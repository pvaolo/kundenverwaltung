<template>
  <q-page class="q-pa-md bg-light-gray text-black">
    <q-card>
      <q-card-section>
        <div class="text-h6">Create Customer</div>
      </q-card-section>
      <q-separator />
      <q-card-section>
        <q-form @submit.prevent="createCustomer">
          <q-input v-model="customer.first_name" label="First Name" required />
          <q-input v-model="customer.last_name" label="Last Name" required />
          <q-input v-model="customer.email" label="Email" type="email" required />
          <q-input v-model="customer.phone" label="Phone" required />
          <q-input v-model="customer.street" label="Street" required />
          <q-input v-model="customer.postal_code" label="Postal Code" required />
          <q-input v-model="customer.city" label="City" required />
          <q-btn type="submit" label="Save" color="primary" />
          <q-btn flat label="Cancel" color="primary" @click="goBack" />
        </q-form>
      </q-card-section>
    </q-card>
  </q-page>
</template>

<script>
import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

export default {
  name: 'CustomerCreate',
  setup() {
    const customer = ref({
      first_name: '',
      last_name: '',
      email: '',
      phone: '',
      street: '',
      postal_code: '',
      city: ''
    });
    const router = useRouter();

    const createCustomer = async () => {
      try {
        await axios.post('/api/customers', customer.value);
        router.push('/customers');
      } catch (error) {
        console.error('Error creating customer:', error);
      }
    };

    const goBack = () => {
      router.push('/customers');
    };

    return {
      customer,
      createCustomer,
      goBack
    };
  }
};
</script>

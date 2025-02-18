<template>
  <q-page class="q-pa-md bg-soft-blue text-primary">
    <q-card>
      <q-card-section>
        <div class="text-h6">Kunde bearbeiten</div>
      </q-card-section>
      <q-separator />
      <q-card-section>
        <q-form @submit.prevent="updateCustomer">
          <div class="row q-col-gutter-md">
            <div class="col-12 col-md-6">
              <q-input v-model="customer.first_name" label="Vorname" required />
            </div>
            <div class="col-12 col-md-6">
              <q-input v-model="customer.last_name" label="Nachname" required />
            </div>
            <div class="col-12 col-md-6">
              <q-input v-model="customer.email" label="Email" type="email" required />
            </div>
            <div class="col-12 col-md-6">
              <q-input v-model="customer.phone" label="Telefon" required />
            </div>
            <div class="col-12 col-md-6">
              <q-input v-model="customer.street" label="Staße, Hausnummer" required />
            </div>
            <div class="col-12 col-md-6">
              <q-input v-model="customer.postal_code" label="PLZ" required />
            </div>
            <div class="col-12 col-md-6">
              <q-input v-model="customer.city" label="Ort" required />
            </div>
          </div>
          <div class="q-mt-md">
            <q-btn type="submit" label="Speichern" color="primary" />
            <q-btn flat label="Abbrechen" color="primary" @click="goBack" />
          </div>
        </q-form>
      </q-card-section>
    </q-card>
  </q-page>
</template>

<script>
import axios from 'axios';
import { ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';

export default {
  name: 'CustomerEdit',
  setup() {
    const customer = ref({});
    const router = useRouter();
    const route = useRoute();

    const fetchCustomer = async () => {
      try {
        const response = await axios.get(`/api/customers/${route.params.id}`);
        customer.value = response.data;
      } catch (error) {
        console.error('Error fetching customer:', error);
        router.push('/customers');
      }
    };

    const updateCustomer = async () => {
      try {
        await axios.put(`/api/customers/${route.params.id}`, customer.value);
        router.push(`/customers/${route.params.id}`);
      } catch (error) {
        console.error('Error updating customer:', error);
      }
    };

    const goBack = () => {
      router.push('/customers');
    };

    onMounted(fetchCustomer);

    return {
      customer,
      updateCustomer,
      goBack
    };
  }
};
</script>

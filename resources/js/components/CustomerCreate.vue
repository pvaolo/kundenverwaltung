<template>
  <q-page class="q-pa-md bg-soft-blue text-primary">
    <q-card>
      <q-card-section>
        <div class="text-h6">Neuen Kunden erstellen</div>
      </q-card-section>
      <q-separator />
      <q-card-section>
        <q-form @submit.prevent="createCustomer">
          <div class="row q-col-gutter-md">
            <div class="col-12 col-md-6">
              <q-input v-model="customer.first_name" label="Vorname" dense required />
            </div>
            <div class="col-12 col-md-6">
              <q-input v-model="customer.last_name" label="Nachname" dense required />
            </div>
            <div class="col-12 col-md-6">
              <q-input v-model="customer.email" label="Email" type="email" dense required />
            </div>
            <div class="col-12 col-md-6">
              <q-input v-model="customer.phone" label="Telefon" dense required />
            </div>
            <div class="col-12 col-md-6">
              <q-input v-model="customer.street" label="Straße, Hausnummer" dense required />
            </div>
            <div class="col-12 col-md-6">
              <q-input v-model="customer.postal_code" label="PLZ" dense required />
            </div>
            <div class="col-12 col-md-6">
              <q-input v-model="customer.city" label="Stadt" dense required />
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

<template>
  <q-page class="q-pa-md q-gutter-md bg-soft-blue">
    <q-card>
      <q-card-section>
        <div class="row items-center justify-between">
          <div class="text-h6">Customer Details</div>
          <div class="q-gutter-sm">
            <q-btn flat icon="edit" color="primary" @click="editCustomer" class="q-mr-sm" />
            <q-btn flat icon="delete" color="negative" @click="confirmDelete" />
          </div>
        </div>
      </q-card-section>
      <q-separator />
      <q-card-section>
        <div class="row q-col-gutter-md">
          <div class="col-12 col-md-6">
            <div><strong>ID:</strong> {{ customer.id }}</div>
          </div>
          <div class="col-12 col-md-6">
            <div><strong>Vorname:</strong> {{ customer.first_name }}</div>
          </div>
          <div class="col-12 col-md-6">
            <div><strong>Nachname:</strong> {{ customer.last_name }}</div>
          </div>
          <div class="col-12 col-md-6">
            <div><strong>Email:</strong> {{ customer.email }}</div>
          </div>
          <div class="col-12 col-md-6">
            <div><strong>Telefon:</strong> {{ customer.phone }}</div>
          </div>
          <div class="col-12 col-md-6">
            <div><strong>Straße, Hausnummer:</strong> {{ customer.street }}</div>
          </div>
          <div class="col-12 col-md-6">
            <div><strong>PLZ:</strong> {{ customer.postal_code }}</div>
          </div>
          <div class="col-12 col-md-6">
            <div><strong>Stadt:</strong> {{ customer.city }}</div>
          </div>
        </div>
        <div class="q-mt-md text-center">
          <q-btn flat label="Zurück" color="primary" @click="goBack" />
        </div>
      </q-card-section>
    </q-card>

    <q-dialog v-model="deleteDialog">
      <q-card>
        <q-card-section class="row items-center">
          <span class="q-ml-sm">Möchten Sie diesen Eintrag löschen?</span>
        </q-card-section>
        <q-card-actions align="right">
          <q-btn flat label="Abbrechen" color="primary" v-close-popup />
          <q-btn flat label="Löschen" color="negative" @click="deleteCustomer" v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </q-page>
</template>

<script>
import axios from 'axios';
import { ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';

export default {
  name: 'CustomerView',
  setup() {
    const customer = ref({});
    const deleteDialog = ref(false);
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

    const editCustomer = () => {
      router.push(`/customers/${route.params.id}/edit`);
    };

    const confirmDelete = () => {
      deleteDialog.value = true;
    };

    const deleteCustomer = async () => {
      try {
        await axios.delete(`/api/customers/${route.params.id}`);
        router.push('/customers');
      } catch (error) {
        console.error('Error deleting customer:', error);
      }
    };

    const goBack = () => {
      router.push('/customers');
    };

    onMounted(fetchCustomer);

    return {
      customer,
      deleteDialog,
      editCustomer,
      confirmDelete,
      deleteCustomer,
      goBack
    };
  }
};
</script>

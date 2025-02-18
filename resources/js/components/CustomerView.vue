<template>
  <q-page class="q-pa-md bg-light-gray text-black">
    <q-card>
      <q-card-section>
        <div class="row items-center justify-between">
          <div class="text-h6">Customer Details</div>
          <div class="q-gutter-sm">
            <q-btn flat icon="edit" color="primary" @click="editCustomer" />
            <q-btn flat icon="delete" color="negative" @click="confirmDelete" />
          </div>
        </div>
      </q-card-section>
      <q-separator />
      <q-card-section>
        <div class="q-gutter-y-md">
          <div><strong>First Name:</strong> {{ customer.first_name }}</div>
          <div><strong>Last Name:</strong> {{ customer.last_name }}</div>
          <div><strong>Email:</strong> {{ customer.email }}</div>
          <div><strong>Phone:</strong> {{ customer.phone }}</div>
          <div><strong>Street:</strong> {{ customer.street }}</div>
          <div><strong>Postal Code:</strong> {{ customer.postal_code }}</div>
          <div><strong>City:</strong> {{ customer.city }}</div>
        </div>
      </q-card-section>
      <q-card-actions>
        <q-btn flat label="Back to List" color="primary" @click="goBack" />
      </q-card-actions>
    </q-card>

    <q-dialog v-model="deleteDialog">
      <q-card>
        <q-card-section class="row items-center">
          <span class="q-ml-sm">Delete this customer?</span>
        </q-card-section>
        <q-card-actions align="right">
          <q-btn flat label="Cancel" color="primary" v-close-popup />
          <q-btn flat label="Delete" color="negative" @click="deleteCustomer" v-close-popup />
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

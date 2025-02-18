<template>
  <q-page class="q-pa-md">
    <q-card>
      <q-card-section class="row justify-between items-center">
        <div class="text-h6">Kundendetails</div>
        <div class="text-caption q-mr-md">ID: <span class="text-body1">{{ customer.id }}</span></div>
      </q-card-section>
      <q-separator />
      <q-card-section>
        <div class="row q-col-gutter-md">
          <div class="col-12 col-md-6">
            <q-item>
              <q-item-section>
                <q-item-label class="text-caption">Vorname</q-item-label>
                <q-item-label class="text-body1">{{ customer.first_name }}</q-item-label>
              </q-item-section>
            </q-item>
          </div>
          <div class="col-12 col-md-6">
            <q-item>
              <q-item-section>
                <q-item-label class="text-caption">Nachname</q-item-label>
                <q-item-label class="text-body1">{{ customer.last_name }}</q-item-label>
              </q-item-section>
            </q-item>
          </div>
          <div class="col-12 col-md-6">
            <q-item>
              <q-item-section>
                <q-item-label class="text-caption">Email</q-item-label>
                <q-item-label class="text-body1">
                  <a :href="'mailto:' + customer.email" class="text-primary">{{ customer.email }}</a>
                </q-item-label>
              </q-item-section>
            </q-item>
          </div>
          <div class="col-12 col-md-6">
            <q-item>
              <q-item-section>
                <q-item-label class="text-caption">Telefon</q-item-label>
                <q-item-label class="text-body1">
                  <a :href="'tel:' + customer.phone" class="text-primary">{{ customer.phone }}</a>
                </q-item-label>
              </q-item-section>
            </q-item>
          </div>
          <div class="col-12 col-md-6">
            <q-item>
              <q-item-section>
                <q-item-label class="text-caption">Straße, Hausnummer</q-item-label>
                <q-item-label class="text-body1">{{ customer.street }}</q-item-label>
              </q-item-section>
            </q-item>
          </div>
          <div class="col-12 col-md-6">
            <q-item>
              <q-item-section>
                <q-item-label class="text-caption">PLZ</q-item-label>
                <q-item-label class="text-body1">{{ customer.postal_code }}</q-item-label>
              </q-item-section>
            </q-item>
          </div>
          <div class="col-12 col-md-6">
            <q-item>
              <q-item-section>
                <q-item-label class="text-caption">Ort</q-item-label>
                <q-item-label class="text-body1">{{ customer.city }}</q-item-label>
              </q-item-section>
            </q-item>
          </div>
        </div>
        <div class="q-mt-md row justify-between">
          <q-btn flat label="Zurück" color="primary" @click="goBack" />
          <div>
            <q-btn flat icon="edit" color="primary" @click="editCustomer" />
            <q-btn flat icon="delete" color="negative" @click="confirmDelete" />
          </div>
        </div>
      </q-card-section>
    </q-card>

    <q-dialog v-model="deleteDialog">
      <q-card>
        <q-card-section class="row items-center">
          <span class="q-ml-sm">Möchten Sie diesen Eintrag wirklich löschen?</span>
        </q-card-section>
        <q-card-actions align="right">
          <q-btn flat label="Abbrechen" color="primary" v-close-popup />
          <q-btn flat label="Löschen" color="negative" @click="deleteCustomer" />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </q-page>
</template>

<script>
import axios from 'axios';
import { ref } from 'vue';
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
      }
    };

    const goBack = () => {
      router.push('/customers');
    };

    const editCustomer = () => {
      router.push(`/customers/${customer.value.id}/edit`);
    };

    const confirmDelete = () => {
      deleteDialog.value = true;
    };

    const deleteCustomer = async () => {
      try {
        await axios.delete(`/api/customers/${customer.value.id}`);
        router.push('/customers');
      } catch (error) {
        console.error('Error deleting customer:', error);
      }
    };

    fetchCustomer();

    return {
      customer,
      deleteDialog,
      goBack,
      editCustomer,
      confirmDelete,
      deleteCustomer
    };
  }
};
</script>

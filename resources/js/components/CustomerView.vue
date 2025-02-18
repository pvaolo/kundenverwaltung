<template>
  <q-page class="q-pa-md">
    <q-card>
      <q-card-section>
        <div class="text-h6">Kundendetails</div>
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
                <q-item-label class="text-caption">Stadt</q-item-label>
                <q-item-label class="text-body1">{{ customer.city }}</q-item-label>
              </q-item-section>
            </q-item>
          </div>
        </div>
        <div class="q-mt-md">
          <q-btn flat label="Zurück" color="primary" @click="goBack" />
        </div>
      </q-card-section>
    </q-card>
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

    fetchCustomer();

    return {
      customer,
      goBack
    };
  }
};
</script>

<template>
  <div id="app" class="bg-soft-blue">
    <MainLayout>
      <!-- Removed q-drawer component -->
      <q-page-container>
        <router-view></router-view>
      </q-page-container>
    </MainLayout>
  </div>
</template>

<script>
import MainLayout from './layouts/MainLayout.vue';

export default {
  name: 'App',
  components: {
    MainLayout
  },
  data() {
    return {
      drawer: true
    }
  }
}
</script>

<style>
/* Add any global styles here */
.bg-soft-blue {
  background-color: #e0fae4; /* Soft blue */
}

.text-primary {
  color: #000000; /* Primary text color */
}

.text-secondary {
  color: #004d40; /* Secondary text color */
}

.q-btn {
  border-radius: 8px; /* Softer button corners */
}

.q-card {
  border-radius: 12px; /* Softer card corners */
}

.q-input {
  border-radius: 8px; /* Softer input corners */
}
</style>

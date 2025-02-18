<template>
  <div id="app" class="bg-light-gray">
    <MainLayout>
      <q-drawer show-if-above v-model="drawer" side="left" bordered>
        <q-list>
          <q-item to="/" clickable v-ripple>
            <q-item-section avatar>
              <q-icon name="home" />
            </q-item-section>
            <q-item-section>
              Home
            </q-item-section>
          </q-item>
          <q-item to="/customers" clickable v-ripple>
            <q-item-section avatar>
              <q-icon name="people" />
            </q-item-section>
            <q-item-section>
              Customers
            </q-item-section>
          </q-item>
        </q-list>
      </q-drawer>
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
.bg-light-gray {
  background-color: #f5f5f5;
}
</style>

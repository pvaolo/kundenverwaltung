import { createRouter, createWebHistory } from 'vue-router';
import CustomerList from '../components/CustomerList.vue';
import CustomerView from '../components/CustomerView.vue';
import CustomerEdit from '../components/CustomerEdit.vue';
import CustomerCreate from '../components/CustomerCreate.vue';

const routes = [
  { path: '/customers', component: CustomerList },
  { path: '/customers/create', component: CustomerCreate },
  { path: '/customers/:id', component: CustomerView },
  { path: '/customers/:id/edit', component: CustomerEdit },
  { path: '/:pathMatch(.*)*', redirect: '/customers' }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;

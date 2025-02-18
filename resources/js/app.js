import '../css/app.css';
import { createApp } from 'vue';
import { Quasar } from 'quasar';
import quasarLang from 'quasar/lang/en-US';
import quasarIconSet from 'quasar/icon-set/material-icons';
import router from './router';
import App from './App.vue';
import CustomerList from './components/CustomerList.vue'; // Corrected path

const app = createApp(App);

app.component('customer-list', CustomerList);
app.use(router);
app.use(Quasar, {
    plugins: {},
    lang: quasarLang,
    iconSet: quasarIconSet,
});

app.mount('#app');
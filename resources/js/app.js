import './bootstrap';

import { createApp } from 'vue';
import App from './App.vue';
import router from './Router';
import Menu from './Components/Menu.vue';
import { createPinia } from 'pinia';
const pinia = createPinia();

import Pagination from './Components/Pagination.vue'

const app = createApp(App);
app.component('Menu',Menu);
app.component('Pagination',Pagination);
app.use(pinia);
app.use(router);
app.mount('#app-vue');
import './bootstrap';

import { createApp } from 'vue';
import App from './App.vue';
import router from './Router';
import Menu from './Components/Menu.vue';
import { createPinia } from 'pinia';
import Cleave from 'vue-cleave-component';
const pinia = createPinia();

import Pagination from './Components/Pagination.vue'

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import { PerfectScrollbarPlugin } from 'vue3-perfect-scrollbar';
import 'vue3-perfect-scrollbar/style.css';

import DashGrap from './Components/DashGrap.vue';


const app = createApp(App);
app.component('Menu',Menu);
app.component('Pagination',Pagination);
app.component('DashGrap',DashGrap);
app.use(VueSweetalert2);
app.use(pinia);
app.use(router);
app.use(Cleave);
app.use(PerfectScrollbarPlugin)
app.mount('#app-vue');
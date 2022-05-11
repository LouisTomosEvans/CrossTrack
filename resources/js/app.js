import Vue from 'vue';
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import axios from 'axios';
import VueAxios from 'vue-axios';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import App from './components/App.vue';
import VueRouter from 'vue-router';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

Vue.use(VueRouter);

Vue.use(Vuetify);

Vue.component('app', App);

Vue.prototype.$http = axios;

Vue.config.productionTip = false;

Vue.use(VueAxios, axios);

import dashboardComponent from './components/dashboardComponent.vue'
Vue.component('dashboard-component', dashboardComponent);

const routes = [
    { path: '/', component: dashboardComponent },
    {path: '/:catchAll(.*)', component: dashboardComponent }
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

const app = document.getElementById('app');

if (app) {
    new Vue({
        router,
        vuetify: new Vuetify(),
    }).$mount(app);
}

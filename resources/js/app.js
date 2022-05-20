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
import ApexCharts from 'apexcharts';

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

import reportComponent from './components/reportComponent.vue'
Vue.component('report-component', reportComponent);

import insightComponent from './components/insightComponent.vue'
Vue.component('insight-component', insightComponent);

import accountComponent from './components/accountsComponent.vue'
Vue.component('account-component', accountComponent);

const routes = [
    { path: '/', component: dashboardComponent },
    { path: '/reports', component: reportComponent },
    { path: '/insights', component: insightComponent },
    { path: '/accounts', component: accountComponent },
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

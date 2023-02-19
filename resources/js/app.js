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

import companiesComponent from './components/companiesComponent.vue'
Vue.component('companies-component', companiesComponent);

import segmentsComponent from './components/segmentsComponent.vue'
Vue.component('segments-component', segmentsComponent);

import teamComponent from './components/teamComponent.vue'
Vue.component('team-component', teamComponent);

import websiteComponent from './components/websiteComponent.vue'
Vue.component('website-component', websiteComponent);


import loadingScreenComponent from './components/loadingScreenComponent.vue'
Vue.component('loading-screen', loadingScreenComponent);

const routes = [
    { path: '/', component: dashboardComponent },
    { path: '/companies', component: companiesComponent },
    { path: '/segments', component: segmentsComponent },
    { path: '/team', component: teamComponent },
    { path: '/websites', component: websiteComponent },
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

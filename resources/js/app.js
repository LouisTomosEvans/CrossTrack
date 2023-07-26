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
import VueCompositionAPI from '@vue/composition-api';
import pinia from './pinia.js'

window.Alpine = Alpine;

Alpine.start();

Vue.use(VueRouter);
Vue.use(VueCompositionAPI);
Vue.use(Vuetify);

Vue.component('app', App);

Vue.prototype.$http = axios;

Vue.config.productionTip = false;

Vue.use(VueAxios, axios);

import dashboardComponent from './components/dashboardComponent.vue'
Vue.component('dashboard-component', dashboardComponent);

import programmingComponent from './components/programmingComponent.vue'
Vue.component('programming-component', programmingComponent);

import segmentsComponent from './components/segmentsComponent.vue'
Vue.component('segments-component', segmentsComponent);

import rosterComponent from './components/rosterComponent.vue'
Vue.component('roster-component', rosterComponent);

import websiteComponent from './components/websiteComponent.vue'
Vue.component('website-component', websiteComponent);

import loadingScreenComponent from './components/loadingScreenComponent.vue'
Vue.component('loading-screen', loadingScreenComponent);

const routes = [
    { path: '/', component: dashboardComponent },
    { path: '/programs', component: programmingComponent },
    { path: '/segments', component: segmentsComponent, name: 'segments' },
    { path: '/roster', component: rosterComponent },
    { path: '/websites', component: websiteComponent },
    {path: '/:catchAll(.*)', component: dashboardComponent }
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

const app = document.getElementById('app');

const constantsMeta = document.querySelector('meta[name="laravel-constants"]');
if (constantsMeta) {
  window.LaravelConstants = JSON.parse(atob(constantsMeta.content));
}


if (app) {
    new Vue({
        router,
        pinia,
        vuetify: new Vuetify(),
    }).$mount(app);
}

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

Vue.use(VueRouter)

Vue.use(Vuetify)

Vue.component('app', App);

Vue.prototype.$http = axios

Vue.config.productionTip = false

Vue.use(VueAxios, axios)

    import PopupContent from './components/PopupContent.vue'
    Vue.component('PopupContent', PopupContent);

  import dashboardComponent from './components/dashboardComponent.vue'
  Vue.component('dashboard-component', dashboardComponent);

  import myRecordsComponent from './components/myRecordsComponent.vue'
  Vue.component('my-records-component', myRecordsComponent);

  import knowledgeBaseComponent from './components/knowledgeBaseComponent.vue'
  Vue.component('knowledge-base-component', knowledgeBaseComponent);

  import locationToolsComponent from './components/locationToolsComponent'
  Vue.component('location-tools-component', locationToolsComponent);

  import imageAnalyserComponent from './components/imageAnalyserComponent'
  Vue.component('image-analyser-component', imageAnalyserComponent);

  import textAnalyserComponent from './components/textAnalyserComponent'
  Vue.component('text-analyser-component', textAnalyserComponent);

  import accountFinderComponent from './components/accountFinderComponent'
  Vue.component('account-finder-component', accountFinderComponent);

  import leakFinderComponent from './components/leakFinderComponent'
  Vue.component('leak-finder-component', leakFinderComponent);

  const routes = [
    { path: '/', component: dashboardComponent },
    { path: '/records', component: myRecordsComponent },
    { path: '/knowledge-base', component: knowledgeBaseComponent },
    { path: '/location-tools', component: locationToolsComponent},
    { path: '/image-analyser', component: imageAnalyserComponent},
    { path: '/text-analyser', component: textAnalyserComponent},
    { path: '/account-finder', component: accountFinderComponent},
    { path: '/leak-finder', component: leakFinderComponent},
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

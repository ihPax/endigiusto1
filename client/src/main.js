import Vue from 'vue'
import App from './App.vue'

import ListCondominiums from '@/components/ListCondominiums.vue';
import CreateCondominium from '@/components/CreateCondominium.vue';
import ViewCondominium from '@/components/ViewCondominium.vue';

import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'list_condominiums',
    component: ListCondominiums
  },
  {
    path: '/create',
    name: 'create_condominium',
    component: CreateCondominium
  },
  {
    path: '/edit/:id',
    name: 'edit_condominium',
    component: CreateCondominium
  },
  {
    path: '/view/:id',
    name: 'view_condominium',
    component: ViewCondominium
  },
  {
    path: '',
    redirect: '/',
  }
];

const router = new VueRouter({
  mode: "history",
  routes,
});

new Vue({
  router,
  render: h => h(App),
}).$mount('#app')

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

//support for vue marksown editor
import 'v-markdown-editor/dist/index.css';
import Editor from 'v-markdown-editor';
// global register
Vue.use(Editor);

//VueX
import Vuex from 'vuex';
Vue.use(Vuex);
import storeData from './store/index';

const store = new Vuex.Store(
    storeData
);

//support for moment js
import {filters} from './filter';

//import vue router
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import {routes} from './routes';

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('admin-main', require('./components/admin/AdminMaster.vue').default);
Vue.component('user-main', require('./components/user/UserMaster.vue').default);

//V-form
import Vue from 'vue';
import { Form, HasError, AlertError } from 'vform';

Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
window.Form = Form;

// sweet alert 2
import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

window.Toast = Toast;


const router = new VueRouter({
    mode: 'hash',
    routes // short for `routes: routes`
});


const app = new Vue({
    el: '#app',
    router,
    store
});


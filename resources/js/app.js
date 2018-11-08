
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment';

import {store} from './store/store';


import {Form, HasError, AlertError} from 'vform';

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import VueRouter from 'vue-router';
import {routes} from './routes.js';
// ES6 Modules or TypeScript
import swal from 'sweetalert2';
import StarRating from 'vue-star-rating';

// CommonJS
window.swal = swal;

const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

window.toast = toast;

export const EventBus = new Vue();


window.Fire = new Vue();

//progress bar

import VueProgressBar from 'vue-progressbar';

Vue.use(VueProgressBar, {
    color: 'rgb(143,255,199)',
    failedColor: 'red',
    height: '3px',
});

Vue.use(VueRouter);

export const router = new VueRouter({
    routes,
    mode: 'history'
});

Vue.filter('myDate',function (created) {
    return moment(created).format("DD/MM/YY");
});

Vue.filter('formatTime', function(value) {
    if (value) {
        const parts = value.split(":");
        return +parts[0] + "h " + +parts[1] + "m";
    } else {
        return "unknown"
    }
});

Vue.filter('myTime',function (created) {
    return moment(created, "HH:mm:ss").format("hh:mm A");
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

Vue.component('star-rating',StarRating);
Vue.component('InscriptionState', require('./components/buttons/InscriptionState.vue'));

const app = new Vue({
    router,
    store,
    el: '#app',

});



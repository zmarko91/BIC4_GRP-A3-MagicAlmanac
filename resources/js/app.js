/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

import vue from 'vue';
import moment from 'moment';

window.Vue = vue;


Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('MM/DD/YYYY HH:mm')
    }
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/DashboardComponent.vue -> <dashboard-component></dashboard-component>
 */

Vue.component('dashboard-component', require('./components/DashboardComponent.vue').default);
Vue.component('query-message', require('./components/base/QueryMessage.vue').default);
Vue.component('spells', require('./components/SpellsComponent.vue').default);
Vue.component('spell', require('./components/SpellComponent.vue').default);
Vue.component('spell-form', require('./components/SpellFormComponent.vue').default);
Vue.component('spell-search', require('./components/SpellSearchComponent.vue').default);
Vue.component('kinds', require('./components/KindsComponent.vue').default);
Vue.component('kind', require('./components/KindComponent.vue').default);
Vue.component('kind-form', require('./components/KindFormComponent.vue').default);
Vue.component('hero', require('./components/base/HeroComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('create-connection', require('./components/CreateConnection.vue').default);
Vue.component('countdown', require('./components/Countdown.vue').default);
Vue.component('search-station-input', require('./components/SearchStationInput.vue').default);
Vue.component('list-connections', require('./components/ListConnections.vue').default);
Vue.component('delete-connection-icon', require('./components/DeleteConnectionIcon.vue').default);
Vue.component('set-default-connection-icon', require('./components/SetDefaultConnectionIcon.vue').default);
Vue.component('clock', require('./components/Clock.vue').default);


/**
 * Passport Components
 */
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);


const app = new Vue({
    el: '#app',
});

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Load translations file
 */
// window.tranlate = require('./VueTranslation/Translation').default.translate;
Vue.prototype.translate = require('./VueTranslation/Translation').default.translate;

Vue.filter('dateFromNow', function (date) {

    // Get Date in UTC
    var stillUtc = moment.utc(date).toDate();
    // Convert it to Locale timezone 'Africa/Cairo'

    var local = moment(stillUtc).local();

    // Date From Now in Human readable
    var fromNow = local.fromNow();

    return fromNow;
});

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('group', require('./components/group/index.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

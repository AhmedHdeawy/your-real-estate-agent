/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


// Load Vue Chat Scroll
import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)


// Sweet Alert
import Swal from 'sweetalert2';
window.Swal = Swal;

// handle sweet alert
const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.toast = toast;


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

Vue.filter('cutText', function (txt, start = 0, length) {
    return txt.substr(start, length);
});

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('group', require('./components/group/index.vue').default);
Vue.component('search', require('./components/search/index.vue').default);
Vue.component('messenger', require('./components/messenger/index.vue').default);
Vue.component('HomeGroups', require('./components/HomeGroups.vue').default);
Vue.component('HomePosts', require('./components/HomePosts.vue').default);
Vue.component('ShowPost', require('./components/group/posts/ShowPost.vue').default);
Vue.component('avatar', require('vue-avatar').default);


// Map
import * as VueGoogleMaps from 'vue2-google-maps';
Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyDwHS6Ghc-UD_SU9QSeZZzH4VJ6toFiaBs',
        libraries: 'geometry',
        language: localeLang,
    },
    installComponents: true
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    created() {

        //   Listen for new notification
        Echo.private("group-request." + authedUser.id).listen(
            "RequestJoin",
            e => {

                if (parseInt($('.notification-count').text()) == 0) {

                    $('.notification-count').removeClass('d-none').text(1);
                } else {

                    $('.notification-count').text(parseInt($('.notification-count').text()) + 1);
                }

                document.getElementById('notificationAudio').play();
            }
        );
    }
});

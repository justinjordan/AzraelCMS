
/**
 * Include Dependencies
 */
window.Vue = require('vue');
// require('./bootstrap');

/**
 * Setup Vue.js Components
 */
Vue.component('pages-panel', require('./components/PagesPanel.vue'));
const app = new Vue({
    el: 'main'
});

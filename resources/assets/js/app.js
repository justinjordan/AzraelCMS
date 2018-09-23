
/**
 * Include Dependencies
 */
window.Vue = require('vue');
if (typeof window.fetch !== 'function') {
    window.fetch = require('./fetch');
}

/**
 * Setup Vue.js Components
 */
Vue.component('pages-panel', require('./components/PagesPanel.vue'));
const app = new Vue({
    el: 'main'
});

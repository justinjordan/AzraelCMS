
// Include Dependencies
window.Vue = require('vue');
if (typeof window.fetch !== 'function') {
    window.fetch = require('./fetch');
}

// Setup Vue.js Components
Vue.component('pages-panel', require('./components/PagesPanel.vue'));
Vue.component('settings-panel', require('./components/SettingsPanel.vue'));

const app = new Vue({
    el: 'main'
});

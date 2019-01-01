
// Include Dependencies
import 'materialize-css'
import Vue from 'vue'

// Setup custom Vue.js components
Vue.component('pages-panel', require('./components/PagesPanel.vue'))
Vue.component('settings-panel', require('./components/SettingsPanel.vue'))
Vue.component('templates-panel', require('./components/TemplatesPanel.vue'))
Vue.component('edit-template-panel', require('./components/EditTemplatePanel.vue'))

const app = new Vue({
    el: 'main'
})

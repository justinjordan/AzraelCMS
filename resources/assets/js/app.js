
// Include Dependencies
import Vue from 'vue'
import Vuex from 'vuex'
import VueRouter from 'vue-router'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuex)
Vue.use(VueRouter)
Vue.use(Vuetify)

// Include Route Components
import DashboardPanel from './components/DashboardPanel.vue'
import PagesPanel from './components/PagesPanel.vue'
import SettingsPanel from './components/SettingsPanel.vue'
import TemplatesPanel from './components/TemplatesPanel.vue'
import EditTemplatePanel from './components/EditTemplatePanel.vue'

const store = new Vuex.Store({
  state: {
    breadcrumbs: [],
  },
  mutations: {
    setBreadcrumbs(state, breadcrumbs) {
      state.breadcrumbs = breadcrumbs
    }
  },
})

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/admin',
      redirect: '/admin/dashboard',
    },
    {
      path: '/admin/dashboard',
      component: DashboardPanel,
    },
    {
      path: '/admin/pages',
      component: PagesPanel,
    },
    {
      path: '/admin/settings',
      component: SettingsPanel,
    },
    {
      path: '/admin/settings/templates',
      component: TemplatesPanel,
    },
    {
      path: '/admin/settings/templates/:templateId',
      component: EditTemplatePanel,
    },
  ],
})

// Setup Vue.js components
Vue.component('admin-panel', require('./components/AdminPanel.vue'));

const app = new Vue({
  store,
  router,
}).$mount('#app')


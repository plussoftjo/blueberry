
// Import BootStrap
require('./bootstrap');


// Vue Things
window.Vue = require('vue');

import App from './App.vue'
import VueRouter from 'vue-router'
import routes from './routes/routes.js'
import vuetify from './plugins/vuetify.js'
Vue.use(VueRouter)
const router = new VueRouter({
    routes, // short for routes: routes
    scrollBehavior: (to) => {
      if (to.hash) {
        return {selector: to.hash}
      } else {
        return { x: 0, y: 0 }
      }
    }
  })

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router,
    vuetify
});

import { UserRoleEnum } from './additionalModules/Enums'
import Mapper from './additionalModules/Mappers'
import ConditionalParser from './additionalModules/ConditionalParser'
import '@fortawesome/fontawesome-free/css/all.css'
import vuetify from './plugins/vuetify'
import Vue from 'vue'
import 'vuetify/dist/vuetify.min.css'
import Validator from './additionalModules/Validator'

import store from './store'
import route from './route'
import i18n from './lang'
require('./bootstrap')

window.Validator = Validator

Vue.component('loader', require('./components/Loader').default)
Vue.component('ContainerBlock', require('./components/Contract/Builder/Blocks/ContainerBlock').default)

ConditionalParser.setStore(store)

window.ConditionalParser = ConditionalParser

Vue.filter('truncate', function (text, clamp) {
  return text.slice(0, 50) + (text.length > 50 ? clamp || '...' : '')
})

window.auth.setStore(store)
window.auth.setRouter(route)

Vue.mixin({
  data: function () {
    return {
      Auth: window.auth,
      Mapper: Mapper,
      Validator: Validator,
      Notify: window.Notify,
      ConditionalParser: ConditionalParser
    }
  },
  methods: {
    getRoleName (roleId) {
      for (const i in UserRoleEnum) {
        if (UserRoleEnum[i] === roleId) { return this.$t(`user.roles.${i}`) }
      }
      return '---'
    }
  }
})

const app = new Vue({
  vuetify,
  el: '#app',
  i18n,
  store,
  router: route
})

export default app

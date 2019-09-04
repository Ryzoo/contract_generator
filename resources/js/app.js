import {UserRoleEnum} from "./additionalModules/Enums";
import Mapper from "./additionalModules/Mappers";
import Variable from "./additionalModules/Variable";

require('./bootstrap');
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'


window.Vue = require('vue');

Vue.use(Vuetify, {
    theme: {
        primary: '#d4ac71',
        secondary: '#324a58',
        accent: '#ccbd99',
        error: '#ff675f',
        info: '#35a9f3',
        success: '#77bc7a',
        warning: '#FFC107'
    }
});

Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('lazy-img', require('./components/LazyImg').default);
Vue.component('loader', require('./components/Loader').default);

import store from './store';
import route from './route'
import i18n from './lang'


Vue.mixin({
    data: function () {
        return {
            Mapper: Mapper,
            Variable
        }
    },
    methods:{
        getRoleName(roleId){
            for (let i in UserRoleEnum) {
                if(UserRoleEnum[i] == roleId)
                    return this.$t(`user.roles.${i}`)
            }
            return "---";
        }
    }
});

const app = new Vue({
    el: '#app',
    i18n,
    store,
    router: route,
});

window.auth.setStore(store);
window.auth.setRouter(route);

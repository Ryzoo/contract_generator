import {UserRoleEnum} from "./additionalModules/Enums";
import Mapper from "./additionalModules/Mappers";
import '@fortawesome/fontawesome-free/css/all.css'
require('./bootstrap');
import vuetify from './plugins/vuetify';
import 'vuetify/dist/vuetify.min.css'

window.Vue = require('vue');

Vue.component('loader', require('./components/Loader').default);

import store from './store';
import route from './route'
import i18n from './lang'

Vue.mixin({
    data: function () {
        return {
            Mapper: Mapper
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
    vuetify,
    el: '#app',
    i18n,
    store,
    router: route,
});

window.auth.setStore(store);
window.auth.setRouter(route);

import {UserRoleEnum} from "./additionalModules/Enums";
import Mapper from "./additionalModules/Mappers";
import ConditionalParser from "./additionalModules/ConditionalParser";
import '@fortawesome/fontawesome-free/css/all.css'
require('./bootstrap');
import vuetify from './plugins/vuetify';
import 'vuetify/dist/vuetify.min.css'
import Validator from "./additionalModules/Validator";

window.Vue = require('vue');
window.Validator = Validator;

Vue.component('loader', require('./components/Loader').default);

import store from './store';
import route from './route'
import i18n from './lang'

ConditionalParser.setStore(store);

window.ConditionalParser = ConditionalParser;

Vue.filter('truncate', function (text, clamp) {
    return text.slice(0, 50) + (50 < text.length ? clamp || '...' : '')
});

Vue.mixin({
    data: function () {
        return {
            Mapper: Mapper,
            Validator: Validator,
            Notify: window.Notify,
            ConditionalParser: ConditionalParser
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

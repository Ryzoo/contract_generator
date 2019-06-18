require('./bootstrap');
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

window.Vue = require('vue');

Vue.use(Vuetify, {
    theme: {
        primary: '#1976D2',
        secondary: '#424242',
        accent: '#82B1FF',
        error: '#FF5252',
        info: '#2196F3',
        success: '#4CAF50',
        warning: '#FFC107'
    }
});

Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('lazy-img', require('./components/LazyImg').default);

import store from './store';
import route from './route'
import i18n from './lang'

const app = new Vue({
    el: '#app',
    i18n,
    store,
    router: route
});

require('./bootstrap');
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

window.Vue = require('vue');

Vue.use(Vuetify, {
    theme: {
        primary: '#825339',
        secondary: '#50778d',
        accent: '#82533a',
        error: '#b71c1c'
    }
});

Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import store from './store';
import route from './route'
import i18n from './lang'

const app = new Vue({
    el: '#app',
    i18n,
    store,
    router: route
});

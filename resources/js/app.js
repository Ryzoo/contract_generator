require('./bootstrap');
import VueInternationalization from 'vue-i18n';
import Locale from './assets/vue-i18n-locales.generated';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faBars, faPoll, faUser, faCog, faFileContract, faTh } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'


require('./bootstrap');

library.add(faBars, faPoll, faUser, faCog, faFileContract, faTh);

window.Vue = require('vue');

Vue.use(VueInternationalization);
Vue.use(Vuetify, {
    theme: {
        primary: '#825339',
        secondary: '#50778d',
        accent: '#82533a',
        error: '#b71c1c'
    }
});

const lang = document.documentElement.lang.substr(0, 2);
// or however you determine your current app locale

const i18n = new VueInternationalization({
    locale: lang,
    messages: Locale
});

Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import store from './store';
import route from './route'

const app = new Vue({
    el: '#app',
    i18n,
    store,
    router: route
});

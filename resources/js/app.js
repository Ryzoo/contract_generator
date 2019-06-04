require('./bootstrap');

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

window.Vue = require('vue');

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

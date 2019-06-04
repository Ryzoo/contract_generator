require('./bootstrap');
import VueInternationalization from 'vue-i18n';
import Locale from './assets/vue-i18n-locales.generated';

window.Vue = require('vue');

Vue.use(VueInternationalization);

const lang = document.documentElement.lang.substr(0, 2);
const i18n = new VueInternationalization({
    locale: lang,
    messages: Locale
});

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import store from './store';
import route from './route'

const app = new Vue({
    el: '#app',
    i18n,
    store,
    router: route
});

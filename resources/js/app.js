import VueInternationalization from 'vue-i18n';
import Locale from './assets/vue-i18n-locales.generated';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faUserSecret } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
require('./bootstrap');

library.add(faUserSecret);

window.Vue = require('vue');

Vue.use(VueInternationalization);

const lang = document.documentElement.lang.substr(0, 2);
// or however you determine your current app locale

const i18n = new VueInternationalization({
    locale: lang,
    messages: Locale
});

Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    i18n,
});

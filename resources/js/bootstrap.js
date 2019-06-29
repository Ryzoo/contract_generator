window._ = require('lodash');
import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
} catch (e) {}

import Notify from "./additionalModules/Notify";
import Validator from "./additionalModules/Validator";
import Auth from "./additionalModules/Auth";

window.notify = new Notify();
window.auth = new Auth();
window.Validator = Validator;

window.axios = require('axios');
window.axios.defaults.baseURL = 'http://127.0.0.1:8000/api';
window.axios.defaults.headers.post['Content-Type'] = 'application/json';
window.axios.interceptors.response.use(
    function(response) {
        return response;
    },
    function(error) {
        if(error.response.data &&  error.response.data.error && error.response.data.error.length>0){
            window.notify.push(error.response.data.error,window.notify.ERROR);
        }
        return Promise.reject(error);
    }
);

library.add(fas);

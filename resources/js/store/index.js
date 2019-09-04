import Vue from "vue";
import Vuex from "vuex";
import authUserModule from "./modules/authUser";
import formAttributesModule from "./modules/formAttributes";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        authUser: authUserModule,
        formAttributes: formAttributesModule
    }
});

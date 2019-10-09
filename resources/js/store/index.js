import Vue from "vue";
import Vuex from "vuex";
import authUserModule from "./modules/authUser";
import formElementsModule from "./modules/formElements";
import blockModule from "./modules/block";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        authUser: authUserModule,
        formElements: formElementsModule,
        block: blockModule
    }
});

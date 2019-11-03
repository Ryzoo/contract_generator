import Vue from "vue";
import Vuex from "vuex";
import authUserModule from "./modules/authUser";
import formElementsModule from "./modules/formElements";
import builderModule from "./modules/builder";
import contractModulesModule from "./modules/contractModules";
import newContractModule from "./modules/newContract"

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        authUser: authUserModule,
        formElements: formElementsModule,
        builder: builderModule,
        contractModules: contractModulesModule,
        newContract: newContractModule
    }
});

import Vue from "vue";
import Vuex from "vuex";
import authUserModule from "./modules/authUser";

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    authUser: authUserModule
  }
});

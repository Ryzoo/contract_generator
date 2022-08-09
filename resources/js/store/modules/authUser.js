const defaultState = {
  authUser: {
    email: "",
    firstName: "",
    id: null,
    lastName: "",
    loginToken: "",
    roles: [],
    profileImage: "",
    created_at: "",
    updated_at: "",
  },
};

const actions = {
  authUser: (context, data) => {
    context.commit("AUTHORIZE_USER", data);
  },
};

const mutations = {
  AUTHORIZE_USER: (state, data) => {
    state.authUser = data;
  },
};

const getters = {
  authUser: (state) => state.authUser,
  roles: (state) => state.authUser.roles,
};

export default {
  state: defaultState,
  getters,
  actions,
  mutations,
};

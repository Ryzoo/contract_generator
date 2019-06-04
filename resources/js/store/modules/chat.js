
const defaultState = {
  messages: [],
};

const actions = {
  getMessages: (context) => {
    context.commit('MESSAGES_UPDATED', 'asd');
  },
};

const mutations = {
  MESSAGES_UPDATED: (state, messages) => {
    state.messages = messages;
  },
};

const getters = {
  messages: state => state.messages,
};

export default {
  state: defaultState,
  getters,
  actions,
  mutations,
};
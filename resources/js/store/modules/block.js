import {ConditionalEnum, FormElementsEnum} from "../../additionalModules/Enums";

const defaultState = {
  blocks: [],
  activeBlock: [],
  idIncrement: 1,
  currentNewBlockButtonIndex: 0,
  variables: [],
};

const actions = {
  block_set: (context, data) => {
    context.commit('SET_BLOCK', data);
  },
  block_setActiveBlock: (context, data) => {
    context.commit('SET_ACTIVE_BLOCK', data);
  },
  block_idIncrement: (context, data) => {
    context.commit('INCREMENT_ID', data);
  },
  block_buttonIndex: (context, data) => {
    context.commit('CURRENT_BUTTON_INDEX', data);
  },
  block_setVariable: (context, data) => {
    context.commit('SET_VARIABLE', data);
  },
};

const mutations = {
  SET_BLOCK: (state, data) => {
    state.blocks = [];
    state.blocks = data;
  },
  SET_ACTIVE_BLOCK: (state, data) => {
    state.activeBlock = data
  },
  INCREMENT_ID: (state) => {
    state.idIncrement += 1;
  },
  CURRENT_BUTTON_INDEX: (state, data) => {
    state.currentNewBlockButtonIndex = data;
  },
  SET_VARIABLE: (state, data) => {
    state.variables = data;
  },
};

const getters = {
  allBlocks: state => state.blocks,
  activeBlock: state => state.activeBlock,
  getId: state => state.idIncrement,
  allVariables: state => state.variables,
};

export default {
  state: defaultState,
  getters,
  actions,
  mutations,
};
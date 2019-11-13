const defaultState = {
    builder:{
        idIncrement: 1,
        blocks: [],
        variables: [],
        activeBlock: null,
        currentNewBlockButtonIndex: 0,
    }
};

const actions = {
    builder_set: (context, data) => {
        context.commit('BUILDER_SET_BLOCK', data);
    },
    builder_setActiveBlock: (context, data) => {
        context.commit('BUILDER_SET_ACTIVE_BLOCK', data);
    },
    builder_idIncrement: (context, data) => {
        context.commit('BUILDER_INCREMENT_ID', data);
    },
    builder_buttonIndex: (context, data) => {
        context.commit('BUILDER_CURRENT_BUTTON_INDEX', data);
    },
    builder_setVariable: (context, data) => {
        context.commit('BUILDER_SET_VARIABLE', data);
    },
};

const mutations = {
    BUILDER_SET_BLOCK: (state, data) => {
        state.builder.blocks = [];
        state.builder.blocks = data;
    },
    BUILDER_SET_ACTIVE_BLOCK: (state, data) => {
        state.builder.activeBlock = state.builder.blocks.find(x => x.id === data.id);
    },
    BUILDER_INCREMENT_ID: (state) => {
        state.builder.idIncrement += 1;
    },
    BUILDER_CURRENT_BUTTON_INDEX: (state, data) => {
        state.builder.currentNewBlockButtonIndex = data;
    },
    BUILDER_SET_VARIABLE: (state, data) => {
        state.builder.variables = data;
    },
};

const getters = {
    builder_allBlocks: state => state.builder.blocks,
    builder_activeBlock: state => state.builder.activeBlock,
    builder_getId: state => state.builder.idIncrement,
    builder_allVariables: state => state.builder.variables,
};

export default {
    state: defaultState,
    getters,
    actions,
    mutations,
};

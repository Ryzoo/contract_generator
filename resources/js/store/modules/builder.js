const defaultState = {
    builder:{
        idBlockIncrement: 1,
        idVariableIncrement: 1,
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
    builder_idBlockIncrement: (context, data) => {
        context.commit('BUILDER_BLOCK_INCREMENT_ID', data);
    },
    builder_setIdBlockIncrement: (context, data) => {
        context.commit('BUILDER_BLOCK_SET_INCREMENT_ID', data);
    },
    builder_idVariableIncrement: (context, data) => {
        context.commit('BUILDER_VARIABLE_INCREMENT_ID', data);
    },
    builder_setIdVariableIncrement: (context, data) => {
        context.commit('BUILDER_VARIABLE_SET_INCREMENT_ID', data);
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
    BUILDER_BLOCK_INCREMENT_ID: (state) => {
        state.builder.idBlockIncrement += 1;
    },
    BUILDER_BLOCK_SET_INCREMENT_ID: (state, data) => {
        state.builder.idBlockIncrement = data;
    },
    BUILDER_VARIABLE_INCREMENT_ID: (state) => {
        state.builder.idVariableIncrement += 1;
    },
    BUILDER_VARIABLE_SET_INCREMENT_ID: (state, data) => {
        state.builder.idVariableIncrement = data;
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
    builder_getBlockId: state => state.builder.idBlockIncrement,
    builder_getVariableId: state => state.builder.idVariableIncrement,
    builder_allVariables: state => state.builder.variables,
};

export default {
    state: defaultState,
    getters,
    actions,
    mutations,
};

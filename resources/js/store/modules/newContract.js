const defaultState = {
    contract: {
        name: "",
        attributesList: [],
        blocks: [],
        settings: {
            enabledModules: [],
            modules: {}
        }
    }
};

const actions = {
    newContract_set: (context, data) => {
        context.commit('NEW_CONTRACT_SET', data);
    },
};

const mutations = {
    NEW_CONTRACT_SET: (state, data) => {
        state.contract = data;
    },
};

const getters = {
    getNewContractData: state => state.contract,
};

export default {
    state: defaultState,
    getters,
    actions,
    mutations,
};

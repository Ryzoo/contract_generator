const defaultState = {
	formAttributes: []
};

const actions = {
    setAttributes: (context, data) => {
		context.commit('SET_ATTRIBUTES', data);
	},
    formAttributes_changeAttributeValue: (context, data) => {
        context.commit('CHANGE_ATTRIBUTE', data);
    },
};

const mutations = {
    SET_ATTRIBUTES: (state, data) => {
        state.formAttributes = data.map(e=>{
            e.value = e.defaultValue;
            return e;
        });
    },
    CHANGE_ATTRIBUTE: (state, data) => {
        state.formAttributes = state.formAttributes.map(e=>{
            if( e.id === data.id )
                e.value = data.value;
            return e;
        });
    },
};

const getters = {
    formAttributes: state => state.formAttributes,
};

export default {
	state: defaultState,
	getters,
	actions,
	mutations,
};

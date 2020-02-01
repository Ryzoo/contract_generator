const defaultState = {
  availableModules: []
}

const actions = {
  contractModules_set: (context, data) => {
    context.commit('CONTRACT_MODULES_SET_ELEMENTS', data)
  }
}

const mutations = {
  CONTRACT_MODULES_SET_ELEMENTS: (state, data) => {
    state.availableModules = data
  }
}

const getters = {
  availableModules: state => state.availableModules,
  getContractModulesForAction: state => actionType => {
    return state.availableModules.filter(e => {
      return e.renderHooks && !!e.renderHooks[`action-${actionType}`]
    })
  }
}

export default {
  state: defaultState,
  getters,
  actions,
  mutations
}

const defaultState = {
  mode: {
    update: false,
    id: null
  },
  contract: {
    name: '',
    description: '',
    categories: [],
    attributesList: [],
    blocks: [],
    settings: {
      enabledModules: [],
      modules: {}
    }
  }
}

const actions = {
  newContract_clear: (context, data) => {
    context.commit('NEW_CONTRACT_CLEAR', data)
  },
  newContract_setName: (context, data) => {
    context.commit('NEW_CONTRACT_SET_NAME', data)
  },
  newContract_setUpdate: (context, data) => {
    context.commit('NEW_CONTRACT_SET_UPDATE', data)
  },
  newContract_updateModuleState: (context, data) => {
    context.commit('NEW_CONTRACT_UPDATE_MODULE_STATE', data)
  },
  newContract_saveModuleConfig: (context, data) => {
    context.commit('NEW_CONTRACT_SAVE_MODULE_CONFIG', data)
  }
}

const mutations = {
  NEW_CONTRACT_SET_UPDATE: (state, data) => {
    state.contract = data
    state.mode.update = true
    state.mode.id = data.id
  },
  NEW_CONTRACT_CLEAR: (state, data) => {
    state.contract = {
      name: '',
      description: '',
      categories: [],
      attributesList: [],
      blocks: [],
      settings: {
        enabledModules: [],
        modules: {}
      }
    }
    state.mode = {
      update: false,
      id: null
    }
  },
  NEW_CONTRACT_SET_NAME: (state, data) => {
    state.contract.name = data
  },
  NEW_CONTRACT_UPDATE_MODULE_STATE: (state, data) => {
    if (!data.value) { state.contract.settings.enabledModules = state.contract.settings.enabledModules.filter(x => x !== data.name) } else {
      state.contract.settings.enabledModules.push(data.name)

      if (!state.contract.settings.modules[data.name]) { state.contract.settings.modules[data.name] = data.settings }
    }
  },
  NEW_CONTRACT_SAVE_MODULE_CONFIG: (state, data) => {
    state.contract.settings.modules[data.name] = data.value
  }
}

const getters = {
  getNewContractUpdateState: state => state.mode,
  getNewContractData: state => state.contract,
  getModuleSettings: state => moduleName => state.contract.settings.modules[moduleName],
  newContract_availableModules: state => state.contract.settings.enabledModules
}

export default {
  state: defaultState,
  getters,
  actions,
  mutations
}

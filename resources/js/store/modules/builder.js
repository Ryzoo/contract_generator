import { AttributeTypeEnum } from '../../additionalModules/Enums'

const defaultState = {
  builder: {
    idBlockIncrement: 1,
    idVariableIncrement: 1,
    blocks: [],
    variables: [],
    activeBlock: null,
    currentNewBlockButtonIndex: 0
  }
}

const actions = {
  builder_set: (context, data) => {
    context.commit('BUILDER_SET_BLOCK', data)
  },
  builder_updateCurrentMultiGroupAttribute: (context, data) => {
    context.commit('BUILDER_UPDATE_CURRENT_MULTI_ATTRIBUTE', data)
  },
  builder_setActiveBlock: (context, data) => {
    context.commit('BUILDER_SET_ACTIVE_BLOCK', data)
  },
  builder_idBlockIncrement: (context, data) => {
    context.commit('BUILDER_BLOCK_INCREMENT_ID', data)
  },
  builder_setIdBlockIncrement: (context, data) => {
    context.commit('BUILDER_BLOCK_SET_INCREMENT_ID', data)
  },
  builder_idVariableIncrement: (context) => {
    context.commit('BUILDER_VARIABLE_INCREMENT_ID')
  },
  builder_setIdVariableIncrement: (context, data) => {
    context.commit('BUILDER_VARIABLE_SET_INCREMENT_ID', data)
  },
  builder_setVariable: (context, data) => {
    context.commit('BUILDER_SET_VARIABLE', data)
  },
  builder_editVariable: (context, data) => {
    context.commit('BUILDER_EDIT_VARIABLE', data)
  },
  builder_addVariable: (context, data) => {
    context.commit('BUILDER_ADD_VARIABLE', data)
    context.commit('BUILDER_VARIABLE_INCREMENT_ID')
  },
  builder_removeVariable: (context, data) => {
    context.commit('BUILDER_REMOVE_VARIABLE', data)
  },
  builder_blockUpdateContent: (context, data) => {
    context.commit('BUILDER_BLOCK_UPDATE_CONTENT', data)
  },
  builder_changeActiveBlock: (context, data) => {
    context.commit('BUILDER_ACTIVE_BLOCK_UPDATE', data)
  }
}

const mutations = {
  BUILDER_UPDATE_CURRENT_MULTI_ATTRIBUTE: (state, data) => {
    const updateBlock = (blocks, dataValue) => {
      return blocks.map(x => {
        if (x.id == dataValue.id) {
          x.settings = {
            ...x.settings,
            repeatAttributeId: dataValue.value
          }
        }

        if (x.content.blocks) {
          x.content.blocks = updateBlock(x.content.blocks, dataValue)
        }
        return x
      })
    }

    state.builder.blocks = Object.assign([], updateBlock(state.builder.blocks, data))
  },
  BUILDER_EDIT_VARIABLE: (state, data) => {
    state.builder.variables = state.builder.variables.map((attribute) => {
      if (attribute.id == data.id) {
        return {
          ...data
        }
      }

      return attribute
    })
  },
  BUILDER_ADD_VARIABLE: (state, data) => {
    state.builder.variables.push(data)
  },
  BUILDER_SET_BLOCK: (state, data) => {
    state.builder.blocks = []
    state.builder.blocks = data
  },
  BUILDER_SET_ACTIVE_BLOCK: (state, data) => {
    state.builder.activeBlock = data
  },
  BUILDER_ACTIVE_BLOCK_UPDATE: (state, data) => {
    const updateBlock = (block, data) => {
      return block.map(x => {
        if (x.id == data.id) {
          return data
        }

        if (x.content.blocks) {
          x.content.blocks = updateBlock(x.content.blocks, data)
        }
        return x
      })
    }
    state.builder.blocks = updateBlock(state.builder.blocks, data)
    state.builder.activeBlock = data
  },
  BUILDER_BLOCK_UPDATE_CONTENT: (state, data) => {
    const updateBlock = (block, data) => {
      return block.map(x => {
        if (x.id == data.id) {
          x.content = data.content
        }

        if (x.content.blocks) {
          x.content.blocks = updateBlock(x.content.blocks, data)
        }
        return x
      })
    }

    state.builder.blocks = updateBlock(state.builder.blocks, data)
  },
  BUILDER_BLOCK_INCREMENT_ID: (state) => {
    state.builder.idBlockIncrement += 1
  },
  BUILDER_BLOCK_SET_INCREMENT_ID: (state, data) => {
    state.builder.idBlockIncrement = data
  },
  BUILDER_VARIABLE_INCREMENT_ID: (state) => {
    state.builder.idVariableIncrement += 1
  },
  BUILDER_VARIABLE_SET_INCREMENT_ID: (state, data) => {
    state.builder.idVariableIncrement = data
  },
  BUILDER_SET_VARIABLE: (state, data) => {
    state.builder.variables = data
  },
  BUILDER_REMOVE_VARIABLE: (state, Id) => {
    state.builder.variables = state.builder.variables.filter((item) => item.id !== Id)
    state.builder.blocks = state.builder.blocks.map(x => {
      const replaceText = `{${Id}}`

      if (x.conditionals) {
        x.conditionals = x.conditionals.filter(c => !c.content.includes(replaceText))
      }

      if (x.content.text) {
        x.content.text = x.content.text.replace(replaceText, '')
      }

      return x
    })
  }
}

const getters = {
  builder_allBlocks: state => state.builder.blocks,
  builder_getBlockId: state => state.builder.idBlockIncrement,
  builder_getVariableId: state => state.builder.idVariableIncrement,
  builder_allVariables: state => state.builder.variables,
  builder_allVariables_defaultText: state => {
    const returnedVar = []
    const variablesUsedInGroups = []

    state.builder.variables
      .filter(x => x.attributeType === AttributeTypeEnum.ATTRIBUTE_GROUP)
      .forEach(attribute => {
        attribute.settings.attributes.forEach(x => {
          variablesUsedInGroups.push(x.id + '')
        })
      })

    const allVar = state.builder.variables
      .filter(x => !(!!x.settings.isMultiUse) || (!!x.settings.isMultiUse && !!x.settings.isInline))
      .filter(x => !variablesUsedInGroups.includes(x.id + ''))

    allVar.forEach(attribute => {
      if (attribute.attributeType === AttributeTypeEnum.ATTRIBUTE_GROUP) {
        attribute.settings.attributes.forEach(x => {
          returnedVar.push({
            ...x,
            attributeName: attribute.attributeName + ' - ' + x.attributeName,
            id: attribute.id + ':' + x.id
          })
        })
      } else returnedVar.push(attribute)
    })

    return returnedVar
  },
  builder_multiGroupAttributes: state => state.builder.variables.filter(x => !!x.settings.isMultiUse && !(!!x.settings.isInline)),
  builder_variablesForRepeatBlock: (state) => (id) => {
    const block = getBlockById(state.builder.blocks, id)
    const attribute = getAttributeById(state.builder.variables, block ? block.settings.repeatAttributeId : null)
    if (attribute) {
      if (attribute.attributeType === AttributeTypeEnum.ATTRIBUTE_GROUP) {
        return attribute.settings.attributes.map(x => ({
          ...x,
          attributeName: attribute.attributeName + ' - ' + x.attributeName,
          id: attribute.id + ':' + x.id
        }))
      }

      return [
        {
          attributeName: attribute.attributeName + ' - ' + 'Value',
          id: attribute.id + ':value'
        }
      ]
    }
    return []
  },
  builder_currentMultiGroupAttribute: (state) => (id) => {
    const block = getBlockById(state.builder.blocks, id)
    return block ? block.settings.repeatAttributeId : null
  }
}

const getAttributeById = (attributes, id) => attributes.find(x => x.id == id)

const getBlockById = (blocks, id) => {
  let returnBlock = null

  blocks.forEach(x => {
    if (x.id == id) {
      returnBlock = x
    }
    if (x.content.blocks) {
      const block = getBlockById(x.content.blocks, id)
      if (block) returnBlock = block
    }
  })

  return returnBlock
}

export default {
  state: defaultState,
  getters,
  actions,
  mutations
}

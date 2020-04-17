import {
  AttributeTypeEnum,
  ConditionalEnum,
  FormElementsEnum
} from '../../additionalModules/Enums'
import AttributeValidator
  from '../../components/Contract/Form/Validators/AttributeValidator'

const defaultState = {
  formElements: []
}

const actions = {
  formElements_validate_current: (context, data) => {
    context.commit('VALIDATE_ACTUAL', data)
    context.commit('RECALCULATE_CONDITIONS')
  },
  formElements_set: (context, data) => {
    context.commit('SET_ELEMENTS', data)
    context.commit('RECALCULATE_CONDITIONS')
  },
  formElements_change: (context, data) => {
    context.commit('CHANGE_ELEMENT', data)
    context.commit('RECALCULATE_CONDITIONS')
  }
}

const mutations = {
  VALIDATE_ACTUAL: (state, data) => {
    state.formElements = getters.formElementsStepList(state)[data].content.filter(x => x.isActive)
      .map(e => {
        if (e.attribute.attributeType === AttributeTypeEnum.ATTRIBUTE_GROUP) {
          return {
            ...e,
            validationError: '',
            isValid: e.attribute.value.every(x => AttributeValidator.validate(x, x.value).status)
          }
        }

        if (e.attribute.settings.isMultiUse && Array.isArray(e.attribute.value)) {
          return {
            ...e,
            validationError: '',
            isValid: e.attribute.value.every(x => AttributeValidator.validate(e.attribute, x).status)
          }
        }

        const validatorResult = AttributeValidator.validate(e.attribute, e.attribute.value)
        return {
          ...e,
          validationError: validatorResult.errorMessage,
          isValid: validatorResult.status
        }
      })
  },
  SET_ELEMENTS: (state, data) => {
    state.formElements = data.map((e, index) => {
      e.id = index
      if (e.elementType === FormElementsEnum.ATTRIBUTE) {
        e.attribute.value = e.attribute.defaultValue

        if (e.attribute.attributeType === 6) {
          e.attribute.value = !!e.attribute.defaultValue
        }
      }
      return e
    })
  },
  CHANGE_ELEMENT: (state, data) => {
    state.formElements = state.formElements.map(e => {
      if (e.id === data.id) {
        const validatorResult = AttributeValidator.validate(e.attribute, data.value)
        return {
          ...e,
          attribute: {
            ...e.attribute,
            value: data.value
          },
          validationError: validatorResult.errorMessage,
          isValid: validatorResult.status
        }
      } else {
        return e
      }
    })
  },
  RECALCULATE_CONDITIONS: (state) => {
    state.formElements = state.formElements.map(e => {
      if (e.elementType === FormElementsEnum.ATTRIBUTE) {
        e.isActive = ConditionalParser.validate(ConditionalEnum.SHOW_ON, e)
      }
      return e
    })
  }
}

const getters = {
  formElements: state => state.formElements,
  formElementsStepList: state => {
    let currentIndex = 0
    let listToReturn = [{
      id: 1,
      completed: false,
      content: []
    }]

    state.formElements.filter(x => x.isActive).map(e => {
      switch (e.elementType) {
        case FormElementsEnum.PAGE_BRAKE:
          currentIndex++
          listToReturn.push({
            id: 1 + currentIndex,
            completed: false,
            content: []
          })
          break
        default:
          listToReturn[currentIndex].content.push(e)
      }
    })

    listToReturn = listToReturn.filter(x => x.content.length > 0)
    listToReturn = listToReturn.map((item, index) => {
      item.id = 1 + index
      return item
    })

    return listToReturn
  }
}

export default {
  state: defaultState,
  getters,
  actions,
  mutations
}

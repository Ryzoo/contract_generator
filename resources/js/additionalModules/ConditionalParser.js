
import { FormElementsEnum } from './Enums'
import ModelObjectToTextParser from './Parsers/ModelObjectToTextParser'

class ConditionalParser {
  setStore (store) {
    this.store = store
  }

  validate (conditionalType, attribute) {
    return attribute.conditionals
      .every(c => parseInt(c.conditionalType) !== parseInt(conditionalType) || this.isConditionalValidAndEqual(ModelObjectToTextParser.parse(JSON.parse(c.content)), true))
  }

  isConditionalValidAndEqual (content, equalValue) {
    if (!this.store.getters.formElements) {
      return !equalValue
    }
    return this.parseConditionalStringToBool(content) === equalValue
  }

  parseConditionalStringToBool (content) {
    const contentWithVariables = content
      .split(' ')
      .map(e => e.replace(/{(\d+)}/g, (m, id) => this.getVariableValue(parseInt(id))))

    // eslint-disable-next-line no-eval
    return eval(contentWithVariables.join(' '))
  }

  getVariableValue (varId) {
    const allAttributes = this.store.getters.formElements
      .filter(e => e.elementType === FormElementsEnum.ATTRIBUTE)
      .map(e => e.attribute)

    const foundedAttribute = allAttributes.find(e => e.id === parseInt(varId))

    if (!foundedAttribute) {
      console.error(`Var: ${varId} not found`)
      return null
    }

    return foundedAttribute.value || null
  }
}

export default new ConditionalParser()

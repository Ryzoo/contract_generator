
import { AttributeTypeEnum, FormElementsEnum } from './Enums'
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
      .map(e => e.replace(/{(\d+)}/g, (m, id) => this.getVariableValue(id)))
      .map(e => e.replace(/{(\d+:\d+)}/g, (m, id) => this.getVariableValue(id)))
      .map(e => e.replace(/{(\d+:value)}/g, (m, id) => this.getVariableValue(id)))

    // eslint-disable-next-line no-eval
    return eval(contentWithVariables.join(' '))
  }

  getVariableValue (varId) {
    const allAttributes = this.store.getters.formElements
      .filter(e => e.elementType === FormElementsEnum.ATTRIBUTE)
      .map(e => e.attribute)

    let foundedAttribute = null

    if (varId.includes(':')) {
      const id = varId.split(':')[0]
      const value = varId.split(':')[1]
      const attr = allAttributes.find(e => parseInt(e.id) === parseInt(id))

      if (attr) {
        const attrVal = attr.value
        if (!attr.settings.isMultiUse && attr.attributeType === AttributeTypeEnum.ATTRIBUTE_GROUP) {
          foundedAttribute = attrVal.find(y => parseInt(y.id) === parseInt(value))
        } else if (attr.settings.isMultiUse && attr.attributeType === AttributeTypeEnum.ATTRIBUTE_GROUP) {
          foundedAttribute = attrVal[0].find(y => parseInt(y.id) === parseInt(value))
        } else if (!attr.settings.isMultiUse) {
          foundedAttribute = attrVal
        } else {
          foundedAttribute = attrVal[0]
        }
      }
    } else {
      foundedAttribute = allAttributes
        .find(e => parseInt(e.id) === parseInt(varId))
    }

    if (!foundedAttribute) {
      console.error(`Var: ${varId} not found`)
      return null
    }

    return foundedAttribute.value || null
  }
}

export default new ConditionalParser()

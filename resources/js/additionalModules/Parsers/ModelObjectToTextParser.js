import { RuleTypes } from './utilities'
import { TextOperatorParser, NumberOperatorParser, SelectOperatorParser, MultiSelectOperatorParser } from './Operators'

export default class ModelObjectToTextParser {
  static parse (modelObject) {
    return ModelObjectToTextParser.parseGroup(modelObject.operator, modelObject.children)
  }

  static parseRule (id, operatorType, value, ruleType) {
    const variable = `{${id}}`

    switch (ruleType) {
      case RuleTypes.TEXT: return TextOperatorParser.parse(`'${variable}'`, operatorType, value ? `'${value}'` : '\'\'')
      case RuleTypes.NUMBER: return NumberOperatorParser.parse(variable, operatorType, value ? Number(value) : -1)
      case RuleTypes.SELECT: return SelectOperatorParser.parse(`'${variable}'`, operatorType, value ? `'${value}'` : '\'\'')
      case RuleTypes.MULTI_SELECT: return MultiSelectOperatorParser.parse(`'${variable}'`, operatorType, value ? `'${value}'` : '\'\'')
    }

    return ''
  }

  static parseChildren (childrenArray) {
    return childrenArray.map(child => {
      switch (child.type) {
        case 'rule':
          return ModelObjectToTextParser.parseRule(child.query.id, child.query.operator, child.query.value, child.query.ruleType)
        case 'group':
          return `( ${ModelObjectToTextParser.parseGroup(child.query.operator, child.query.children)} )`
      }
      return ''
    })
  }

  static parseGroup (operator, children) {
    const parsedChildren = ModelObjectToTextParser.parseChildren(children || [])
    return parsedChildren.join(operator === 'All' ? ' && ' : ' || ')
  }
}

import { OperatorType } from '../utilities'

export class DefaultParser {
  static parse (variable, operatorType, value) {

    switch (operatorType) {
      case OperatorType.EQUAL:
        return `${variable} === ${value}`
      case OperatorType.N_EQUAL:
        return `${variable} !== ${value}`
      case OperatorType.CONTAINS:
        return `${variable}.includes(${value})`
      case OperatorType.N_CONTAINS:
        return `!${variable}.includes(${value})`
      case OperatorType.EMPTY:
        return `!${variable} && ${variable} !== 0 && ${variable} !== '0'`
      case OperatorType.N_EMPTY:
        return `!!${variable} || ${variable} === 0 || ${variable} === '0'`
      case OperatorType.BEGINS_WITH:
        return `${variable}.startsWith(${value})`
      case OperatorType.ENDS_WITH:
        return `${variable}.endsWith(${value})`
      case OperatorType.GREATER:
        return `${variable}.length() > parseInt(${value})`
      case OperatorType.GREATER_OR_EQUAL:
        return `${variable}.length() >= parseInt(${value})`
      case OperatorType.SMALLER:
        return `${variable}.length() < parseInt(${value})`
      case OperatorType.SMALLER_OR_EQUAL:
        return `${variable}.length() <= parseInt(${value})`
    }
    return ''
  }
}

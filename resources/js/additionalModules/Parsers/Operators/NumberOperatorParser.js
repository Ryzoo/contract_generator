import { DefaultParser } from './DefaultParser'
import { OperatorType } from '../utilities'

export class NumberOperatorParser extends DefaultParser {
  static parse (variable, operatorType, value) {
    switch (operatorType) {
      case OperatorType.CONTAINS:
        return `'${variable}'.includes('${value}')`
      case OperatorType.N_CONTAINS:
        return `!'${variable}'.includes('${value}')`
      case OperatorType.EMPTY:
        return `(!${variable} && ${variable} !== 0)`
      case OperatorType.N_EMPTY:
        return `(!!${variable} || ${variable} !== 0)`
      case OperatorType.BEGINS_WITH:
        return `'${variable}'.startsWith('${value}')`
      case OperatorType.ENDS_WITH:
        return `'${variable}'.endsWith('${value}')`
      case OperatorType.GREATER:
        return `Number(${variable}) > ${value}`
      case OperatorType.GREATER_OR_EQUAL:
        return `Number(${variable}) >= ${value}`
      case OperatorType.SMALLER:
        return `Number(${variable}) < ${value}`
      case OperatorType.SMALLER_OR_EQUAL:
        return `Number(${variable}) <= ${value}`
    }
    return DefaultParser.parse(variable, operatorType, value)
  }
}

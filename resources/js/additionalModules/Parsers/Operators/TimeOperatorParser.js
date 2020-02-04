import { DefaultParser } from './DefaultParser'
import { OperatorType } from '../utilities'

export class TimeOperatorParser extends DefaultParser {
  static parse (variable, operatorType, value) {
    if (!variable || !value) {
      return 'false'
    }

    switch (operatorType) {
      case OperatorType.GREATER:
        return `(new Date('2020-01-01 ${variable}')).getTime() > (new Date('2020-01-01 ${value}')).getTime()`
      case OperatorType.GREATER_OR_EQUAL:
        return `(new Date('2020-01-01 ${variable}')).getTime() >= (new Date('2020-01-01 ${value}')).getTime()`
      case OperatorType.SMALLER:
        return `(new Date('2020-01-01 ${variable}')).getTime() < (new Date('2020-01-01 ${value}')).getTime()`
      case OperatorType.SMALLER_OR_EQUAL:
        return `(new Date('2020-01-01 ${variable}')).getTime() <= (new Date('2020-01-01 ${value}')).getTime()`
    }
    return DefaultParser.parse(variable, operatorType, value)
  }
}

import { DefaultParser } from './DefaultParser'
import { OperatorType } from '../utilities'

export class BoolOperatorParser extends DefaultParser {
  static parse (variable, operatorType, value) {
    switch (operatorType) {
      case OperatorType.EQUAL:
        return `!!${variable} === ${value}`
      case OperatorType.N_EQUAL:
        return `!!${variable} !== ${value}`
    }
    return DefaultParser.parse(variable, operatorType, value)
  }
}

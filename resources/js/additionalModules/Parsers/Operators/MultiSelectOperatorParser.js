import { OperatorType } from '../utilities'
import { DefaultParser } from './DefaultParser'

export class MultiSelectOperatorParser extends DefaultParser {
  static parse (variable, operatorType, value) {
    switch (operatorType) {
      case OperatorType.EQUAL:
        return `${variable}.split(',').every( x => ${value}.split(',').includes(x))`
      case OperatorType.N_EQUAL:
        return `!${variable}.split(',').every( x => ${value}.split(',').includes(x))`
    }
    return DefaultParser.parse(variable, operatorType, value)
  }
}

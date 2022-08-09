import { DefaultParser } from './DefaultParser'
import { OperatorType } from '../utilities'

export class BoolInputOperatorParser extends DefaultParser {
    static parse(variable, operatorType, value) {
        value = value ? value.bool : false

        switch (operatorType) {
            case OperatorType.EQUAL:
                return `!!${variable} === ${value}`
            case OperatorType.N_EQUAL:
                return `!!${variable} !== ${value}`
        }
        return DefaultParser.parse(variable, operatorType, value)
    }
}

import { DefaultParser } from './DefaultParser'
import { OperatorType } from '../utilities'

export class TextOperatorParser extends DefaultParser {
    static parse(variable, operatorType, value) {
        variable = `"${variable}".replaceAll("'", '')`

        switch (operatorType) {
            case OperatorType.EMPTY:
                return `${variable} === 'null' && ${variable} !== ''`
            case OperatorType.N_EMPTY:
                return `${variable} !== \\'null\\' || ${variable} === ''`
        }
        return DefaultParser.parse(variable, operatorType, value)
    }
}

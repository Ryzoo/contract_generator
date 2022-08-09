import { OperatorType } from "../utilities";
import { DefaultParser } from "./DefaultParser";

export class MultiSelectOperatorParser extends DefaultParser {
  static parse(variable, operatorType, value) {
    switch (operatorType) {
      case OperatorType.EQUAL:
        return `${variable}.split('|,').every( x => ${value}.split('|,').includes(x))`;
      case OperatorType.N_EQUAL:
        return `!${variable}.split('|,').every( x => ${value}.split('|,').includes(x))`;
      case OperatorType.CONTAINS:
        return `${variable}.split('|,').some( x => ${value}.split('|,').includes(x))`;
      case OperatorType.N_CONTAINS:
        return `!${variable}.split('|,').some( x => ${value}.split('|,').includes(x))`;
      case OperatorType.EMPTY:
        return `${variable}.split('|,').length() <= 0`;
      case OperatorType.N_EMPTY:
        return `${variable}.split('|,').length() > 0`;
    }
    return DefaultParser.parse(variable, operatorType, value);
  }
}

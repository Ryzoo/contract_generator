import { DefaultParser } from "./DefaultParser";
import { OperatorType } from "../utilities";

export class DateOperatorParser extends DefaultParser {
  static parse(variable, operatorType, value) {
    if (!variable || !value) {
      return "false";
    }

    switch (operatorType) {
      case OperatorType.GREATER:
        return `(new Date(${variable})).getTime() > (new Date('${value}')).getTime()`;
      case OperatorType.GREATER_OR_EQUAL:
        return `(new Date(${variable})).getTime() >= (new Date('${value}')).getTime()`;
      case OperatorType.SMALLER:
        return `(new Date(${variable})).getTime() < (new Date('${value}')).getTime()`;
      case OperatorType.SMALLER_OR_EQUAL:
        return `(new Date(${variable})).getTime() <= (new Date('${value}')).getTime()`;
    }
    return DefaultParser.parse(variable, operatorType, value);
  }
}

import { DefaultParser } from "./DefaultParser";
import { OperatorType } from "../utilities";

export class AggregateOperatorParser extends DefaultParser {
  static parse(variable, operatorType, value) {
    if (!variable || !value) {
      return "false";
    }

    switch (operatorType) {
      case OperatorType.GREATER:
        return `Number(${variable}) > Number(${value})`;
      case OperatorType.GREATER_OR_EQUAL:
        return `Number(${variable}) >= Number${value})`;
      case OperatorType.SMALLER:
        return `Number(${variable}) < Number${value})`;
      case OperatorType.SMALLER_OR_EQUAL:
        return `Number(${variable}) <= Number${value})`;
    }
    return DefaultParser.parse(variable, operatorType, value);
  }
}

import { DefaultParser } from "./DefaultParser";

export class SelectOperatorParser extends DefaultParser {
  static parse(variable, operatorType, value) {
    return DefaultParser.parse(variable, operatorType, value);
  }
}

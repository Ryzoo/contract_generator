import { BlockTypeEnum } from "./Enums";

class Mapper {
  static getBlockName(id) {
    switch (id) {
      case BlockTypeEnum.EMPTY_BLOCK:
        return "EmptyBlock";
      case BlockTypeEnum.PAGE_DIVIDE_BLOCK:
        return "PageDivideBlock";
      case BlockTypeEnum.TEXT_BLOCK:
        return "TextBlock";
      default:
        return "NotFoundBlock";
    }
  }
}

export default Mapper;
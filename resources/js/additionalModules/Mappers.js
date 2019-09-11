import {AttributeTypeEnum, BlockTypeEnum} from "./Enums";

class Mapper {
  static getBlockName(type) {
    switch (parseInt(type)) {
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

  static getAttributeComponentName(type){
      switch (parseInt(type)) {
          case AttributeTypeEnum.NUMBER:
              return "NumberAttribute";
          case AttributeTypeEnum.TEXT:
              return "TextAttribute";
          default:
              return "NotFoundAttribute";
      }
  }
}

export default Mapper;

import {
  FormElementsEnum,
  AttributeTypeEnum,
  BlockTypeEnum,
  ContractModulesAvailablePlace
} from './Enums'
import AggregateAttribute
  from "../components/Contract/Builder/Modals/VariableView/VariableSettings/AggregateAttribute";

class Mapper {
  static getBlockName (type) {
    switch (parseInt(type)) {
      case BlockTypeEnum.EMPTY_BLOCK:
        return 'EmptyBlock'
      case BlockTypeEnum.PAGE_DIVIDE_BLOCK:
        return 'PageDivideBlock'
      case BlockTypeEnum.TEXT_BLOCK:
        return 'TextBlock'
      case BlockTypeEnum.REPEAT_BLOCK:
        return 'RepeatBlock'
      case BlockTypeEnum.LIST_BLOCK:
        return 'ListBlock'
      case BlockTypeEnum.LIST_ITEM_BLOCK:
        return 'ListItemBlock'
      default:
        return 'NotFoundBlock'
    }
  }

  static getElementFormComponentName (type) {
    switch (parseInt(type)) {
      case FormElementsEnum.ATTRIBUTE:
        return 'AttributeFormElements'
      default:
        return 'NotFoundFormElements'
    }
  }

  static getAttributeComponentName (type) {
    switch (parseInt(type)) {
      case AttributeTypeEnum.NUMBER:
        return 'NumberAttribute'
      case AttributeTypeEnum.TEXT:
        return 'TextAttribute'
      case AttributeTypeEnum.SELECT:
        return 'SelectAttribute'
      case AttributeTypeEnum.ATTRIBUTE_GROUP:
        return 'RepeatGroupAttribute'
      case AttributeTypeEnum.DATE:
        return 'DateAttribute'
      case AttributeTypeEnum.TIME:
        return 'TimeAttribute'
      case AttributeTypeEnum.BOOL:
        return 'BoolAttribute'
      case AttributeTypeEnum.AGGREGATE:
        return 'AggregateAttribute'
      case AttributeTypeEnum.BOOL_INPUT:
        return 'BoolInputAttribute'
      case AttributeTypeEnum.CURRENCY:
        return 'CurrencyAttribute'
      default:
        return 'NotFoundAttribute'
    }
  }

  static getModulePlaceName (type) {
    switch (parseInt(type)) {
      case ContractModulesAvailablePlace.FINISHER:
        return 'End modules'
      case ContractModulesAvailablePlace.POST_FORM:
        return 'Business modules'
      case ContractModulesAvailablePlace.PRE_FORM:
        return 'Start modules'
      default:
        return 'NotFoundPlace'
    }
  }
}

export default Mapper

import {
    FormElementsEnum,
    AttributeTypeEnum,
    BlockTypeEnum,
    ContractModulesAvailablePlace
} from "./Enums";

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

    static getElementFormComponentName(type) {
        switch (parseInt(type)) {
            case FormElementsEnum.ATTRIBUTE:
                return "AttributeFormElements";
            default:
                return "NotFoundFormElements";
        }
    }

    static getAttributeComponentName(type) {
        switch (parseInt(type)) {
            case AttributeTypeEnum.NUMBER:
                return "NumberAttribute";
            case AttributeTypeEnum.TEXT:
                return "TextAttribute";
            case AttributeTypeEnum.SELECT:
                return "SelectAttribute";
            default:
                return "NotFoundAttribute";
        }
    }

    static getModulePlaceName(type) {
        switch (parseInt(type)) {
            case ContractModulesAvailablePlace.FINISHER:
                return "End modules";
            case ContractModulesAvailablePlace.POST_FORM:
                return "Business modules";
            case ContractModulesAvailablePlace.PRE_FORM:
                return "Start modules";
            default:
                return "NotFoundPlace";
        }
    }
}

export default Mapper;

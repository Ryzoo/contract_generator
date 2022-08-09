import {
    FormElementsEnum,
    AttributeTypeEnum,
    BlockTypeEnum,
    ContractModulesAvailablePlace,
} from './Enums'

class Mapper {
    static getBlockComponentByName(type) {
        switch (parseInt(type)) {
            case BlockTypeEnum.EMPTY_BLOCK:
                return window.$t('EmptyBlock')
            case BlockTypeEnum.PAGE_DIVIDE_BLOCK:
                return window.$t('PageDivideBlock')
            case BlockTypeEnum.TEXT_BLOCK:
                return window.$t('TextBlock')
            case BlockTypeEnum.REPEAT_BLOCK:
                return window.$t('RepeatBlock')
            case BlockTypeEnum.LIST_BLOCK:
                return window.$t('ListBlock')
            default:
                return window.$t('NotFoundBlock')
        }
    }

    static getBlockName(type) {
        switch (parseInt(type)) {
            case BlockTypeEnum.EMPTY_BLOCK:
                return window.$t('elements.EmptyBlock')
            case BlockTypeEnum.PAGE_DIVIDE_BLOCK:
                return window.$t('elements.PageDivideBlock')
            case BlockTypeEnum.TEXT_BLOCK:
                return window.$t('elements.TextBlock')
            case BlockTypeEnum.REPEAT_BLOCK:
                return window.$t('elements.RepeatBlock')
            case BlockTypeEnum.LIST_BLOCK:
                return window.$t('elements.ListBlock')
            default:
                return window.$t('elements.NotFoundBlock')
        }
    }

    static getElementFormComponentName(type) {
        switch (parseInt(type)) {
            case FormElementsEnum.ATTRIBUTE:
                return 'AttributeFormElements'
            default:
                return 'NotFoundFormElements'
        }
    }

    static getAttributeComponentName(type) {
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

    static getModulePlaceName(type) {
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

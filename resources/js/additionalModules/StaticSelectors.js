import { BlockTypeEnum } from './Enums'
import translator from '../VueTranslation/Translation'

window.$t = translator.translate

const Selector = {

  Operators: [
    {
      value: '==',
      text: 'equal'
    },
    {
      value: '!=',
      text: 'not equal'
    },
    {
      value: '>',
      text: 'larger'
    },
    {
      value: '<',
      text: 'lower'
    }
  ],

  BlockType: [
    {
      value: BlockTypeEnum.TEXT_BLOCK,
      text: window.$t('elements.TextBlock')
    },
    {
      value: BlockTypeEnum.EMPTY_BLOCK,
      text: window.$t('elements.EmptyBlock')
    },
    {
      value: BlockTypeEnum.PAGE_DIVIDE_BLOCK,
      text: window.$t('elements.PageDivideBlock')
    },
    {
      value: BlockTypeEnum.REPEAT_BLOCK,
      text: window.$t('elements.RepeatBlock')
    },
    {
      value: BlockTypeEnum.LIST_BLOCK,
      text: window.$t('elements.ListBlock')
    }
  ],

  VariableType: [
    {
      value: 0,
      text: 'Zmienna numeryczna'
    },
    {
      value: 1,
      text: 'Zmienna tekstowa'
    },
    {
      value: 2,
      text: 'Select'
    }
  ]
}

export default Selector

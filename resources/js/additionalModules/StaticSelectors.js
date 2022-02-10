import { BlockTypeEnum } from './Enums'

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
      text: 'Text'
    },
    {
      value: BlockTypeEnum.EMPTY_BLOCK,
      text: 'Container'
    },
    {
      value: BlockTypeEnum.PAGE_DIVIDE_BLOCK,
      text: 'Page breaker'
    },
    {
      value: BlockTypeEnum.REPEAT_BLOCK,
      text: 'Repeat'
    },
    {
      value: BlockTypeEnum.LIST_BLOCK,
      text: 'List'
    },
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

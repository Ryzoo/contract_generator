import {AttributeTypeEnum, BlockTypeEnum, FormElementsEnum} from "./Enums";

const Selector = {

  Operators: [
    {
      value: "==",
      text: "równe"
    },
    {
      value: "!=",
      text: "różne"
    },
    {
      value: ">",
      text: "większe"
    },
    {
      value: "<",
      text: "mniejsze"
    }
  ],

  BlockType: [
    {
      value: BlockTypeEnum.TEXT_BLOCK,
      text: "Tekstowy"
    },
    {
      value: BlockTypeEnum.EMPTY_BLOCK,
      text: "Pusty"
    },
    {
      value: BlockTypeEnum.PAGE_DIVIDE_BLOCK,
      text: "Podział strony"
    }
  ]
};

export default Selector;
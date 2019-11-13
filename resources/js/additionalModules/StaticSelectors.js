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
    ],

    VariableType: [
        {
            value: 0,
            text: "Zmienna numeryczna"
        },
        {
            value: 1,
            text: "Zmienna tekstowa"
        },
        {
            value: 2,
            text: "Select"
        },
    ],
};

export default Selector;

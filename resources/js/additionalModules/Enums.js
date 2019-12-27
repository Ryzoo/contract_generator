export const UserRoleEnum = {
  CLIENT: '0',
  ADMINISTRATOR: '1'
}

export const BlockTypeEnum = {
  NEW_BLOCK: -1,
  TEXT_BLOCK: 0,
  EMPTY_BLOCK: 1,
  PAGE_DIVIDE_BLOCK: 2
}

export const AttributeTypeEnum = {
  NUMBER: 0,
  TEXT: 1,
  SELECT: 2,
  REPEAT_GROUP: 3
}

export const ConditionalEnum = {
  SHOW_ON: 0
}

export const FormElementsEnum = {
  PAGE_BRAKE: 0,
  ATTRIBUTE: 1
}

export const AvailableRenderActionsHook = {
  BEFORE_FORM_RENDER: 0,
  FORM_RENDER: 1,
  BEFORE_FORM_END: 2,
  AFTER_FORM_END: 3
}

export const ContractModulesAvailablePlace = {
  PRE_FORM: 0,
  POST_FORM: 1,
  FINISHER: 2
}

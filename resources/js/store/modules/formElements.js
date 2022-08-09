import {
  AttributeTypeEnum,
  ConditionalEnum,
  FormElementsEnum,
} from "../../additionalModules/Enums";
import AttributeValidator from "../../components/Contract/Form/Validators/AttributeValidator";

const defaultState = {
  formElements: [],
};
const prepareAttributeDefault = (attribute) => {
  switch (parseInt(attribute.attributeType)) {
    case AttributeTypeEnum.BOOL_INPUT:
      return {
        input: attribute.defaultValue,
        bool: false,
      };
    case AttributeTypeEnum.BOOL:
      return !!attribute.defaultValue;
    case AttributeTypeEnum.CURRENCY:
      return {
        currency: attribute.defaultValue.currency,
        number: attribute.defaultValue.number,
      };
    case AttributeTypeEnum.DATE:
      return attribute.value
        ? new Date(attribute.value).toISOString().substr(0, 10)
        : new Date().toISOString().substr(0, 10);
    case AttributeTypeEnum.TIME:
      return attribute.value
        ? new Date(attribute.value).toISOString().substr(11, 5)
        : new Date().toISOString().substr(11, 5);
    case AttributeTypeEnum.ATTRIBUTE_GROUP:
      return attribute.settings.attributes.map((x) => ({
        ...x,
        attributeName: x.settings.required
          ? (x.description || x.attributeName) + "*"
          : x.description || x.attributeName,
        placeholder: x.placeholder ? String(x.placeholder) : " ",
        errorMessage: "",
        isValid: true,
        isActive: ConditionalParser.validate(ConditionalEnum.SHOW_ON, x),
        defaultValue: prepareAttributeDefault(x),
        value: prepareAttributeDefault(x),
      }));
    case AttributeTypeEnum.SELECT:
      if (Array.isArray(attribute.defaultValue)) {
        return attribute.defaultValue.join("|,");
      }
  }

  return attribute.defaultValue;
};
const validateAttribute = (attribute) => {
  const currentAttribute = AttributeValidator.validate(attribute);

  if (currentAttribute.attributeType === AttributeTypeEnum.ATTRIBUTE_GROUP) {
    if (currentAttribute.settings.isMultiUse) {
      currentAttribute.value = currentAttribute.value.map((x, index) => {
        if (index === 0) {
          return x.map((attributeIn) => {
            if (attributeIn.isActive) {
              return {
                ...AttributeValidator.validate(attributeIn),
              };
            }

            return attributeIn;
          });
        }
        return x;
      });
    } else {
      currentAttribute.value = currentAttribute.value.map((attributeIn) => {
        if (attributeIn.isActive) {
          return {
            ...AttributeValidator.validate(attributeIn),
          };
        }

        return attributeIn;
      });
    }
  }

  return currentAttribute;
};

const actions = {
  formElements_validate_current: (context) => {
    context.commit("RECALCULATE_CONDITIONS");
    context.commit("VALIDATE_ACTUAL");
  },
  formElements_set: (context, data) => {
    context.commit("SET_ELEMENTS", data);
    context.commit("RECALCULATE_CONDITIONS");
  },
  formElements_change_attribute: (context, data) => {
    context.commit("CHANGE_ELEMENT_ATTRIBUTE", data);
    context.commit("RECALCULATE_CONDITIONS");
    context.commit("VALIDATE_CHANGED", data);
  },
  formElements_remove_attribute_row: (context, data) => {
    context.commit("REMOVE_ATTRIBUTE_ROW", data);
    context.commit("RECALCULATE_CONDITIONS");
  },
  formElements_add_attribute_row: (context, attributeId) => {
    context.commit("ADD_ATTRIBUTE_ROW", attributeId);
    context.commit("RECALCULATE_CONDITIONS");
  },
};

const mutations = {
  VALIDATE_CHANGED: (state, data) => {
    state.formElements = state.formElements.map((e) => {
      if (
        e.elementType === FormElementsEnum.ATTRIBUTE &&
        e.attribute &&
        e.attribute.id === data.id
      ) {
        const attribute = validateAttribute(e.attribute);
        return {
          ...e,
          attribute,
          isValid: true,
        };
      }
      return e;
    });
  },
  REMOVE_ATTRIBUTE_ROW: (state, data) => {
    state.formElements = state.formElements.map((e) => {
      if (e.attribute && e.attribute.id === data.id) {
        const allValue = [...e.attribute.value];
        allValue.splice(data.index + 1, 1);
        return {
          ...e,
          attribute: {
            ...e.attribute,
            value: allValue,
          },
        };
      }
      return e;
    });
  },
  ADD_ATTRIBUTE_ROW: (state, attributeId) => {
    state.formElements = state.formElements.map((e) => {
      if (e.attribute && e.attribute.id === attributeId) {
        const attribute = {
          ...e.attribute,
          value: [e.attribute.defaultValue, ...e.attribute.value],
        };

        return {
          ...e,
          attribute,
        };
      }
      return e;
    });
  },
  VALIDATE_ACTUAL: (state) => {
    state.formElements = state.formElements.map((formElement) => {
      if (formElement.elementType === FormElementsEnum.ATTRIBUTE) {
        const attribute = validateAttribute(formElement.attribute);
        return {
          ...formElement,
          attribute,
          isValid: attribute.isValid,
        };
      }
      return formElement;
    });
  },
  SET_ELEMENTS: (state, data) => {
    state.formElements = data.map((e, index) => {
      e.id = index;
      if (e.elementType === FormElementsEnum.ATTRIBUTE) {
        const attrName = e.attribute.description || e.attribute.attributeName;
        e.attribute.attributeName = e.attribute.settings.required
          ? attrName + "*"
          : attrName;
        e.attribute.placeholder = e.attribute.placeholder
          ? String(e.attribute.placeholder)
          : " ";
        e.attribute.errorMessage = "";
        e.attribute.isValid = true;
        e.attribute.isActive = true;
        e.attribute.defaultValue = prepareAttributeDefault(e.attribute);
        e.attribute.value = e.attribute.defaultValue;

        if (e.attribute.settings.isMultiUse) {
          e.attribute.value = [e.attribute.value];
        }
      }
      return e;
    });
  },
  CHANGE_ELEMENT_ATTRIBUTE: (state, data) => {
    state.formElements = state.formElements.map((e) => {
      if (
        e.elementType === FormElementsEnum.ATTRIBUTE &&
        e.attribute &&
        e.attribute.id === data.id
      ) {
        const currentValue = e.attribute.value;
        if (e.attribute.settings.isMultiUse) currentValue.shift();

        const attribute = {
          ...e.attribute,
          value: e.attribute.settings.isMultiUse
            ? [data.value, ...currentValue]
            : data.value,
        };

        return {
          ...e,
          attribute,
          isValid: attribute.isValid,
        };
      }
      return e;
    });
  },
  RECALCULATE_CONDITIONS: (state) => {
    state.formElements = state.formElements.map((e) => {
      if (e.elementType === FormElementsEnum.ATTRIBUTE) {
        e.isActive =
          ConditionalParser.validate(ConditionalEnum.SHOW_ON, e) ||
          (e.attribute.attributeType === AttributeTypeEnum.ATTRIBUTE_GROUP &&
            !!e.attribute.settings.isMultiUse);

        if (e.attribute.attributeType === AttributeTypeEnum.ATTRIBUTE_GROUP) {
          if (e.attribute.settings.isMultiUse) {
            e.attribute.value = e.attribute.value.map((x, index) => {
              if (index === 0) {
                return x.map((y) => ({
                  ...y,
                  isActive: ConditionalParser.validate(
                    ConditionalEnum.SHOW_ON,
                    y
                  ),
                }));
              }

              return x;
            });
          } else {
            e.attribute.value = e.attribute.value.map((x) => ({
              ...x,
              isActive: ConditionalParser.validate(ConditionalEnum.SHOW_ON, x),
            }));
          }
        }
      }
      return {
        ...e,
        isActive: ConditionalParser.validate(ConditionalEnum.SHOW_ON, e),
      };
    });
  },
};

const getters = {
  formElements: (state) => state.formElements,
  formElementsStepList: (state) => {
    let currentIndex = 0;
    const listToReturn = [
      {
        id: 1,
        name: "",
        completed: false,
        content: [],
      },
    ];

    state.formElements.forEach((e) => {
      switch (e.elementType) {
        case FormElementsEnum.PAGE_BRAKE:
          currentIndex++;
          listToReturn.push({
            id: 1 + currentIndex,
            name: e.elementName,
            completed: false,
            content: [],
          });
          break;
        default:
          listToReturn[currentIndex].content.push(e);
      }
    });

    return listToReturn
      .filter((x) => x.content.length > 0)
      .map((item, index) => {
        item.id = 1 + index;
        return item;
      });
  },
};

export default {
  state: defaultState,
  getters,
  actions,
  mutations,
};

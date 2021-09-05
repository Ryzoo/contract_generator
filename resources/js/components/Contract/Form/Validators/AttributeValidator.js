import i18n from '../../../../lang'
import { AttributeTypeEnum } from '../../../../additionalModules/Enums'

class AttributeValidator {
  validate (attribute) {
    this.initialize(attribute)

    if (!this.validateRequired()) { return this.response }

    if (!this.validateValueMax()) { return this.response }

    if (!this.validateValueMin()) { return this.response }

    if (!this.validateLengthMax()) { return this.response }

    if (!this.validateLengthMin()) { return this.response }

    return this.response
  }

  initialize (attribute) {
    // eslint-disable-next-line no-throw-literal
    if (!attribute) { throw 'Attribute validator initialized with null attribute' }

    this.attribute = Object.assign({}, attribute)
    this.settings = this.attribute.settings
    this.value = AttributeValidatorHelper.getValue(attribute)
    this.response = {
      ...attribute,
      errorMessage: '',
      isValid: true
    }

    if (!this.attribute.isActive) {
      this.setResponse('', true)
    }
  }

  validateRequired () {
    if (!!this.settings.required && AttributeValidatorHelper.isEmpty(this.attribute)) {
      const validationError = i18n.t('validation.required', {
        attribute: this.attribute.attributeName
      })
      return this.setResponse(validationError, false)
    }

    return this.setResponse('', true)
  }

  validateValueMax () {
    if (this.settings.valueMax) {
      if (!AttributeValidatorHelper.isInteger(this.attribute)) {
        const validationError = i18n.t('validation.numeric', {
          attribute: this.attribute.attributeName
        })
        return this.setResponse(validationError, false)
      }

      if (parseInt(this.value) > parseInt(this.settings.valueMax)) {
        const validationError = i18n.t('validation.max.numeric', {
          attribute: this.attribute.attributeName,
          max: this.settings.valueMax
        })
        return this.setResponse(validationError, false)
      }
    }

    return this.setResponse('', true)
  }

  validateValueMin () {
    if (this.settings.valueMin) {
      if (!AttributeValidatorHelper.isInteger(this.attribute)) {
        const validationError = i18n.t('validation.numeric', {
          attribute: this.attribute.attributeName
        })
        return this.setResponse(validationError, false)
      }

      if (parseInt(this.value) < parseInt(this.settings.valueMin)) {
        const validationError = i18n.t('validation.min.numeric', {
          attribute: this.attribute.attributeName,
          min: this.settings.valueMin
        })
        return this.setResponse(validationError, false)
      }
    }

    return this.setResponse('', true)
  }

  validateLengthMin () {
    if (this.settings.lengthMin) {
      if (!AttributeValidatorHelper.isString(this.attribute) && !AttributeValidatorHelper.isArray(this.attribute)) {
        const validationError = i18n.t('validation.string', {
          attribute: this.attribute.attributeName
        })
        return this.setResponse(validationError, false)
      }
      if ((AttributeValidatorHelper.isArray(this.attribute) ? this.value.length : String(this.value).length) < parseInt(this.settings.lengthMin)) {
        const validationError = AttributeValidatorHelper.isArray(this.attribute)
          ? i18n.t('validation.min.array', {
            attribute: this.attribute.attributeName,
            min: this.settings.lengthMin
          })
          : i18n.t('validation.min.string', {
            attribute: this.attribute.attributeName,
            min: this.settings.lengthMin
          })

        return this.setResponse(validationError, false)
      }
    }

    return this.setResponse('', true)
  }

  validateLengthMax () {
    if (this.settings.lengthMax) {
      if (!AttributeValidatorHelper.isString(this.attribute) && !AttributeValidatorHelper.isArray(this.attribute)) {
        const validationError = i18n.t('validation.string', {
          attribute: this.attribute.attributeName
        })
        return this.setResponse(validationError, false)
      }

      if ((AttributeValidatorHelper.isArray(this.attribute) ? this.value.length : String(this.value).length) > parseInt(this.settings.lengthMax)) {
        const validationError = AttributeValidatorHelper.isArray(this.attribute)
          ? i18n.t('validation.max.array', {
            attribute: this.attribute.attributeName,
            max: this.settings.lengthMax
          })
          : i18n.t('validation.max.string', {
            attribute: this.attribute.attributeName,
            max: this.settings.lengthMax
          })

        return this.setResponse(validationError, false)
      }
    }

    return this.setResponse('', true)
  }

  setResponse (message, status) {
    this.response = {
      ...this.attribute,
      errorMessage: message,
      isValid: status
    }
    return status
  }
}

class AttributeValidatorHelper {
  static isEmpty (attribute) {
    const value = AttributeValidatorHelper.getValue(attribute)
    const validator = new AttributeValidator()

    switch (parseInt(attribute.attributeType)) {
      case AttributeTypeEnum.BOOL:
        return !value
      case AttributeTypeEnum.BOOL_INPUT:
        return (!value.bool) && (value.input === null || value.input === undefined || value.input === '' || (value.input.length === undefined && isNaN(value.input)))
      case AttributeTypeEnum.SELECT:
        return value === null || value === undefined || value === ''
      case AttributeTypeEnum.ATTRIBUTE_GROUP:
        return value.filter(x => x.isActive).some(x => {
          return !validator.validate(x).isValid
        })
    }

    return value === null || value === undefined || value === '' || (value.length === undefined && isNaN(value))
  }

  static isArray (attribute) {
    const value = AttributeValidatorHelper.getValue(attribute)

    switch (parseInt(attribute.attributeType)) {
      case AttributeTypeEnum.BOOL_INPUT:
        return Array.isArray(value.input)
    }

    return Array.isArray(value)
  }

  static isMulti (attribute) {
    return attribute.settings.isMultiUse
  }

  static isInteger (attribute) {
    const value = AttributeValidatorHelper.getValue(attribute)

    switch (parseInt(attribute.attributeType)) {
      case AttributeTypeEnum.BOOL_INPUT:
        return !isNaN(parseInt(value.input))
    }

    return !isNaN(parseInt(value))
  }

  static isString (attribute) {
    const value = AttributeValidatorHelper.getValue(attribute)

    switch (parseInt(attribute.attributeType)) {
      case AttributeTypeEnum.BOOL_INPUT:
        return String(value.input).length > 0
    }

    return String(value).length > 0
  }

  static getValue (attribute) {
    let value = attribute.value

    if (AttributeValidatorHelper.isMulti(attribute)) {
      value = attribute.value[0]
    }

    switch (parseInt(attribute.attributeType)) {
      case AttributeTypeEnum.CURRENCY:
        return value.number
    }

    return value
  }
}

export default new AttributeValidator()

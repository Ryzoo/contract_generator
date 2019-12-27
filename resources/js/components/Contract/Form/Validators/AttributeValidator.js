import i18n from '../../../../lang'

class AttributeValidator {
  validate (attribute, newValue) {
    this.initialize(attribute, newValue)

    if (!this.validateRequired()) { return this.response }

    if (!this.validateValueMax()) { return this.response }

    if (!this.validateValueMin()) { return this.response }

    if (!this.validateLengthMax()) { return this.response }

    if (!this.validateLengthMin()) { return this.response }

    return this.response
  }

  initialize (attribute, newValue) {
    // eslint-disable-next-line no-throw-literal
    if (!attribute) { throw 'Attribute validator initialized with null attribute' }

    this.attribute = Object.assign({}, attribute)
    this.settings = this.attribute.settings
    this.value = newValue
    this.response = {
      errorMessage: '',
      status: true
    }
  }

  isEmptyOrDefault () {
    return this.isEmpty() || this.isDefault()
  }

  isEmpty () {
    if (this.isArray()) {
      return this.value.length === 0
    } else {
      return this.value === null || this.value === undefined || this.value === '' || (this.value.length === undefined && isNaN(this.value))
    }
  }

  isArray () {
    return Array.isArray(this.value)
  }

  isDefault () {
    return this.attribute.defaultValue !== null && this.attribute.defaultValue !== undefined && this.attribute.defaultValue === this.value
  }

  isInteger () {
    return !isNaN(parseInt(this.value))
  }

  isString () {
    return String(this.value).length > 0
  }

  validateRequired () {
    if (!!this.settings.required && this.isEmpty()) {
      const validationError = i18n.t('validation.required', {
        attribute: this.attribute.attributeName
      })
      return this.setResponse(validationError, false)
    }

    return this.setResponse('', true)
  }

  validateValueMax () {
    if (this.settings.valueMax) {
      if (!this.isInteger()) {
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
      if (!this.isInteger()) {
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
      if (!this.isString() && !this.isArray()) {
        const validationError = i18n.t('validation.string', {
          attribute: this.attribute.attributeName
        })
        return this.setResponse(validationError, false)
      }
      if ((this.isArray() ? this.value.length : String(this.value).length) < parseInt(this.settings.lengthMin)) {
        const validationError = this.isArray() ? i18n.t('validation.min.array', {
          attribute: this.attribute.attributeName,
          min: this.settings.lengthMin
        }) : i18n.t('validation.min.array', {
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
      if (!this.isString() && !this.isArray()) {
        const validationError = i18n.t('validation.string', {
          attribute: this.attribute.attributeName
        })
        return this.setResponse(validationError, false)
      }

      if ((this.isArray() ? this.value.length : String(this.value).length) > parseInt(this.settings.lengthMax)) {
        const validationError = this.isArray() ? i18n.t('validation.max.string', {
          attribute: this.attribute.attributeName,
          max: this.settings.lengthMax
        }) : i18n.t('validation.max.array', {
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
      errorMessage: message,
      status: status
    }
    return status
  }
}

export default new AttributeValidator()

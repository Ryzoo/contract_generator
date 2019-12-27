import i18n from './../lang'

class validation {
  constructor (elements) {
    this.elements = elements
    this.currentName = null
    this.current = null
  }

  get (name) {
    this.currentName = name
    this.current = this.elements[name]
    return this
  }

  returnError (errorText) {
    window.Notify.push(errorText, window.notify.ERROR, 4000)
    // eslint-disable-next-line no-throw-literal
    throw 'validate failed'
  }

  isTrue () {
    this.isNotNull()
    const re = !!this.current
    if (re !== true) {
      this.returnError(i18n.t('validation.required', { attribute: this.currentName }))
    }
    return this
  }

  isBetween (min, max) {
    this.isNotNull()

    const re = parseInt(this.current)

    if (re === null || re === undefined) {
      this.returnError(i18n.t('validation.numeric', { attribute: this.currentName }))
    }

    if (!(re >= min && re <= max)) {
      this.returnError(i18n.t('validation.between.numeric', { attribute: this.currentName, min: min, max: max }))
    }
    return this
  }

  isPhone () {
    this.isOnlyNumber(8, 14)
    return this
  }

  isEmail () {
    this.isString()
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    if (!re.test(this.current.toLowerCase())) {
      this.returnError(
        i18n.t('validation.email', { attribute: this.currentName })
      )
    }
    return this
  }

  sameAs (comparedProp) {
    this.isString()
    if (this.elements[comparedProp] !== this.current) {
      this.returnError(
        i18n.t('validation.same', { attribute: this.currentName, other: comparedProp })
      )
    }
    return this
  }

  isNotNull () {
    if (this.current === null || this.current.length === 0) {
      this.returnError(i18n.t('validation.required', { attribute: this.currentName }))
    }
    return this
  }

  isString () {
    this.isNotNull()
    const ret = typeof this.current === 'string'
    if (!ret) {
      this.returnError(i18n.t('validation.string', { attribute: this.currentName }))
    }
    return this
  }

  length (min = 0, max = null) {
    this.isString()
    let ret = this.current.length >= min
    if (max && ret) {
      ret = this.current.length <= max
    }
    if (!ret) {
      this.returnError(i18n.t('validation.between.string', { attribute: this.currentName, min: min, max: max }))
    }
    return this
  }
}

export default validation

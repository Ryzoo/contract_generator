import i18n from "./../lang";

class validation {
  constructor(elements) {
    this.elements = elements;
    this.currentName = null;
    this.current = null;
  }

  get(name) {
    this.currentName = name;
    this.current = this.elements[name];
    return this;
  }

  returnError(errorText) {
    window.notify.push(errorText, window.notify.ERROR , 4000);
    throw "validate failed";
  }

  isTrue() {
    this.isNotNull();
    const re = !!this.current;
    if (re !== true) {
      this.returnError(i18n.t('validation.required',{attribute: this.currentName}));
    }
    return this;
  }

  isOnlyNumber(min, max) {
    this.isString();
    const re = /^[0-9\+]{8,13}$/;

    let ret = this.current.length >= min;
    if (max && ret) {
      ret = this.current.length <= max;
    }

    if (!re.test(this.current.toLowerCase()) || !ret) {
      this.returnError(i18n.t('validation.between.numeric',{attribute: this.currentName, min: min, max: max}));
    }
    return this;
  }

  isPhone() {
    this.isOnlyNumber(8, 14);
    return this;
  }

  isEmail() {
    this.isString();
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!re.test(this.current.toLowerCase())) {
      this.returnError(
          i18n.t('validation.email',{attribute: this.currentName})
      );
    }
    return this;
  }

  isNotNull() {
    if (this.current === null || this.current.length === 0) {
      this.returnError(i18n.t('validation.required',{attribute: this.currentName}));
    }
    return this;
  }

  isString() {
    this.isNotNull();
    let ret = typeof this.current === "string";
    if (!ret) {
      this.returnError(i18n.t('validation.string',{attribute: this.currentName}));
    }
    return this;
  }

  length(min = 0, max = null) {
    this.isString();
    let ret = this.current.length >= min;
    if (max && ret) {
      ret = this.current.length <= max;
    }
    if (!ret) {
      this.returnError(i18n.t('validation.between.string',{attribute: this.currentName, min: min, max: max}));
    }
    return this;
  }
}

export default validation;

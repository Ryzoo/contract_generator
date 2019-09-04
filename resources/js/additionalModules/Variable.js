class Variable extends HTMLElement {
  constructor() {
    super();
    this._somePara = null;
  }

  static get observedAttributes() { return ["somepara"]; }

  attributeChangedCallback(name, oldValue, newValue) {
    // name will always be "country" due to observedAttributes
    this._somePara = newValue;
    this._updateRendering();
  }
  connectedCallback() {
    this._updateRendering();
  }

  get country() {
    return this._somePara;
  }
  set country(v) {
    this.setAttribute("somepara", v);
  }

  _updateRendering() {
    // Left as an exercise for the reader. But, you'll probably want to
    // check this.ownerDocument.defaultView to see if we've been
    // inserted into a document with a browsing context, and avoid
    // doing any work if not.
  }
}

customElements.define('variable', Variable);
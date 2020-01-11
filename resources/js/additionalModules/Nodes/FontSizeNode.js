import { Mark } from 'tiptap'
import { markInputRule, updateMark, removeMark } from 'tiptap-commands'

export default class FontSizeNode extends Mark {
  get name () {
    return 'fontSize'
  }

  get schema () {
    return {
      attrs: { fontSize: { default: '1em' } },
      parseDOM: [{
        style: 'font-size',
        getAttrs: value => value.indexOf('em') !== -1 ? { fontSize: value } : ''
      }],
      toDOM: mark => ['span', { style: `font-size: ${mark.attrs.fontSize}` }, 0]
    }
  }

  commands ({ type }) {
    return attrs => {
      if ((attrs.fontSize) && (attrs.fontSize !== '1em')) {
        return updateMark(type, attrs)
      }
      return removeMark(type)
    }
  }

  inputRules ({ type }) {
    return [markInputRule(/(?:\*\*|__)([^*_]+)(?:\*\*|__)$/, type)]
  }
}

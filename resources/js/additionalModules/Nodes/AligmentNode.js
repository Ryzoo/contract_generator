import { updateMark, removeMark, markInputRule } from 'tiptap-commands'
import { Mark } from 'tiptap'

export default class Align extends Mark {
  get name () {
    return 'align'
  }

  get schema () {
    return {
      attrs: {
        textAlign: {
          default: 'left'
        },
        oldValue: {
          default: ''
        }
      },
      parseDOM: [
        {
          style: 'text-align',
          getAttrs: value => ({ textAlign: value })
        }
      ],
      toDOM: mark => ['span', { style: `text-align: ${mark.attrs.textAlign};display: block` }, 0]
    }
  }

  commands ({ type }) {
    return attrs => attrs.textAlign === attrs.oldValue ? removeMark(type) : updateMark(type, attrs)
  }

  inputRules ({ type }) {
    return [
      markInputRule(/(?:\*\*|__)([^*_]+)(?:\*\*|__)$/, type)
    ]
  }
}

import { wrappingInputRule, updateMark, removeMark, markInputRule } from 'tiptap-commands'
import { Mark } from 'tiptap'

export default class ParagraphListNode extends Mark {
  get name () {
    return 'paragraph_list'
  }

  get schema () {
    return {
      toDOM: mark => ['span', { class: 'paragraph-list' }, 0]
    }
  }

  commands ({ type }) {
    return attrs => updateMark(type, attrs)
  }

  inputRules ({ type }) {
    return [
      wrappingInputRule(
        /^(§)\s$/,
        type,
        match => ({ order: +match[1] }),
        (match, node) => node.childCount + node.attrs.order === +match[1]
      )
    ]
  }
}

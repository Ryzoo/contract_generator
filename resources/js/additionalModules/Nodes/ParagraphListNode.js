import { updateMark, removeMark } from 'tiptap-commands'
import { Mark } from 'tiptap'

export default class ParagraphListNode extends Mark {
  get name () {
    return 'paragraph_list'
  }

  get schema () {
    return {
      parseDOM: [
        { tag: 'span.paragraph-list' }
      ],
      toDOM: mark => ['span', { class: 'paragraph-list' }, ['span', { class: 'paragraph-counter' }, 0]]
    }
  }

  commands ({ type }) {
    return attrs => {
      if ($(attrs.target).parent().hasClass('is-active')) {
        return removeMark(type)
      }
      return updateMark(type, attrs)
    }
  }
}

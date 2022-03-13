import { Mark } from '@tiptap/core'

export const ParagraphListNode = Mark.create({
  name: 'paragraphList',

  addOptions () {
    return {
      HTMLAttributes: {}
    }
  },

  parseHTML () {
    return [
      { tag: 'span.paragraph-list' }
    ]
  },

  renderHTML () {
    return ['span', { class: 'paragraph-list' }, ['span', { class: 'paragraph-counter' }, 0]]
  },

  addCommands () {
    return {
      setParagraph: () => ({ commands }) => {
        return commands.setMark(this.name)
      },
      toggleParagraph: () => ({ commands }) => {
        return commands.toggleMark(this.name)
      },
      unsetParagraph: () => ({ commands }) => {
        return commands.unsetMark(this.name)
      }
    }
  }
})

export default ParagraphListNode

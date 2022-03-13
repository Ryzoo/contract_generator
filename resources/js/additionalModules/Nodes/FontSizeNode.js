import { Extension } from '@tiptap/core'
import '@tiptap/extension-text-style'

export const FontSizeNode = Extension.create({
  name: 'fontSize',

  defaultOptions: {
    types: ['textStyle']
  },

  addGlobalAttributes () {
    return [
      {
        types: this.options.types,
        attributes: {
          fontSize: {
            default: null,
            parseHTML: element => element.style.fontSize,
            renderHTML: attributes => {
              if (!attributes.fontSize) {
                return {}
              }

              return {
                style: `font-size: ${attributes.fontSize}`
              }
            }
          }
        }
      }
    ]
  },

  addCommands () {
    return {
      setFontSize: fontSize => ({ chain }) => {
        return chain()
          .setMark('textStyle', { fontSize })
          .run()
      },
      unsetFontSize: () => ({ chain }) => {
        return chain()
          .setMark('textStyle', { fontSize: null })
          .removeEmptyTextStyle()
          .run()
      }
    }
  }
})

export default FontSizeNode

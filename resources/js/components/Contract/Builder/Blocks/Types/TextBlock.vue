<template>
  <section class="block-details">
    <div v-if="editor">
      <div class="menubar-container">
        <div class="menubar">
          <button
            class="menubar-button"
            :class="{ 'is-active': editor.isActive('bold') }"
            @click="editor.chain().focus().toggleBold().run()"
          >
            <v-icon small>fa-bold</v-icon>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': editor.isActive('italic') }"
            @click="editor.chain().focus().toggleItalic().run()"
          >
            <v-icon small>fa-italic</v-icon>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': editor.isActive('code') }"
            @click="editor.chain().focus().toggleCode().run()"
          >
            <v-icon small>fa-code</v-icon>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': editor.isActive('underline') }"
            @click="editor.chain().focus().toggleUnderline().run()"
          >
            <v-icon small>fa-underline</v-icon>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': editor.isActive('blockquote') }"
            @click="editor.chain().focus().toggleBlockquote().run()"
          >
            <v-icon small>fa-quote-right</v-icon>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': editor.isActive('bulletList') }"
            @click="editor.chain().focus().toggleBulletList().run()"
          >
            <v-icon small>fa-list-ul</v-icon>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': editor.isActive('orderedList') }"
            @click="editor.chain().focus().toggleOrderedList().run()"
          >
            <v-icon small>fa-list-ol</v-icon>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': editor.isActive({ textAlign: 'left' }) }"
            @click="editor.chain().focus().setTextAlign('left').run()"
          >
            <v-icon small>fa-align-left</v-icon>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': editor.isActive({ textAlign: 'center' }) }"
            @click="editor.chain().focus().setTextAlign('center').run()"
          >
            <v-icon small>fa-align-center</v-icon>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': editor.isActive({ textAlign: 'right' }) }"
            @click="editor.chain().focus().setTextAlign('right').run()"
          >
            <v-icon small>fa-align-right</v-icon>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': editor.isActive({ textAlign: 'justify' }) }"
            @click="editor.chain().focus().setTextAlign('justify').run()"
          >
            <v-icon small>fa-align-justify</v-icon>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }"
            @click="editor.chain().focus().toggleHeading({ level: 1 }).run()"
          >
            <span class="text-icon">H1</span>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }"
            @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
          >
            <span class="text-icon">H2</span>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }"
            @click="editor.chain().focus().toggleHeading({ level: 3 }).run()"
          >
            <span class="text-icon">H3</span>
          </button>

          <button
              class="menubar-button"
              :class="{ 'is-active': editor.isActive('subscript') }"
              @click="editor.chain().focus().toggleSubscript().run()"
          >
            <v-icon small>fa-subscript</v-icon>
          </button>

          <button
              class="menubar-button"
              :class="{ 'is-active': editor.isActive('superscript') }"
              @click="editor.chain().focus().toggleSuperscript().run()"
          >
            <v-icon small>fa-superscript</v-icon>
          </button>

          <button
            class="menubar-button paragraph-button"
            :class="{ 'is-active': editor.isActive('paragraphList') }"
            @click="editor.chain().focus().toggleParagraph().run()"
          >
            <span class="text-icon">§</span>
          </button>

<!--          <v-combobox-->
<!--            class="fontsize-selector"-->
<!--            v-model="selectedSize"-->
<!--            :items="fontSizes"-->
<!--            color="white"-->
<!--            dark-->
<!--            hide-details-->
<!--            placeholder="Select font size"-->
<!--            dense-->
<!--            filled-->
<!--            outlined-->
<!--            @change="editor.chain().focus().setFontSize(selectedSize).run()"-->
<!--            @blur="editor.chain().focus().setFontSize(selectedSize).run()"-->
<!--          ></v-combobox>-->

        </div>
      </div>
    </div>
    <editor-content class="editor-container" :editor="editor"/>
  </section>
</template>

<script>
import { Editor, EditorContent, VueRenderer } from '@tiptap/vue-2'
import Fuse from 'fuse.js'
import tippy from 'tippy.js'
import Document from '@tiptap/extension-document'
import Text from '@tiptap/extension-text'
import Blockquote from '@tiptap/extension-blockquote'
import BulletList from '@tiptap/extension-bullet-list'
import CodeBlock from '@tiptap/extension-code-block'
import HardBreak from '@tiptap/extension-hard-break'
import Heading from '@tiptap/extension-heading'
import ListItem from '@tiptap/extension-list-item'
import OrderedList from '@tiptap/extension-ordered-list'
import Bold from '@tiptap/extension-bold'
import Code from '@tiptap/extension-code'
import Italic from '@tiptap/extension-italic'
import Underline from '@tiptap/extension-underline'
import Mention from '@tiptap/extension-mention'
import History from '@tiptap/extension-history'
import Paragraph from '@tiptap/extension-paragraph'
import Alignment from '@tiptap/extension-text-align'
import Subscript from '@tiptap/extension-subscript'
import Superscript from '@tiptap/extension-superscript'
import ParagraphList from '../../../../../additionalModules/Nodes/ParagraphListNode'
import FontSize from '../../../../../additionalModules/Nodes/FontSizeNode'
import SuggestionList from '../../../../common/SuggestionList'

export default {
  name: 'TextBlock',
  props: ['block', 'nestedVariables'],
  components: {
    EditorContent
  },
  data () {
    return {
      actualText: '',
      keepInBounds: true,
      editor: null,
      query: null,
      suggestionRange: null,
      filteredVariables: [],
      fontSizes: [8, 10, 12, 14, 16, 18, 20, 24, 36],
      selectedSize: 0,
      navigatedVariableIndex: 0,
      observer: null,
      variableSuggestions: this.variableUpdated || []
    }
  },
  watch: {
    variableUpdated: {
      deep: true,
      handler () {
        this.variableSuggestions = this.variableUpdated
      }
    },
    block: {
      deep: true,
      handler (newValue) {
        if (this.editor && this.actualText !== newValue.content.text) {
          this.editor.commands.setContent(this.parseBlockContent(newValue))
        }
      }
    }
  },
  computed: {
    hasResults () {
      return this.filteredVariables.length
    },
    variableUpdated () {
      return ((this.nestedVariables ? this.nestedVariables : this.$store.getters.builder_allVariables_defaultText) || []).map(x => ({
        id: x.id,
        name: x.attributeName
      }))
    }
  },
  mounted () {
    this.$store.dispatch('builder_blockUpdateContent', {
      id: this.block.id,
      content: {
        text: this.block.content.text || ''
      }
    })
    this.initEditor()
  },
  methods: {
    initEditor () {
      const self = this
      this.editor = new Editor({
        extensions: [
          Document,
          Paragraph,
          Text,
          Blockquote,
          BulletList,
          CodeBlock,
          HardBreak,
          Heading.configure({ levels: [1, 2, 3] }),
          ListItem,
          OrderedList,
          Bold,
          Code,
          Italic,
          Underline,
          History,
          Subscript,
          Superscript,
          Mention.configure({
            HTMLAttributes: {
              class: 'mention'
            },
            suggestion: {
              items: ({ query }) => {
                if (!query.length) {
                  return this.variableUpdated
                }

                const fuse = new Fuse(this.variableUpdated, {
                  keys: ['name']
                })

                return fuse.search(query).map(x => x.item)
              },
              render: () => {
                let component
                let popup

                return {
                  onStart: props => {
                    component = new VueRenderer(SuggestionList, {
                      parent: this,
                      propsData: props
                    })

                    popup = tippy('body', {
                      getReferenceClientRect: props.clientRect,
                      appendTo: () => document.body,
                      content: component.element,
                      showOnCreate: true,
                      interactive: true,
                      trigger: 'manual',
                      placement: 'bottom-start'
                    })
                  },

                  onUpdate (props) {
                    component.updateProps(props)

                    popup[0].setProps({
                      getReferenceClientRect: props.clientRect
                    })
                  },

                  onKeyDown (props) {
                    if (props.event.key === 'Escape') {
                      popup[0].hide()

                      return true
                    }

                    return component.ref ? component.ref.onKeyDown(props) : null
                  },

                  onExit (props) {
                    const html = props.editor.getHTML()
                    const element = $(`<div>${html}</div>`)

                    this.actualText = `${element.prop('innerHTML')}`

                    self.$store.dispatch('builder_blockUpdateContent', {
                      id: self.block.id,
                      content: {
                        text: `${element.prop('innerHTML')}`
                      }
                    })

                    popup[0].destroy()
                    component.destroy()
                  }
                }
              }
            },
            renderLabel ({ options, node }) {
              return `${options.suggestion.char}${node.attrs.label || node.attrs.id + '-Unnamed'}`
            }
          }),
          ParagraphList,
          Alignment.configure({
            types: ['heading', 'paragraph'],
            alignments: ['left', 'center', 'right']
          }),
          FontSize
        ],
        parseOptions: {
          preserveWhitespace: true
        },
        content: this.parseBlockContent(this.block),
        useBuiltInExtensions: true,
        onUpdate: ({ editor }) => {
          const html = editor.getHTML()
          const element = $(`<div>${html}</div>`)
          element.find('.mention').each(function () {
            $(this).replaceWith(`{${$(this).attr('data-id')}}`)
          })
          this.actualText = `${element.prop('innerHTML')}`
          this.$store.dispatch('builder_blockUpdateContent', {
            id: this.block.id,
            content: {
              text: `${element.prop('innerHTML')}`
            }
          })
        }
      })
    },
    parseBlockContent (block) {
      let text = block.content.text

      if (block.content.text !== null) {
        const matches = [...block.content.text.matchAll(/{(\d+)}|{(\d+:(counter|value|number|currency|words|\d+))}|{(\d+:\d+:(words|currency|number))}/gm)]
        matches.forEach((match) => {
          const id = match[1] || match[2] || match[4]
          const variable = this.variableUpdated.find((x) => x.id.toString() === id.toString())
          if (variable) text = text.replace(`{${id}}`, `<span class="mention variable" data-type="mention" data-id='${id}' data-label='${variable.name}' contenteditable="false">@${variable.name}</span>`)
        })
      }
      return text === null ? '' : text
    }
  },
  beforeUnmount () {
    const html = this.editor.getHTML()
    const element = $(`<div>${html}</div>`)

    element.find('.mention').each(function () {
      $(this).replaceWith(`{${$(this).attr('data-id')}}`)
    })
    this.actualText = `${element.prop('innerHTML')}`

    this.$store.dispatch('builder_blockUpdateContent', {
      id: this.block.id,
      content: {
        text: `${element.prop('innerHTML')}`
      }
    })

    if (this.editor) { this.editor.destroy() }
  }
}
</script>

<style lang="scss">
  @import "./../../../../../../sass/colors";

  .paragraph-button {
    padding: 0;

    span {
      padding: 7px;
    }
  }

  .fontsize-selector {
    max-width: 100px;
    align-items: center;
    padding: 7px;
  }

  .text-icon {
    font-weight: bold;
    font-size: 16px;
  }

  .menubar-container {
    position: relative;
    transition: 0.3s;
    width: 100%;

    .menubar {
      margin: 0 10px;
      display: flex;
      padding: 7px;
      justify-content: left;
      background: $primary;
      color: white;
      border-radius: 5px;
      flex-wrap: wrap;

      .menubar-button {
        padding: 7px;

        &.is-active {
          background: #2d3f86;
        }

        i {
          color: white;
        }
      }
    }
  }

  .suggestion-list {
    padding: 1.2rem;
    font-size: 14px;
    font-weight: bold;
    background: rgba(64, 89, 190, 0.3);
    border-radius: 16px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    border: 1px solid rgba(64, 89, 190, 0.4);
    font-family: Roboto,sans-serif;

    &__no-results {
      padding: 0.2rem 0.5rem;
    }

    &__item {
      border-radius: 5px;
      padding: 0.2rem 0.5rem;
      margin-bottom: 0.2rem;
      cursor: pointer;

      &:last-child {
        margin-bottom: 0;
      }

      &.is-selected,
      &:hover {
        background-color: rgba(64, 89, 190, 0.5);
      }
      &.is-empty {
        opacity: 0.5;
      }
    }
  }

  .tippy-box[data-theme~=dark] {
    background-color: black;
    padding: 0;
    font-size: 1rem;
    text-align: inherit;
    color: white;
    border-radius: 5px;
  }

  .editor-container {
    border: 2px solid #cfcfcf;
    border-radius: 5px;
    margin: 0 10px 10px;

    .ProseMirror{
      height: 100%;
    }
  }

  h1 {
    font-size: 36px;
    line-height: 40px;
  }

  h2 {
    font-size: 30px;
    line-height: 40px;
  }

  h3 {
    font-size: 24px;
    line-height: 40px;
  }

  h4 {
    font-size: 18px;
    line-height: 20px;
  }

  /* Won't be used here */

  h5 {
    font-size: 14px;
    line-height: 20px;
  }

  h6 {
    font-size: 12px;
    line-height: 20px;
  }

</style>

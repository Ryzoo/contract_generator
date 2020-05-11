<template>
  <section class="block-details">
    <editor-menu-bar
      :editor="editor"
      v-slot="{ commands, isActive, getMarkAttrs }"
    >
      <div class="menubar-container">
        <div class="menubar">
          <button
            class="menubar-button"
            :class="{ 'is-active': isActive.bold() }"
            @click="commands.bold"
          >
            <v-icon small>fa-bold</v-icon>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': isActive.italic() }"
            @click="commands.italic"
          >
            <v-icon small>fa-italic</v-icon>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': isActive.code() }"
            @click="commands.code"
          >
            <v-icon small>fa-code</v-icon>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': isActive.underline() }"
            @click="commands.underline"
          >
            <v-icon small>fa-underline</v-icon>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': isActive.blockquote() }"
            @click="commands.blockquote"
          >
            <v-icon small>fa-quote-right</v-icon>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': isActive.bullet_list() }"
            @click="commands.bullet_list"
          >
            <v-icon small>fa-list-ul</v-icon>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': isActive.ordered_list() }"
            @click="commands.ordered_list"
          >
            <v-icon small>fa-list-ol</v-icon>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': getMarkAttrs('align').textAlign === 'left' }"
            @click="commands.align({ textAlign: 'left', oldValue: getMarkAttrs('align').textAlign })"
          >
            <v-icon small>fa-align-left</v-icon>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': getMarkAttrs('align').textAlign === 'center' }"
            @click="commands.align({ textAlign: 'center', oldValue: getMarkAttrs('align').textAlign })"
          >
            <v-icon small>fa-align-center</v-icon>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': getMarkAttrs('align').textAlign === 'right' }"
            @click="commands.align({ textAlign: 'right', oldValue: getMarkAttrs('align').textAlign })"
          >
            <v-icon small>fa-align-right</v-icon>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': getMarkAttrs('align').textAlign === 'justify' }"
            @click="commands.align({ textAlign: 'justify', oldValue: getMarkAttrs('align').textAlign })"
          >
            <v-icon small>fa-align-justify</v-icon>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': isActive.heading({ level: 1 }) }"
            @click="commands.heading({ level: 1 })"
          >
            <span class="text-icon">H1</span>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': isActive.heading({ level: 2 }) }"
            @click="commands.heading({ level: 2 })"
          >
            <span class="text-icon">H2</span>
          </button>

          <button
            class="menubar-button"
            :class="{ 'is-active': isActive.heading({ level: 3 }) }"
            @click="commands.heading({ level: 3 })"
          >
            <span class="text-icon">H3</span>
          </button>

          <button
            class="menubar-button paragraph-button"
            :class="{ 'is-active': isActive.paragraph_list() }"
            @click="commands.paragraph_list"
          >
            <span class="text-icon">§</span>
          </button>

          <v-combobox
            class="fontsize-selector"
            v-model="selectedSize"
            :items="fontSizes"
            color="white"
            dark
            hide-details
            placeholder="Select font size"
            dense
            filled
            outlined
            @change="commands.fontSize({fontSize:selectedSize + 'px'})"
            @blur="commands.fontSize({fontSize:selectedSize + 'px'})"
          ></v-combobox>

        </div>
      </div>
    </editor-menu-bar>
    <editor-content class="editor-container" :editor="editor"/>

    <div class="suggestion-list" v-show="showSuggestions" ref="suggestions">
      <template v-if="hasResults">
        <div
          v-for="(variable, index) in filteredVariables"
          :key="variable.id"
          class="suggestion-list__item"
          :class="{ 'is-selected': navigatedVariableIndex === index }"
          @click="selectVariable(variable)"
        >
          {{ variable.name }}
        </div>
      </template>
      <div v-else class="suggestion-list__item is-empty">
        No variables found
      </div>
    </div>
  </section>
</template>

<script>
import { Editor, EditorContent, EditorMenuBar } from 'tiptap'
import Fuse from 'fuse.js'
import tippy from 'tippy.js'
import {
  Blockquote,
  BulletList,
  CodeBlock,
  HardBreak,
  Heading,
  ListItem,
  OrderedList,
  TodoItem,
  TodoList,
  Bold,
  Code,
  Italic,
  Link,
  Strike,
  Underline,
  Mention,
  History
} from 'tiptap-extensions'
import ParagraphList from '../../../../../additionalModules/Nodes/ParagraphListNode'
import Aligment from '../../../../../additionalModules/Nodes/AligmentNode'
import FontSize from '../../../../../additionalModules/Nodes/FontSizeNode'

export default {
  name: 'ListItemBlock',
  props: ['block', 'nestedVariables'],
  components: {
    EditorContent,
    EditorMenuBar
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
      insertMention: () => {},
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
          this.editor.setContent(this.parseBlockContent(newValue))
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
    },
    showSuggestions () {
      return this.query || this.hasResults
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
      this.editor = new Editor({
        extensions: [
          new Blockquote(),
          new BulletList(),
          new CodeBlock(),
          new HardBreak(),
          new Heading({ levels: [1, 2, 3] }),
          new ListItem(),
          new OrderedList(),
          new TodoItem(),
          new TodoList(),
          new Link(),
          new Bold(),
          new Code(),
          new Italic(),
          new Strike(),
          new Underline(),
          new History(),
          new Mention({
            items: () => this.variableUpdated,
            onEnter: ({ items, query, range, command, virtualNode }) => {
              this.query = query
              this.filteredVariables = items
              this.suggestionRange = range
              this.renderPopup(virtualNode)
              this.insertMention = command
            },
            onChange: ({ items, query, range, virtualNode }) => {
              this.query = query
              this.filteredVariables = items
              this.suggestionRange = range
              this.navigatedVariableIndex = 0
              this.renderPopup(virtualNode)
            },
            onExit: () => {
              this.query = null
              this.filteredVariables = []
              this.suggestionRange = null
              this.navigatedVariableIndex = 0
              this.destroyPopup()
            },
            onKeyDown: ({ event }) => {
              if (event.keyCode === 38) {
                this.upHandler()
                return true
              }
              if (event.keyCode === 40) {
                this.downHandler()
                return true
              }
              if (event.keyCode === 13) {
                this.enterHandler()
                return true
              }
              return false
            },
            onFilter: (items, query) => {
              if (!query.length) {
                return items
              }
              const fuse = new Fuse(items, {
                keys: ['name']
              })
              return fuse.search(query)
            }
          }),
          new ParagraphList(),
          new Aligment(),
          new FontSize()
        ],
        parseOptions: {
          preserveWhitespace: true
        },
        content: this.parseBlockContent(this.block),
        onUpdate: ({ getHTML }) => {
          const html = getHTML()
          const element = $(`<div>${html}</div>`)
          const styles = '<style>.paragraph-list{display: block; text-align: center;}.paragraph-list:before{content:"§"} div ol{counter-reset:section;list-style-type:none}div ol li:before{counter-increment:section;content:counters(section, ".") ". "}div ol li>p{display:inline}</style>'

          element.find('.mention').each(function () {
            $(this).replaceWith(`{${$(this).attr('data-mention-id')}}`)
          })

          this.actualText = `${styles} ${element.prop('innerHTML')}`
          this.$store.dispatch('builder_blockUpdateContent', {
            id: this.block.id,
            content: {
              text: `${styles} ${element.prop('innerHTML')}`
            }
          })
        },
        useBuiltInExtensions: true
      })
    },
    parseBlockContent (block) {
      let text = block.content.text

      if (block.content.text !== null) {
        const matches = [...block.content.text.matchAll(/{(\d+)}|{(\d+:\d+)}/gm)]
        matches.forEach((match) => {
          const id = match[1] || match[2]
          const variable = this.variableUpdated.find((x) => x.id == id)
          if (variable) text = text.replace(`{${id}}`, `<span class="mention variable" data-mention-id='${id}' contenteditable="false">@${variable.name}</span>`)
        })
      }
      return text === null ? '' : text
    },
    upHandler () {
      this.navigatedVariableIndex = ((this.navigatedVariableIndex + this.filteredVariables.length) - 1) % this.filteredVariables.length
    },
    downHandler () {
      this.navigatedVariableIndex = (this.navigatedVariableIndex + 1) % this.filteredVariables.length
    },
    enterHandler () {
      const variable = this.filteredVariables[this.navigatedVariableIndex]
      if (variable) {
        this.selectVariable(variable)
      }
    },
    selectVariable (variable) {
      this.insertMention({
        range: this.suggestionRange,
        attrs: {
          id: variable.id,
          label: variable.name
        }
      })
      this.editor.focus()
    },
    renderPopup (node) {
      if (this.popup) {
        return
      }
      this.popup = tippy(node, {
        content: this.$refs.suggestions,
        trigger: 'mouseenter',
        interactive: true,
        theme: 'dark',
        placement: 'top-start',
        inertia: true,
        duration: [400, 200],
        showOnInit: true,
        arrow: true,
        arrowType: 'round'
      })
      if (MutationObserver) {
        this.observer = new MutationObserver(() => {
          this.popup.popperInstance.scheduleUpdate()
        })
        this.observer.observe(this.$refs.suggestions, {
          childList: true,
          subtree: true,
          characterData: true
        })
      }
    },
    destroyPopup () {
      if (this.popup) {
        this.popup.destroy()
        this.popup = null
      }
      if (this.observer) {
        this.observer.disconnect()
      }
    }
  },
  beforeDestroy () {
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
    padding: 0.2rem;
    border: 2px solid rgba(#2a272f, 0.1);
    font-size: 0.8rem;
    font-weight: bold;

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
        background-color: rgba(#fff, 0.2);
      }

      &.is-empty {
        opacity: 0.5;
      }
    }
  }

  .tippy-tooltip.dark-theme {
    background-color: #2a272f;
    padding: 0;
    font-size: 1rem;
    text-align: inherit;
    color: #fff;
    border-radius: 5px;

    .tippy-backdrop {
      display: none;
    }

    .tippy-roundarrow {
      fill: #2a272f;
    }

    .tippy-popper[x-placement^=top] & .tippy-arrow {
      border-top-color: #2a272f;
    }

    .tippy-popper[x-placement^=bottom] & .tippy-arrow {
      border-bottom-color: #2a272f;
    }

    .tippy-popper[x-placement^=left] & .tippy-arrow {
      border-left-color: #2a272f;
    }

    .tippy-popper[x-placement^=right] & .tippy-arrow {
      border-right-color: #2a272f;
    }
  }

  .editor-container {
    border: 2px solid #cfcfcf;
    border-radius: 5px;
    margin: 0 10px 10px;

    .ProseMirror {
      padding: 10px 10px 0;
      margin-bottom: -18px;
      min-height: 100px;
    }

    ol {
      counter-reset: section;
      list-style-type: none;
    }

    li:before {
      counter-increment: section;
      content: counters(section, ".") " ";
    }
  }

</style>

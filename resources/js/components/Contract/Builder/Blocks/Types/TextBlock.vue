<template>
  <section class="block-details">
    <editor-menu-bubble
      :editor="editor"
      :keep-in-bounds="keepInBounds"
      v-slot="{ commands, isActive, menu }"
    >
      <div
        class="menububble-container"
        :class="{ 'is-active': menu.isActive }"
        :style="`left: ${menu.left}px; bottom: ${menu.bottom}px;`"
      >
        <div class="menububble">
          <button
            class="menububble-button"
            :class="{ 'is-active': isActive.bold() }"
            @click="commands.bold"
          >
            <v-icon>fa-bold</v-icon>
          </button>

          <button
            class="menububble-button"
            :class="{ 'is-active': isActive.italic() }"
            @click="commands.italic"
          >
            <v-icon>fa-italic</v-icon>
          </button>

          <button
            class="menububble-button"
            :class="{ 'is-active': isActive.code() }"
            @click="commands.code"
          >
            <v-icon>fa-code</v-icon>
          </button>
        </div>
      </div>
    </editor-menu-bubble>
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
import { Editor, EditorContent, EditorMenuBubble } from 'tiptap'
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
import Variable from '../../../../../additionalModules/Nodes'

export default {
  name: 'TextBlock',
  props: ['block'],
  components: {
    EditorContent,
    EditorMenuBubble
  },
  data () {
    return {
      keepInBounds: true,
      editor: null,
      query: null,
      suggestionRange: null,
      filteredVariables: [],
      navigatedVariableIndex: 0,
      insertMention: () => {
      },
      observer: null,
      variableSuggestions: this.mapAttributesList()
    }
  },
  mounted () {
    this.initEditor()
  },
  watch: {
    variableUpdated: {
      deep: true,
      handler () {
        this.variableSuggestions = this.mapAttributesList()
      }
    }
  },
  computed: {
    hasResults () {
      return this.filteredVariables.length
    },
    showSuggestions () {
      return this.query || this.hasResults
    },
    variableUpdated () {
      return this.$store.getters.builder_allVariables
    }
  },
  methods: {
    initEditor () {
      this.variableSuggestions = this.mapAttributesList()
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
            items: () => this.variableSuggestions,
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
              if (!query) {
                return items
              }
              const fuse = new Fuse(items, {
                threshold: 0.2,
                keys: ['name']
              })
              return fuse.search(query)
            }
          }),
          new Variable()
        ],
        parseOptions: {
          preserveWhitespace: true
        },
        content: this.parseBlockContent(this.block),
        onUpdate: ({ getHTML }) => {
          const html = getHTML()
          const element = $(`<div>${html}</div>`)

          element.find('.mention').each(function () {
            $(this).replaceWith(`{${$(this).attr('data-mention-id')}}`)
          })

          this.$store.dispatch('builder_blockUpdateContent', {
            id: this.block.id,
            content: {
              text: element.prop('innerHTML')
            }
          })
        },
        useBuiltInExtensions: true
      })
    },
    parseBlockContent (block) {
      let text = block.content.text

      if (block.content.text !== null) {
        const matches = block.content.text.split('{')
          .filter((v) => v.indexOf('}') > -1)
          .map((value) => parseInt(value.split('}')[0]))

        matches.forEach((id) => {
          text = text.replace(`{${id}}`, `<span class="mention variable" data-mention-id='${id}' contenteditable="false">@${this.variableSuggestions.find((x) => x.id === id).name}</span>`)
        })
      }
      return text
    },
    mapAttributesList () {
      return this.$store.getters.builder_allVariables.map(x => ({
        id: x.id,
        name: x.attributeName
      }))
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
    this.editor.destroy()
  }
}
</script>

<style lang="scss" scoped>
  .menububble-container {
    position: absolute;
    transition: 0.3s;
    opacity: 0;
    z-index: 3;

    &.is-active {
      opacity: 1;
    }

    .menububble {
      width: max-content;
      display: flex;
      justify-content: center;
      background: linear-gradient(to bottom, #3d3646 0%, #2a272f 100%);
      color: white;
      border-radius: 5px;

      .menububble-button {
        padding: 10px;

        i {
          color: white;
        }
      }
    }
  }

  .mention {
    background: rgba(#2a272f, 0.1);
    color: rgba(#2a272f, 0.6);
    font-size: 0.8rem;
    font-weight: bold;
    border-radius: 5px;
    padding: 0.2rem 0.5rem;
    white-space: nowrap;
  }

  .mention-suggestion {
    color: rgba(#2a272f, 0.6);
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
    border-radius: 10px;
    padding: 10px 15px;
    margin: 10px;
  }
</style>

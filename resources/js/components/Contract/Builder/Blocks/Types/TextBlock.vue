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
                    <button
                        class="menububble-button"
                        :class="{ 'is-active': isActive.code() }"
                        @click="commands.variable"
                    >
                        <v-icon>fa-code</v-icon>
                    </button>
                </div>
            </div>
        </editor-menu-bubble>
        <editor-content :editor="editor"/>

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
  import {Editor, EditorContent, EditorMenuBubble} from "tiptap";
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
  } from "tiptap-extensions";
  import Variable from "../../../../../additionalModules/Nodes";

  export default {
    name: "TextBlock",
    props: ["block"],
    components: {
      EditorContent,
      EditorMenuBubble
    },
    data() {
      return {
        keepInBounds: true,
        editor: null,
        query: null,
        suggestionRange: null,
        filteredVariables: [],
        navigatedVariableIndex: 0,
        insertMention: () => {},
        observer: null,
      };
    },
    mounted() {
        this.editor = new Editor({
        extensions: [
          new Blockquote(),
          new BulletList(),
          new CodeBlock(),
          new HardBreak(),
          new Heading({levels: [1, 2, 3]}),
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
            items: () => this.mapAttributesList(),
            onEnter: ({ items, query, range, command, virtualNode }) => {
                this.query = query;
                this.filteredVariables = items;
                this.suggestionRange = range;
                this.renderPopup(virtualNode);
                this.insertMention = command
            },
              onChange: ({ items, query, range, virtualNode }) => {
                  this.query = query;
                  this.filteredVariables = items;
                  this.suggestionRange = range;
                  this.navigatedVariableIndex = 0;
                  this.renderPopup(virtualNode)
              },
              onExit: () => {
                  this.query = null;
                  this.filteredVariables = [];
                  this.suggestionRange = null;
                  this.navigatedVariableIndex = 0;
                  this.destroyPopup()
              },
              onKeyDown: ({ event }) => {
                  if (event.keyCode === 38) {
                      this.upHandler();
                      return true
                  }
                  if (event.keyCode === 40) {
                      this.downHandler();
                      return true
                  }
                  if (event.keyCode === 13) {
                      this.enterHandler();
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
                      keys: ['name'],
                  });
                  return fuse.search(query)
              },
          }),
          new Variable()
        ],
        content: this.block.content.text,
          onUpdate: ({ getHTML }) => {
            this.block.content.text = getHTML();
          },
        useBuiltInExtensions: true,

      });
    },
    computed: {
      hasResults() {
          return this.filteredVariables.length
      },
      showSuggestions() {
          return this.query || this.hasResults
      },
    },
    methods:{
      mapAttributesList() {
        const attributesList = this.$store.getters.builder_allVariables;
        const items = [];

        attributesList.forEach((attribute) => {
          items.push({
              id: attribute.id,
              name: attribute.attributeName
          })
        });

          return items;
      },
      upHandler() {
          this.navigatedVariableIndex = ((this.navigatedVariableIndex + this.filteredVariables.length) - 1) % this.filteredVariables.length
      },
      downHandler() {
          this.navigatedVariableIndex = (this.navigatedVariableIndex + 1) % this.filteredVariables.length
      },
      enterHandler() {
          const variable = this.filteredVariables[this.navigatedVariableIndex]
          if (variable) {
              this.selectVariable(variable)
          }
      },
      selectVariable(variable) {
          this.insertMention({
              range: this.suggestionRange,
              attrs: {
                  id: variable.id,
                  label: variable.name,
              },
          })
          this.editor.focus()
      },
      renderPopup(node) {
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
              arrowType: 'round',
          })
          if (MutationObserver) {
              this.observer = new MutationObserver(() => {
                  this.popup.popperInstance.scheduleUpdate()
              })
              this.observer.observe(this.$refs.suggestions, {
                  childList: true,
                  subtree: true,
                  characterData: true,
              })
          }
      },
      destroyPopup() {
          if (this.popup) {
              this.popup.destroy()
              this.popup = null
          }
          if (this.observer) {
              this.observer.disconnect()
          }
      },
    },
    beforeDestroy() {
        this.editor.destroy();
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
</style>

<template>
    <section>
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
    </section>
</template>

<script>
  import {Editor, EditorContent, EditorMenuBubble} from "tiptap";
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
        editor: null
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
          new Variable()
        ],
        content: this.block.content.text,
        useBuiltInExtensions: true
      });
    },
    beforeDestroy() {
      this.editor.destroy();
    }
  };
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

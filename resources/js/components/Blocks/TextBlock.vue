<template>
    <div class="block">
        <details draggable="true" @dragstart="onDragStart($event)" @dragover='onDragOver($event)' @drop='onDrop($event)'>
            <summary>
                <v-icon class="mx-3">fa-chevron-right</v-icon>
                <h3 class="pr-2">{{ content.text | truncate}}</h3>
            </summary>
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
            <editor-content :editor="editor" />
            <div class="hr-line">
                <hr class="line">
                <v-btn @click="$emit('openDialog')" class="mx-3" text icon>
                    <v-icon>fa-plus-circle</v-icon>
                </v-btn>
            </div>
            <slot></slot>
        </details>
        <div class="hr-line">
            <hr class="line">
            <v-btn @click="$emit('openDialog')" class="mx-3" text icon>
                <v-icon>fa-plus-circle</v-icon>
            </v-btn>
        </div>
    </div>
</template>

<script>
import { Editor, EditorContent, EditorMenuBubble } from "tiptap";
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
import Variable from "../../additionalModules/Nodes";

export default {
    name: "Block",
    props: {
        content: { required: true },
        conditionals: { required: true },
        settings: { required: true }
    },
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
    methods: {
      onDragStart(event) {
        event.dataTransfer.setData('text/plain', event.target.id);
      },
      onDragOver(event) {
        event.preventDefault();
      },
      onDrop(event) {
        const id = event.dataTransfer.getData('text');
        const draggableElement = document.getElementById(id);
        const dropzone = event.target;

        dropzone.appendChild(draggableElement);
        event.dataTransfer.clearData();
      }
    },
    mounted() {
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
                new Variable()
            ],
            content: this.content.text,
            useBuiltInExtensions: true
        });
    },
    beforeDestroy() {
        this.editor.destroy();
    }
};
</script>

<style lang="scss" scoped>
@import "../../../sass/colors";

details {
    padding: 10px 0;
    border: 1px solid $primary;
    border-radius: 5px;
    transition: all 0.3s;
    position: relative;
    &:hover {
        cursor: pointer;
    }
    &[open] {
        &:hover {
            border: 4px solid $primary;
            box-shadow: 0px 3px 6px 0px $primary;
        }
        & > summary {
            border-bottom: 1px solid $primary;
            padding-bottom: 10px;

            i {
                transform: rotate(90deg);
            }
        }
        & > *:not(:first-child) {
            padding: 0 15px;
            margin-top: 16px;
        }
    }
    summary {
        display: flex;
        align-items: center;
        text-transform: capitalize;
        svg {
            transition: all 0.2s;
        }
        &:focus {
            outline: none;
        }
    }
}

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

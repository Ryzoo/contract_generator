<template>
  <v-row>
    <v-col sm="12" class="builder-content block-zone" v-drag-and-drop:options="options">
        <ContainerBlock
          v-for="(block, index) in filterParentBlocks"
          :block="block"
          @show-block-modal="showBlockModal"
          :key="block.id"
          :divider="block.isDivider"
          :blockIndex="index"
        />
    </v-col>
  </v-row>
</template>

<script>
export default {
  name: 'BlockLayout',
  data: function () {
    return {
      options: {
        dropzoneSelector: '.block-zone',
        draggableSelector: '.block-draggable',
        handlerSelector: null,
        reactivityEnabled: true,
        multipleDropzonesItemsDraggingEnabled: true,
        showDropzoneAreas: true,
        onDrop: this.dragBlock,
          onDragover: this.dragBlockOver,
      },
        blockIdWhereToDrag: {
          id: 0,
            prev: false
        }
    }
  },
  computed: {
    filterParentBlocks () {
      const filteredBlocks = this.blocks.filter(x => !x.parentId)
      const obj = { isDivider: true }
      const arr = [
        obj
      ]

      filteredBlocks.map(x => {
        arr.push(x)
        arr.push(obj)
      })

      return arr
    },
    blocks () {
      return this.$store.getters.builder_allBlocks
    }
  },
  methods: {
    dragBlock (event) {
      let draggedBlockId = parseInt($(event.nativeEvent.target.children[0]).attr("blockid"))
        this.$store.dispatch('builder_setDraggedBlock', { draggedBlockId, blockIdWhereToDrag: this.blockIdWhereToDrag })
    },
      dragBlockOver (event) {
        if ($(event.nativeEvent.target).next()[0].children[0].hasAttribute("blockid")) {
            let block = $(event.nativeEvent.target).next()[0].children[0]

            this.blockIdWhereToDrag.id = parseInt($(block).attr("blockid"))
            this.blockIdWhereToDrag.prev = false
        }

        if ($(event.nativeEvent.target).prev()[0].children[0].hasAttribute("blockid")) {
            let block = $(event.nativeEvent.target).prev()[0].children[0]

            this.blockIdWhereToDrag.id = parseInt($(block).attr("blockid"))
            this.blockIdWhereToDrag.prev = true
        }
      },
    showBlockModal () {
      this.$emit('show-block-modal')
    },
    setHighestBlockId (blocks = this.blocks) {
      let blockId = this.$store.getters.builder_getBlockId

      blocks.forEach((block) => {
        if (block.id > blockId) {
          blockId = block.id
          this.$store.dispatch('builder_setIdBlockIncrement', blockId)
        }

        if (typeof block.content.blocks !== 'undefined' && block.content.blocks.length > 0) {
          this.setHighestBlockId(block.content.blocks)
          blockId = this.$store.getters.builder_getBlockId
        }
      })

      this.$store.dispatch('builder_setIdBlockIncrement', blockId)
    },
    setHighestVariableId (variables = this.$store.getters.builder_allVariables) {
      let variableId = this.$store.getters.builder_getVariableId

      variables.forEach((variable) => {
        if (variable.id > variableId) {
          variableId = variable.id
        }
      })

      this.$store.dispatch('builder_setIdVariableIncrement', variableId)
      this.$store.dispatch('builder_idVariableIncrement')
    }
  },
  mounted () {
    this.setHighestBlockId()
    this.setHighestVariableId()
  }
}
</script>

<style lang="scss">
</style>

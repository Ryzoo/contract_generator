<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12" id="builder-content" data-id="0">
        <ContainerBlock
          v-for="(block, index) in filterParentBlocks"
          :block="block"
          @show-block-modal="showBlockModal"
          :key="block.id"
          :level="0"
          :divider="block.isDivider"
          :blockIndex="index"
        />
      </v-col>
      <AddBlockDialog :level="0"/>
    </v-row>
  </v-container>
</template>

<script>
import AddBlockDialog from './Blocks/AddBlockDialog'

export default {
  name: 'BlockLayout',
  components: {
    AddBlockDialog
  },
  computed: {
    filterParentBlocks () {
      return this.blocks.filter(x => !x.parentId)
    },
    blocks () {
      return this.$store.getters.builder_allBlocks
    }
  },
  methods: {
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
    window.DragService.initDrag('builder-content', this.$store)
  }
}
</script>

<style lang="scss">
</style>

<template>
  <v-row>
    <v-col sm="12" class="builder-content">
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
    return {}
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
        if (typeof variable.content !== 'undefined' && variable.content.length > 0) {
          this.setHighestVariableId()
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

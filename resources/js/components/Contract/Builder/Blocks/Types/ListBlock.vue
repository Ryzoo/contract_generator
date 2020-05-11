<template>
  <v-row class="ma-0 pa-0">
    <v-col cols="12"  class="block-details">
      <section :id="'block-content-'+block.id" :data-id="block.id">
        <ContainerBlock
          v-for="(fBlock, index) in filterParentBlocks"
          :block="fBlock"
          :key="fBlock.id"
          :divider="fBlock.isDivider"
          :level="block.id"
          :blockIndex="index"
          :nested-variables="nestedVariables"
          @show-block-modal="showBlockModal"
        />
      </section>
      <AddBlockDialog :level="block.id" :list-only="true"/>
    </v-col>
  </v-row>
</template>

<script>
import AddBlockDialog from '../AddBlockDialog'

export default {
  name: 'ListBlock',
  components: {
    AddBlockDialog
  },
  props: ['block', 'level', 'nestedVariables'],
  computed: {
    filterParentBlocks () {
      return this.block.content.blocks
    }
  },
  methods: {
    showBlockModal () {
      this.$emit('show-block-modal')
    }
  },
  mounted () {
    window.DragService.initDrag('block-content-' + this.block.id, this.$store)
  }
}
</script>

<style scoped lang="scss">
  .block-details {
    & > section {
      padding: 15px;
    }
    padding: 0;
    background: #f4f4f4;
  }
</style>

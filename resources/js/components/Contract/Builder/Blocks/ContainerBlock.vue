<template>
  <div
    :class="currentBlock.id > 1 ? 'block' : 'block ignore-elements'"
    :blockid="currentBlock.id">
    <div class="accordion-header" :data-id="0">
      <BlockHeader
        @show-block-modal="showBlockModal"
        :block="currentBlock"
        :nested-variables="nestedVariables"
      />
      <component
        class="block-content-in"
        :nested-variables="nestedVariables"
        :is="Mapper.getBlockName(currentBlock.blockType)"
        :block="currentBlock"
        :in-list="inList"
        @show-block-modal="showBlockModal"
      />
    </div>
  </div>
</template>

<script>
import TextBlock from './Types/TextBlock'
import EmptyBlock from './Types/EmptyBlock'
import PageDivideBlock from './Types/PageDivideBlock'
import RepeatBlock from './Types/RepeatBlock'
import ListBlock from './Types/ListBlock'
import ListItemBlock from './Types/ListItemBlock'
import BlockHeader from './BlockHeader'
import { BlockTypeEnum } from '../../../../additionalModules/Enums'
import AddBlockDialog from './AddBlockDialog'

export default {
  name: 'ContainerBlock',
  components: {
    AddBlockDialog,
    BlockHeader,
    TextBlock,
    EmptyBlock,
    PageDivideBlock,
    RepeatBlock,
    ListItemBlock,
    ListBlock
  },
  props: [
    'block', 'divider', 'level', 'blockIndex', 'nestedVariables', 'inList'
  ],
  data () {
    return {
      BlockTypeEnum: BlockTypeEnum,
      currentBlock: this.block
    }
  },
  methods: {
    showBlockModal () {
      this.$emit('show-block-modal')
    }
  },
  watch: {
    block (newValue) {
      this.currentBlock = newValue
      this.$forceUpdate()
    }
  }
}
</script>

<style lang="scss" scoped>
  .block {
    margin: 8px;
  }
</style>

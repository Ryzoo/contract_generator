<template>
  <div
    class="block"
    :blockid="currentBlock.id">
    <div class="accordion-header" :data-id="0">
      <BlockHeader
        v-if="currentBlock.blockType !== BlockTypeEnum.PAGE_DIVIDE_BLOCK"
        @show-block-modal="showBlockModal"
        :block="currentBlock"
      />
      <component
        :is="Mapper.getBlockName(currentBlock.blockType)"
        :block="currentBlock"
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
    RepeatBlock
  },
  props: {
    block: { required: true },
    divider: {},
    level: {},
    blockIndex: {}
  },
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
    // isPageBreaker () {
    //   return this.block.blockType === BlockTypeEnum.PAGE_DIVIDE_BLOCK
    // }
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

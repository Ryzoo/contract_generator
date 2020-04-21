<template>
  <section>
    <div
      class="block"
      :blockid="currentBlock.id"
      v-if="!divider && !isPageBreaker()">

      <div class="accordion-header">
        <BlockHeader
          @show-block-modal="showBlockModal"
          :block="currentBlock"
        />
        <component
          :is="Mapper.getBlockName(currentBlock.blockType)"
          :block="currentBlock"
          :level="level ? level : 0"
          @show-block-modal="showBlockModal"
        />
      </div>

    </div>
    <div v-else-if="isPageBreaker()" class="block" :blockid="block.id">
      <component
              :is="Mapper.getBlockName(currentBlock.blockType)"
              :block="currentBlock"
              :level="level ? level : 0"
              @show-block-modal="showBlockModal"
      />
    </div>
    <AddBlockDialog
      v-else
      :buttonIndex="blockIndex"
      :block="currentBlock"
      :level="level ? level : 0"/>
  </section>
</template>

<script>
import TextBlock from './Types/TextBlock'
import EmptyBlock from './Types/EmptyBlock'
import PageDivideBlock from './Types/PageDivideBlock'
import RepeatBlock from './Types/RepeatBlock'
import AddBlockDialog from './AddBlockDialog'
import BlockHeader from './BlockHeader'
import { BlockTypeEnum } from '../../../../additionalModules/Enums'

export default {
  name: 'ContainerBlock',
  components: {
    BlockHeader,
    TextBlock,
    EmptyBlock,
    PageDivideBlock,
    RepeatBlock,
    AddBlockDialog
  },
  props: {
    block: { required: true },
    divider: {},
    level: {},
    blockIndex: {}
  },
  data () {
    return {
      currentBlock: this.block
    }
  },
  methods: {
    showBlockModal () {
      this.$emit('show-block-modal')
    },
    isPageBreaker () {
      return this.block.blockType === BlockTypeEnum.PAGE_DIVIDE_BLOCK
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

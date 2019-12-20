<template>
  <section>
    <div
      class="block"
      :blockid="block.id"
      v-if="!divider && !isPageBreaker()">

      <div class="accordion-header">
        <BlockHeader
          @show-block-modal="showBlockModal"
          :block="block"
        />
        <component
          :is="Mapper.getBlockName(block.blockType)"
          :block="block"
          :level="level ? level : 0"
        />
      </div>

    </div>
    <div v-else-if="isPageBreaker()" class="block" :blockid="block.id">
      <component
              :is="Mapper.getBlockName(block.blockType)"
              :block="block"
              :level="level ? level : 0"
      />
    </div>
    <AddBlockDialog
      v-else
      :buttonIndex="blockIndex"
      :block="block"
      :level="level ? level : 0"/>
  </section>
</template>

<script>
  import TextBlock from "./Types/TextBlock";
  import EmptyBlock from "./Types/EmptyBlock";
  import PageDivideBlock from "./Types/PageDivideBlock";
  import AddBlockDialog from "./AddBlockDialog";
  import BlockHeader from "./BlockHeader";
  import {BlockTypeEnum} from "../../../../additionalModules/Enums";

  export default {
    name: "ContainerBlock",
    components: {
      BlockHeader,
      TextBlock,
      EmptyBlock,
      PageDivideBlock,
      AddBlockDialog
    },
    props: {
      block: {required: true},
      divider: {},
      level: {},
      blockIndex: {}
    },
    methods: {
      showBlockModal() {
        this.$emit("show-block-modal")
      },
      isPageBreaker() {
        return this.block.blockType === BlockTypeEnum.PAGE_DIVIDE_BLOCK
      }
    }
  }
</script>

<style lang="scss" scoped>
  .block {
    margin: 8px;
  }
</style>

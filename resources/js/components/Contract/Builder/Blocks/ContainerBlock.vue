<template>
  <div
    :class="currentBlock.id > 1 ? 'block' : 'block ignore-elements'"
    :blockid="currentBlock.id"
  >
    <div class="accordion-header" :data-id="0">
      <BlockHeader
        @show-block-modal="showBlockModal"
        @show-block-content="showBlockContent"
        @hide-block-content="hideBlockContent"
        :block="currentBlock"
        :nested-variables="nestedVariables"
      />
      <component
        v-if="isOpened || Mapper.getBlockComponentByName(currentBlock.blockType) === 'PageDivideBlock'"
        class="block-content-in"
        :nested-variables="nestedVariables"
        :is="Mapper.getBlockComponentByName(currentBlock.blockType)"
        :block="currentBlock"
        :in-list="inList"
        @show-block-modal="showBlockModal"
      />
    </div>
  </div>
</template>

<script>
import TextBlock from "./Types/TextBlock";
import EmptyBlock from "./Types/EmptyBlock";
import PageDivideBlock from "./Types/PageDivideBlock";
import RepeatBlock from "./Types/RepeatBlock";
import ListBlock from "./Types/ListBlock";
import BlockHeader from "./BlockHeader";
import { BlockTypeEnum } from "../../../../additionalModules/Enums";

export default {
  name: "ContainerBlock",
  components: {
    BlockHeader,
    TextBlock,
    EmptyBlock,
    PageDivideBlock,
    RepeatBlock,
    ListBlock,
  },
  props: [
    "block",
    "divider",
    "level",
    "blockIndex",
    "nestedVariables",
    "inList",
  ],
  data() {
    return {
      BlockTypeEnum: BlockTypeEnum,
      currentBlock: this.block,
      isOpened: false,
    };
  },
  methods: {
    showBlockModal() {
      this.$emit("show-block-modal");
    },
    showBlockContent() {
      this.isOpened = true;
    },
    hideBlockContent() {
      this.isOpened = false;
    },
  },
  watch: {
    block(newValue) {
      this.currentBlock = newValue;
      this.$forceUpdate();
    },
  },
};
</script>

<style lang="scss" scoped>
.block {
  margin: 8px;
}
</style>

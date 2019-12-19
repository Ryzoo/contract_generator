<template>
  <section>
    <div
      class="block"
      :blockid="block.id"
      v-if="!divider">

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
  import AddBlockDialog from "./AddBlockDialog";
  import BlockHeader from "./BlockHeader";

  export default {
    name: "ContainerBlock",
    components: {
      BlockHeader,
      TextBlock,
      EmptyBlock,
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
    }
  }
</script>

<style lang="scss" scoped>
  .block {
    margin: 8px;
  }
</style>

<template>
  <section>
    <div
      class="block"
      :blockid="currentBlock.id"
      v-if="!divider">

      <div class="accordion-header">
        <BlockHeader
          @show-block-modal="showBlockModal"
          :block="currentBlock"
        />
        <component
          :is="Mapper.getBlockName(currentBlock.blockType)"
          :block="currentBlock"
          :level="level ? level : 0"
        />
      </div>

    </div>
    <AddBlockDialog
      v-else
      :buttonIndex="blockIndex"
      :block="currentBlock"
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
    data(){
      return {
        currentBlock: this.block
      }
    },
    methods: {
      showBlockModal() {
        this.$emit("show-block-modal")
      },
    },
    watch:{
      block(newValue){
        this.currentBlock = newValue;
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

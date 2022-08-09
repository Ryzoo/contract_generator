<template>
  <v-row class="ma-0 pa-0">
    <v-col cols="12" class="block-details">
      <section :id="'block-content-' + block.id" :data-id="block.id">
        <ContainerBlock
          v-for="(fBlock, index) in filterParentBlocks"
          :block="fBlock"
          :key="fBlock.id"
          :divider="fBlock.isDivider"
          :level="block.id"
          :blockIndex="index"
          @show-block-modal="showBlockModal"
          :nested-variables="getVariablesForRepeatBlocks"
        />
      </section>
      <AddBlockDialog :level="block.id" />
    </v-col>
  </v-row>
</template>

<script>
import AddBlockDialog from "../AddBlockDialog";

export default {
  name: "RepeatBlock",
  components: {
    AddBlockDialog,
  },
  props: ["block", "level", "nestedVariables"],
  computed: {
    filterParentBlocks() {
      return this.block.content.blocks;
    },
    getVariablesForRepeatBlocks() {
      return this.$store.getters.builder_variablesForRepeatBlock(
        this.block.id,
        this.nestedVariables
      );
    },
  },
  methods: {
    showBlockModal() {
      this.$emit("show-block-modal");
    },
  },
  mounted() {
    window.DragService.initDrag("block-content-" + this.block.id, this.$store);
  },
};
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

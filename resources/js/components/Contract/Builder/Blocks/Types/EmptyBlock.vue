<template>
    <section class="block-details">
        <ContainerBlock
            v-for="(fBlock, index) in filterParentBlocks"
            :block="fBlock"
            :key="fBlock.id"
            :divider="fBlock.isDivider"
            :level="block.id"
            :blockIndex="index"
        >
        </ContainerBlock>
    </section>
</template>

<script>
  export default {
    name: "EmptyBlock",
    props: ["block", "level"],
    computed: {
      filterParentBlocks() {
        let filteredBlocks = this.block.content.blocks;
        let obj = {isDivider: true};
        let arr = [
          obj,
        ];

        filteredBlocks.map(x => {
          arr.push(x);
          arr.push(obj);
        });

        return arr;
      }
    }
  }
</script>

<style scoped>

</style>

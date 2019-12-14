<template>
  <v-row>
    <v-col sm="12" class="builder-content">
      <ContainerBlock
        v-for="(block, index) in filterParentBlocks"
        :block="block"
        :key="block.id"
        :divider="block.isDivider"
        :blockIndex="index"
      >
      </ContainerBlock>
    </v-col>
  </v-row>
</template>

<script>
  export default {
    name: "BlockLayout",
    data: function () {
      return {}
    },
    computed: {
      filterParentBlocks() {
        let filteredBlocks = this.blocks.filter(x => !x.parentId);
        let obj = {isDivider: true};
        let arr = [
          obj,
        ];

        filteredBlocks.map(x => {
          arr.push(x);
          arr.push(obj);
        });

        return arr;
      },
      blocks() {
        return this.$store.getters.builder_allBlocks;
      }
    },
    methods: {
      blocksCategoryToSelect(categories) {
        let arrayOfCategories = [];

        categories.map(x => arrayOfCategories.push(x.name));

        return arrayOfCategories;
      },
      setHighestBlockId(blocks = this.blocks) {
        let blockId = this.$store.getters.builder_getBlockId;

        blocks.forEach((block) => {
          if (block.id > blockId) {
            blockId = block.id;
            this.$store.dispatch('builder_setIdBlockIncrement', blockId);
          }

          if (typeof block.content.blocks !== 'undefined' && block.content.blocks.length > 0) {
            this.setHighestBlockId(block.content.blocks)
            blockId = this.$store.getters.builder_getBlockId;
          }
        });

        this.$store.dispatch('builder_setIdBlockIncrement', blockId);
      },
      setHighestVariableId(variables = this.$store.getters.builder_allVariables) {
        let variableId = this.$store.getters.builder_getVariableId;

        variables.forEach((variable) => {
          if (variable.id > variableId) {
            variableId = variable.id;
          }
          if (typeof variable.content !== 'undefined' && variable.content.length > 0) {
            this.setHighestVariableId()
          }
        });

        console.log(variableId)

        this.$store.dispatch('builder_setIdVariableIncrement', variableId);
      },
    },
    mounted() {
      this.setHighestBlockId();
      this.setHighestVariableId();
    }
  }
</script>

<style lang="scss">
</style>

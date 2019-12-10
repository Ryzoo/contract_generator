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
      return {
      }
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
        setHighestBlockId() {
          let blockId = this.$store.getters.builder_getBlockId;

            this.blocks.map((block) => {
                if (block.id > blockId) {
                    blockId = block.id;

                    if (typeof block.content.blocks != 'undefined' && block.content.blocks.length > 0) {
                        setHighestBlockId()
                    }
                }
            });

            this.$store.dispatch('builder_setIdBlockIncrement', blockId);
        },
        setHighestVariableId() {
            const variables = this.$store.getters.builder_allVariables;
            let variableId = this.$store.getters.builder_getVariableId;

            variables.map((variable) => {
                if (variable.id > variableId) {
                    variableId = variable.id;

                    if (typeof variable.content != 'undefined' && variable.content.length > 0) {
                        setHighestVariableId()
                    }
                }
            });

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

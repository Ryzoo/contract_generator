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
        blocksCategory: [
          {
            name: "Kategoria 1",
            blocks: [
              {
                name: "bloczek"
              }
            ]
          },
          {
            name: "Kategoria 2",
            blocks: [
              {
                name: "bloczek2"
              }
            ]
          }
        ],
      }
    },
    computed: {
      filterParentBlocks() {
          console.log(this.blocks);
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
          console.log(this.$store.getters.builder_allBlocks);
        return this.$store.getters.builder_allBlocks;
      }
    },
    methods: {
      blocksCategoryToSelect(categories) {
        let arrayOfCategories = [];

        categories.map(x => arrayOfCategories.push(x.name));

        return arrayOfCategories;
      },
    },
    mounted() {
      this.categoriesNames = this.blocksCategoryToSelect(this.blocksCategory);
    }
  }
</script>

<style lang="scss">
    details[open] > *:not(:first-child) {
        box-sizing: border-box;
    }

    details[open] > summary i {
        transform: rotate(0deg) !important;
        transition: all .2s;

        &:hover {
            color: #d4ac71 !important;
        }
    }

    details[open] > summary .block-header--icon i {
        transform: rotate(90deg) !important;
    }
</style>

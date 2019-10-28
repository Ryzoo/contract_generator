<template>
    <div>
        <div class="hr-line" v-if="$store.getters.allBlocks.length > 0">
            <hr class="line">
            <v-btn @click="addBlockDialog = true" class="mx-3" text icon>
                <v-icon>fa-plus-circle</v-icon>
            </v-btn>
        </div>
        <div v-else class="empty-elements">
            <v-btn @click="addBlockDialog = true" tile outlined color="primary">
                <span>Dodaj blok</span>
                <v-icon class="mx-3">fa-plus-circle</v-icon>
            </v-btn>
        </div>

        <v-dialog ref="newBlockDialog" v-model="addBlockDialog" max-width="900">
            <v-card>
                <v-card-title class="headline justify-center" primary-title>
                    Nowy blok
                </v-card-title>
                <v-card-text>
                    <v-flex class="new-block-container">
                        <!--<v-text-field v-model="newBlock.blockName" label="Nazwa" outline></v-text-field>-->
                        <!--<v-select-->
                            <!--v-model="newBlock.blockType"-->
                            <!--:items="blockTypes"-->
                            <!--label="Typ bloku"-->
                            <!--outline-->
                        <!--&gt;-->
                        <!--</v-select>-->

                        <div class="builder-elements">
                            <div @click="addBlock(block.value)" class="options" v-for="block in blockTypes">
                                <span>{{block.text}}</span>
                            </div>
                        </div>
                    </v-flex>
                </v-card-text>
            </v-card>
        </v-dialog>
    </div>

</template>

<script>
  import Selector from "../../additionalModules/StaticSelectors";

  export default {
    name: "AddBlockDialog",
    props: ["level", "buttonIndex"],
    data () {
      return {
        addBlockDialog: false,
        blockTypes: Selector.BlockType,
        newBlock: {
          id: 1,
          parentId: this.level,
          blockName: "",
          blockType: "",
          content: {
            blocks: []
          },
          conditionals: [],
          settings: {},
        }
      }
    },
    methods: {
      addBlock(blockType) {
        this.newBlock.blockType = blockType;

        if (this.newBlock.blockType === 0)
          this.newBlock.content = { text: "" };

        this.newBlock.id = this.$store.getters.getId;
        this.$store.dispatch('block_idIncrement');

        // let newBlock = {
        //   id:1+this.parentBlockId,
        //   parentId: this.parentBlockId,
        //   blockName: this.blockName,
        //   blockType: this.selectedBlockType,
        //   content: blockContent,
        //   conditionals: [],
        //   settings: {},
        // };

        let blocks = this.$store.getters.allBlocks;
        console.log(blocks);

        if (blocks.length > 0 && this.newBlock.parentId !== 0)
            blocks = this.addNewBlockToCurrentBlocks(blocks, this.newBlock);
        else
          blocks.splice(this.buttonIndex/2, 0, this.newBlock);

        this.$store.dispatch('block_set', blocks);
        this.addBlockDialog = false;
        this.newBlock = this.resetBlock();
      },

      addNewBlockToCurrentBlocks(blocks, newBlock) {
        blocks.map(x => {
          if (x.id === newBlock.parentId) {
            x.content.blocks.push(newBlock);
          } else if (typeof x.content.blocks != 'undefined' && x.content.blocks.length > 0) {
            this.addNewBlockToCurrentBlocks(x.content.blocks, newBlock)
          }
        });

        return blocks;
      },

      resetBlock() {
        return {
          id: 0,
          parentId: this.level,
          blockName: "",
          blockType: undefined,
          content: {
            blocks: []
          },
          conditionals: [],
          settings: {},
        }
      }
    }
  }
</script>

<style lang="scss" scoped>
    .builder-content {
        .empty-elements {
            border: 1px dashed #707070;
            width: 100%;
            height: 100px;
            border-radius: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    }

    .new-block-container {
        .options {
            width: 150px;
            height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid #dabd79;
            color: #dabd79;

            &:hover {
                cursor: pointer;
            }
        }

        .builder-elements {
            padding: 15px 0;
            display: flex;
            justify-content: space-around;

            .select-options {
                width: 100%;
            }
        }
    }
</style>
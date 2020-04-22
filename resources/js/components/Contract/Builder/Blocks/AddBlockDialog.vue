<template>
  <div class="element-add-container">
    <div class="empty-elements">
      <v-btn @click="addBlockDialog = true" outlined color="primary">
        {{$t("pages.panel.contracts.builder.addBLock")}}
        <v-icon right small>fa-plus-circle</v-icon>
      </v-btn>
    </div>

    <v-dialog ref="newBlockDialog" v-model="addBlockDialog" max-width="600">
      <v-card>
        <v-card-title class="headline justify-center" primary-title>
          {{$t("pages.panel.contracts.builder.newBlock")}}
        </v-card-title>
        <v-card-text>
          <v-flex class="new-block-container">
            <div class="builder-elements">
              <div @click="addBlock(block.value)" class="options" v-for="block in blockTypes" :key="block.id">
                <span>{{block.text}}</span>
              </div>
            </div>
          </v-flex>
          <v-divider/>
          <v-row>
            <v-col>
              <v-alert
                dense
                text
                class="my-5"
                type="info"
              >
                {{$t("pages.panel.contracts.builder.noPartToReuse")}}
              </v-alert>
            </v-col>
          </v-row>
        </v-card-text>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import Selector from '../../../../additionalModules/StaticSelectors'
import { BlockTypeEnum } from '../../../../additionalModules/Enums'

export default {
  name: 'AddBlockDialog',
  props: ['level'],
  data () {
    return {
      addBlockDialog: false,
      blockTypes: this.level ? Selector.BlockType.filter(x => x.value !== BlockTypeEnum.PAGE_DIVIDE_BLOCK) : Selector.BlockType,
      newBlock: {
        id: 1,
        parentId: this.level,
        blockName: '',
        blockType: '',
        content: {
          blocks: []
        },
        conditionals: [],
        settings: {}
      }
    }
  },
  methods: {
    addBlock (blockType) {
      let blocks = this.$store.getters.builder_allBlocks

      this.$store.dispatch('builder_idBlockIncrement')
      this.newBlock.id = this.$store.getters.builder_getBlockId
      this.newBlock.blockType = blockType
      this.newBlock.blockName = `New block: ${this.newBlock.id}`

      switch (parseInt(this.newBlock.blockType)) {
        case BlockTypeEnum.TEXT_BLOCK:
          this.newBlock.content = { text: '' }
          break
        case BlockTypeEnum.PAGE_DIVIDE_BLOCK:
          this.newBlock.settings.isBreaker = false
          this.newBlock.blockName = 'Step'
          break
      }

      if (blocks.length > 0 && this.newBlock.parentId !== 0) {
        blocks = this.addNewBlockToCurrentBlocks(blocks, this.newBlock)
      } else {
        blocks.push(this.newBlock)
      }

      this.$store.dispatch('builder_set', blocks)
      this.addBlockDialog = false
      this.newBlock = this.resetBlock()
    },

    addNewBlockToCurrentBlocks (blocks, newBlock) {
      blocks = blocks.map(x => {
        if (x.id === newBlock.parentId) {
          x.content.blocks.push(this.newBlock)
        } else if (typeof x.content.blocks !== 'undefined' && x.content.blocks.length > 0) {
          x.content.blocks = this.addNewBlockToCurrentBlocks(x.content.blocks, newBlock)
        }
        return x
      })

      return blocks
    },

    resetBlock () {
      return {
        id: 0,
        parentId: this.level,
        blockName: '',
        blockType: undefined,
        content: {
          blocks: []
        },
        conditionals: [],
        settings: {}
      }
    }
  }
}
</script>

<style lang="scss" scoped>
  @import "./../../../../../sass/colors";

  .element-add-container {
    width: 100%;
  }

  .empty-elements {
    background: white;
    border-top: 1px dashed #4059be;
    padding-top: 10px;
    width: 100%;
    height: 47px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .new-block-container {
    .options {
      margin: 15px;
      width: 150px;
      height: 80px;
      display: flex;
      justify-content: center;
      align-items: center;
      background: $primary;
      border-radius: 10px;
      color: white;
      transition: all .2s;

      &:hover {
        cursor: pointer;
        background: $accent;
      }
    }

    .builder-elements {
      padding: 15px 0;
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;

      .select-options {
        width: 100%;
      }
    }
  }

  .hr-line {
    display: flex;
    align-items: center;

    i {
      color: $primary !important;
    }

    .line {
      border: none;
      border-top: 2px dashed #d5d5d5;
      margin-top: 20px;
      margin-bottom: 20px;
      width: 100%;
    }
  }
</style>

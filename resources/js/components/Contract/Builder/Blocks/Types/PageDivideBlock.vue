<template>
    <section>
        <div class="block-divider-line">Page divider</div>
      <v-btn @click="editBlock" class="mx-3" text icon>
        <v-icon>fa-edit</v-icon>
      </v-btn>
        <v-btn @click="removeBlock" class="mx-3" text icon>
            <v-icon>fa-trash</v-icon>
        </v-btn>
      <v-dialog
        v-model="divideBlockModal"
        scrollable
        max-width="800px">
        <v-card>
          <v-card-title>Settings</v-card-title>
          <v-card-text>
            <v-switch
              outlined
              hide-details
              dense
              v-model="isBreaker"
              label="Should be a page breaker?"
            ></v-switch>
          </v-card-text>
          <v-card-actions>
            <v-spacer/>
            <v-btn color="primary" outlined @click="cancelBlockConfiguration">Cancel</v-btn>
            <v-btn color="primary" @click="saveBlockConfiguration">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </section>
</template>

<script>
export default {
  name: 'PageDivideBlock',
  props: ['block'],
  data () {
    return {
      divideBlockModal: false,
      isBreaker: this.block.settings.isBreaker || false
    }
  },
  methods: {
    removeBlock () {
      const newBlocks = this.removeFromData(this.$store.getters.builder_allBlocks, this.block.id)
      this.$store.dispatch('builder_set', newBlocks)
    },
    saveBlockConfiguration () {
      this.block.settings.isBreaker = this.isBreaker
      this.$store.dispatch('builder_changeActiveBlock', this.block)
      this.divideBlockModal = false
    },
    cancelBlockConfiguration () {
      this.isBreaker = this.block.settings.isBreaker || false
      this.divideBlockModal = false
    },
    editBlock () {
      this.$store.dispatch('builder_setActiveBlock', this.block)
        .then(() => {
          this.$emit('show-block-modal')
        })
    },
    removeFromData (dataArray, idToRemove) {
      if (dataArray.find(x => x.id === idToRemove)) {
        return dataArray.filter(x => x.id !== idToRemove)
      } else {
        return dataArray.map(x => {
          if (x.content.blocks) {
            x.content.blocks = this.removeFromData(x.content.blocks, idToRemove)
          }
          return x
        })
      }
    }
  }
}
</script>

<style lang="scss" scoped>
    section {
        display: flex;
        align-items: center;

        .block-divider-line {
            display: flex;
            align-items: center;
            text-align: center;
            width: 100%;
            opacity: 0.3;

            &:before,
            &:after {
                content: '';
                flex: 1;
                border-bottom: 2px dashed #bbb;
            }

            &:before {
                margin-right: 10px;
            }

            &:after {
                margin-left: 10px;
            }
        }
    }
</style>

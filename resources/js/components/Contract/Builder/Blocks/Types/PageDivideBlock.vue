<template>
    <section>
        <div class="block-divider-line">Page divider</div>
        <v-btn @click="removeBlock" class="mx-3" text icon>
            <v-icon>fa-trash</v-icon>
        </v-btn>
    </section>
</template>

<script>
export default {
  name: 'PageDivideBlock',
  props: ['block'],
  methods: {
    removeBlock () {
      const newBlocks = this.removeFromData(this.$store.getters.builder_allBlocks, this.block.id)
      this.$store.dispatch('builder_set', newBlocks)
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

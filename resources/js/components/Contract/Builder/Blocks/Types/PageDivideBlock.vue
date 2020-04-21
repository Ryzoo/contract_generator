<template>
  <section>
    <div class="block-handle">
      <i class="fas fa-arrows-alt"></i>
    </div>
    <div class="block-divider-line">{{block.blockName}}</div>
    <v-btn small text color="primary" @click="editBlock"> Edit
      <v-icon small right>fa-edit</v-icon>
    </v-btn>
    <v-btn small text color="error" @click="removeBlock"> Delete
      <v-icon small right>fa-trash</v-icon>
    </v-btn>
  </section>
</template>

<script>
export default {
  name: 'PageDivideBlock',
  props: ['block', 'nestedVariables'],
  data () {
    return {
      divideBlockModal: false
    }
  },
  methods: {
    removeBlock () {
      this.$store.dispatch('builder_removeBlock', this.block.id)
    },
    editBlock () {
      this.$store.dispatch('builder_setActiveBlock', {
        block: this.block,
        nestedVariables: this.nestedVariables
      })
        .then(() => {
          this.$emit('show-block-modal')
        })
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

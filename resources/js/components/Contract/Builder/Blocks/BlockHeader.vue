<template>
  <!--    TODO: When click edit, right sidebar show up 2nd position-->
  <div class="block-header accordion-body">
    <div class="block-header--icon">
      <v-icon class="mx-3 rotate" @click="toggleBlock($event)">fa-chevron-right</v-icon>
    </div>
    <div class="block-header--content">
      <h3 class="pr-2">
        <div class="block-header--type">EMPTY BLOCK</div>
        {{ block.blockName | truncate}}
      </h3>
    </div>
    <div class="block-header--action">
      <v-icon class="mx-3" @click="editBlock()">fa-edit</v-icon>
      <v-icon class="mx-3" @click="removeBlock">fa-trash</v-icon>
    </div>
  </div>
</template>

<script>
export default {
  name: 'BlockHeader',
  props: ['block'],
  methods: {
    showBlockModal () {
    },
    editBlock () {
      this.$store.dispatch('builder_setActiveBlock', this.block)
        .then(() => {
          this.$emit('show-block-modal')
        })
    },
    toggleBlock (e) {
      e.target.closest('.accordion-header').classList.toggle('active')
    },
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

<style lang="scss">
  @import "../../../../../sass/colors.scss";

  .block-header {
    display: flex;

    &--content {
      flex: 1
    }

    &--type {
      color: #9a9a9a;
      font-weight: 600;
      font-size: 13px;
    }

    &--action i:hover {
      color: $primary;
    }
  }

  .accordion-header {
    padding: 10px 0;
    border: 1px solid $secondary;
    border-radius: 5px;
    transition: all 0.2s;
    position: relative;

    & > section.block-details {
      display: none;
    }

    &.active {
      border: 3px solid $primary;
      box-shadow: 0px 2px 3px 0px $primary;

      & > section.block-details {
        display: block;
      }

      & > .accordion-body {
        border-bottom: 1px solid $primary;
        padding-bottom: 10px;

        i.rotate {
          transform: rotate(90deg);
        }

        &:hover {
          cursor: pointer;
        }

      }

      & > *:not(:first-child) {
        padding: 0 15px;
        margin-top: 16px;
      }
    }

    .accordion-body {
      display: flex;
      align-items: center;
      text-transform: capitalize;

      svg {
        transition: all 0.2s;
      }

      &:focus {
        outline: none;
      }
    }

    .accordion-body::-webkit-details-marker {
      display: none;
    }
  }
</style>

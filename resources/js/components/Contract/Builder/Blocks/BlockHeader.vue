<template>
  <div :class="block.id > 1 ? '' : 'ignore-elements'" :data-id="block.id">
    <div class="block-header accordion-body"
         v-if="block.blockType !== BlockTypeEnum.PAGE_DIVIDE_BLOCK">
      <div class="block-handle">
        <i class="fas fa-arrows-alt"></i>
      </div>
      <div class="block-header--icon">
        <v-icon class="mx-3 rotate" @click="toggleBlock($event)">fa-chevron-right</v-icon>
      </div>
      <div class="block-header--content" @click="toggleBlock($event)">
        <div class="block-header--type">{{ toUpper(Mapper.getBlockName(block.blockType)) }}</div>
        <h5 class="pr-2">
          {{ block.blockName | truncate}}
        </h5>
      </div>
      <div class="block-header--action mr-4 text-right">
        <div v-if="block.blockType === BlockTypeEnum.REPEAT_BLOCK">
          <v-select
            persistent-hint
            :items="multiGroupAttributes"
            hint="Select attribute group with multi flag to repeat this block on it."
            dense
            outlined
            @change="updateMultiGroupAttribute"
            :value="{
              value: parseInt(currentMultiGroupAttribute)
            }"
            label="Repeat attribute"
          />
        </div>
        <div v-if="block.blockType === BlockTypeEnum.LIST_BLOCK">
          <v-select
            persistent-hint
            :items="listEnumerationType"
            hint="Select list enumeration type"
            dense
            outlined
            @change="updateListEnumeratorType"
            :value="{
              value: parseInt(currentListEnumeratorType)
            }"
            label="Enumeration type"
          />
        </div>
        <!--      <v-btn small text color="accent" @click="saveAsPart()"> Save as part <v-icon small right>fa-save</v-icon> </v-btn>-->
        <v-btn small text color="info" @click="copyBlock()"> Copy
          <v-icon small right>fa-copy</v-icon>
        </v-btn>
        <v-btn small text color="primary" @click="editBlock()"> Edit
          <v-icon small right>fa-edit</v-icon>
        </v-btn>
        <v-btn small text color="error" @click="deleteDialog=true"> Delete
          <v-icon small right>fa-trash</v-icon>
        </v-btn>
      </div>
      <v-dialog persistent v-model="deleteDialog" max-width="350">
        <v-card>
          <v-card-title class="headline">
            {{ $t("pages.panel.contracts.builder.removeBlockTitle") }}
          </v-card-title>
          <v-card-text>
            {{ $t("base.description.remove") }}
          </v-card-text>
          <v-card-actions>
            <div class="flex-grow-1"></div>
            <v-btn color="primary" text @click="deleteDialog = false">
              {{ $t("base.button.cancel") }}
            </v-btn>
            <v-btn color="error" @click="removeBlock">
              {{ $t("base.button.remove") }}
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
  </div>
</template>

<script>
import { BlockTypeEnum, ListEnumeratorType } from '../../../../additionalModules/Enums'

export default {
  name: 'BlockHeader',
  props: ['block', 'nestedVariables'],
  data () {
    return {
      listEnumerationType: [
        { text: 'Dot', value: ListEnumeratorType.DOT },
        { text: 'Decimal', value: ListEnumeratorType.DECIMAL },
        { text: 'Lover alpha', value: ListEnumeratorType.LOVER_ALPHA },
        { text: 'Upper Roman', value: ListEnumeratorType.UPPER_ROMAN }
      ],
      BlockTypeEnum: BlockTypeEnum,
      deleteDialog: false
    }
  },
  computed: {
    multiGroupAttributes () {
      return this.$store.getters.builder_multiGroupAttributes
        .filter(x => !x.settings.isInline)
        .map(x => ({
          text: x.attributeName,
          value: x.id
        }))
    },
    currentListEnumeratorType () {
      return this.$store.getters.builder_currentListEnumeratorType(this.block.id)
    },
    currentMultiGroupAttribute () {
      return this.$store.getters.builder_currentMultiGroupAttribute(this.block.id)
    }
  },
  methods: {
    updateListEnumeratorType (value) {
      this.$store.dispatch('builder_updateListEnumeratorType', {
        id: this.block.id,
        value: value
      })
    },
    updateMultiGroupAttribute (value) {
      this.$store.dispatch('builder_updateCurrentMultiGroupAttribute', {
        id: this.block.id,
        value: value
      })
    },
    toUpper (text) {
      return text.replace(/([A-Z])/g, ' $1').trim().toUpperCase()
    },
    copyBlock () {
      this.$store.dispatch('builder_copyBlock', this.block)
    },
    editBlock () {
      this.$store.dispatch('builder_setActiveBlock', {
        block: this.block,
        nestedVariables: this.nestedVariables
      })
        .then(() => {
          this.$emit('show-block-modal')
        })
    },
    toggleBlock (e) {
      e.target.closest('.accordion-header').classList.toggle('active')
    },
    removeBlock () {
      this.$store.dispatch('builder_removeBlock', this.block.id)
    }
  }
}
</script>

<style lang="scss">
  @import "../../../../../sass/colors.scss";

  .block-handle {
    padding: 0 5px 0 15px;
    font-size: 25px;
    color: #4159be;
    cursor: move;
  }

  .accordion-header {
    background: white;
  }

  .block-header {
    display: flex;
    background: white;

    &--content {
      flex: 1;

      &:hover {
        cursor: pointer;
      }
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

    & > .row > .block-details {
      display: none;
    }

    & > section.block-details {
      display: none;
    }

    &.active {
      border: 3px solid $primary;
      box-shadow: 0 2px 3px 0 $primary;

      & > .row > .block-details {
        display: block;
      }

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

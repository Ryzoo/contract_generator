<template>
  <section>
    <div class="options-section-1">
      <span class="sub-title">Konfiguruj blok</span>
      <v-text-field v-model="block.blockName" label="Nazwa" outline/>
      <div class="block-button">
        <v-btn color="primary" @click="editBlock()">Zapisz</v-btn>
      </div>
    </div>
    <div class="options-section-2">
      <span class="sub-title">Logika</span>
      <div class="builder-elements">
        <div class="select-options">
          <div class="w-50">
            <v-select
              :items="blockOptions"
              label="Akcja"
              outlined
              color="primary"
              v-model="conditional.conditionalType"
              dense
            >
            </v-select>
          </div>
          <v-text-field v-model="conditional.content" label="Warunek" outline/>
          <div class="block-button">
            <v-btn color="primary" @click="addConditional()">Dodaj</v-btn>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
    import {ConditionalEnum} from "./../../../../additionalModules/Enums";
  export default {
    name: "SelectedBlockView",
    data() {
      return {
        block: {
          blockName: "",
          conditionals: ""
        },
        blockOptions: [
          "SHOW_ON",
        ],
          conditional: this.getInitialConditional()
      }
    },
    watch: {
      activeBlock(value) {
        this.initBlock();
      }
    },
    computed: {
      activeBlock() {
        return this.$store.state.builder.builder.activeBlock;
      },
      blocks() {
        return this.$store.getters.builder_allBlocks;
      }
    },
    methods: {
        getInitialConditional() {
            return {
                content: "",
                conditionalType: -1,
            }
        },
      addConditional() {
        let blockConditional = {
          conditionalType: parseInt(ConditionalEnum[this.conditional.conditionalType]),
          content: this.conditional.content.split(" ")
        };

        // this.activeBlock.conditionals.push(blockConditional);
        this.activeBlock.conditionals = [blockConditional];
        this.$store.dispatch("builder_setActiveBlock", this.activeBlock);
        this.editBlock();
      },
      editBlock(blocks = this.blocks) {
        blocks.map(x => {
          if (x.id === this.activeBlock.parentId) {
            x.content.blocks.map(x => {
              if (x.id === this.activeBlock.id) {
                x = this.activeBlock;
              }
            })
          }
          else if (typeof x.content.blocks != 'undefined' && x.content.blocks.length > 0) {
            this.editBlock(x.content.blocks)
          }
        });

        this.$store.dispatch("builder_set", blocks);
      },
      initBlock() {
        this.block = this.activeBlock;
          this.conditional = this.getInitialConditional();
        this.block.conditionals.forEach((conditional) => {
            this.conditional = {
                content: conditional.content.join(" "),
                conditionalType: conditional.conditionalName
            }
        })
      }
    },
    mounted() {
      if (this.activeBlock) {
        this.initBlock();
      }
    }
  }
</script>

<style scoped>

</style>

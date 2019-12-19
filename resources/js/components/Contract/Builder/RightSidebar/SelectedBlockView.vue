<template>
  <v-card>
    <v-card-title>Block configuration:
    <small class="pl-3" style="color: #7a7a7a">{{block.blockName}}</small></v-card-title>
    <v-divider/>
    <v-tabs background-color="secondary" v-model="currentTab" dark grow>
      <v-tabs-slider/>

      <v-tab :key="0" href="#tab-0">Basic</v-tab>
      <v-tab :key="1" href="#tab-1">Logic</v-tab>

      <v-tab-item :key="0" value="tab-0">
        <v-col sm="12">
          <v-text-field v-model="block.blockName" label="Block name" outline/>
        </v-col>
      </v-tab-item>

      <v-tab-item :key="1" value="tab-1">
        <v-col sm="12">
          <v-select
            :items="blockOptions"
            label="Action"
            outlined
            color="primary"
            v-model="conditional.conditionalType"
            dense
          >
          </v-select>
        </v-col>

        <v-col sm="12">
          <v-text-field v-model="conditional.content" label="Warunek" outline/>
          <v-btn color="primary" @click="addConditional()">Dodaj</v-btn>
        </v-col>
      </v-tab-item>
    </v-tabs>
    <v-card-actions>
      <v-spacer/>
      <v-btn color="primary" outlined @click="pushCloseEvent">Cancel</v-btn>
      <v-btn color="primary" @click="saveBlockConfiguration">Save</v-btn>
    </v-card-actions>
  </v-card>
</template>


<script>
  import {ConditionalEnum} from "./../../../../additionalModules/Enums";

  export default {
    name: "SelectedBlockView",
    data() {
      return {
        currentTab: null,
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
      pushCloseEvent() {
        this.$emit('close');
      },
      saveBlockConfiguration() {
        this.editBlock();
        this.pushCloseEvent();
      },
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
          else if (x.content.blocks) {
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

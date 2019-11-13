<template>
    <section>
        <div class="options-section-1">
            <span class="sub-title">Konfiguruj blok</span>
            <v-text-field v-model="block.blockName" label="Nazwa" outline></v-text-field>
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
                            dense
                        >
                        </v-select>
                    </div>
                    <v-text-field v-model="block.conditional" label="Warunek" outline></v-text-field>
                    <div class="block-button">
                        <v-btn color="primary" @click="addConditional()">Dodaj</v-btn>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
  export default {
    name: "SelectedBlockView",
    data(){
      return {
        block:{
          blockName: "",
          conditionals: ""
        },
        blockOptions: [
          "Pokaż",
        ],
      }
    },
    watch:{
      activeBlock(value){
        this.initBlock();
      }
    },
    computed: {
      activeBlock(){
        return this.$store.state.builder.builder.activeBlock;
      },
      blocks() {
        return this.$store.getters.builder_allBlocks;
      }
    },
    methods:{
      addConditional() {
        let blockConditional = {
          conditionalType: 0,
          content: this.conditional.split(" ")
        };

        this.activeBlock.conditionals.push(blockConditional);
        this.$store.dispatch("builder_set", this.activeBlock);
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
          } else if (typeof x.content.blocks != 'undefined' && x.content.blocks.length > 0) {
            this.editBlock(x.content.blocks)
          }
        });

        this.$store.dispatch("builder_set", blocks);
      },
      initBlock(){
        this.block = this.activeBlock;
      }
    },
    mounted() {
      if(this.activeBlock){
        this.initBlock();
      }
    }
  }
</script>

<style scoped>

</style>

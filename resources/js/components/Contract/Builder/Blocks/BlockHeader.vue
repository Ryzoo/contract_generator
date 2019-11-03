<template>
    <summary class="block-header">
        <div class="block-header--icon">
            <v-icon class="mx-3">fa-chevron-right</v-icon>
        </div>
        <div class="block-header--content">
            <h3 class="pr-2">{{ block.blockName | truncate}}</h3>
        </div>
        <div class="block-header--action">
            <v-icon class="mx-3" @click="editContract">fa-edit</v-icon>
            <v-icon class="mx-3" @click="removeContract">fa-trash</v-icon>
        </div>
    </summary>
</template>

<script>
  export default {
    name: "BlockHeader",
    props: ["block"],
    methods:{
      editContract(){
        this.$store.dispatch("builder_setActiveBlock", this.block);
      },
      removeContract(){
        console.log("TODO: implement remove there");
      }
    }
  }
</script>

<style lang="scss">
    .block-header{
        display: flex;
        &--content{
            flex: 1
        }
    }
</style>

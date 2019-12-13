<template>
<!--    TODO: When click edit, right sidebar show up 2nd position-->
<!--    TODO: Change to own expansion panel-->
    <div class="block-header accordion-body">
        <div class="block-header--icon">
            <v-icon class="mx-3 rotate">fa-chevron-right</v-icon>
        </div>
        <div class="block-header--content">
            <h3 class="pr-2">{{ block.blockName | truncate}}</h3>
        </div>
        <div class="block-header--action">
            <v-icon class="mx-3" @click="editBlock($event)">fa-edit</v-icon>
            <v-icon class="mx-3" @click="removeBlock">fa-trash</v-icon>
        </div>
    </div>
</template>

<script>
  export default {
    name: "BlockHeader",
    props: ["block"],
    methods:{
      editBlock(e){
        this.$store.dispatch("builder_setActiveBlock", this.block);

        if (e.target.closest(".accordion-header").classList.contains("active")) {
            e.target.closest(".accordion-header").classList.remove("active");
        } else {
            e.target.closest(".accordion-header").classList.add("active");
        }
      },
      removeBlock(){
          // TODO: implement remove there
        console.log("TODO: implement remove there");
      }
    }
  }
</script>

<style lang="scss">
  @import "../../../../../sass/colors.scss";

  .block-header{
        display: flex;
        &--content{
            flex: 1
        }
        &--action i:hover {
          color: $primary;
        }
    }
</style>

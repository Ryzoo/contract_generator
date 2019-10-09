<template>
    <div class="block" :blockid="id">
        <details @click="setActive($event)">
            <summary>
                <v-icon class="mx-3">fa-chevron-right</v-icon>
                <h3 class="pr-2">{{ blockName | truncate}}</h3>
            </summary>
            <ContainerBlock
                v-for="block in filterParentBlocks"
                :block="block"
                :key="block.id"
                :divider="block.isDivider"
                :level="id"
            >
            </ContainerBlock>
        </details>
    </div>
</template>

<script>

  export default {
    name: "EmptyBlock",
    props: {
      id: { required: true },
      content: { required: true },
      blockName: { required: true },
      conditionals: { required: true },
      settings: { required: true }
    },
    computed: {
      filterParentBlocks() {
        let filteredBlocks = this.content.blocks.filter(x => x.parentId === this.id);
        let obj = {isDivider: true};
        let arr = [
          obj,
        ];

        filteredBlocks.map(x => {
          arr.push(x);
          arr.push(obj);
        });

        return arr;
      }
    },
    methods: {
      setActive(e){
        if(!e.target.closest("details").classList.contains("active")) {
          $('details.active').removeClass("active");
          e.target.closest("details").classList.add("active");
          this.$emit("getAttributes");
        }
      }
    },
    mounted() {
    }
  }
</script>

<style scoped>

</style>
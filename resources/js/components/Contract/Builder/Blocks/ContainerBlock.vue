<template>
    <section>
        <div class="block" :blockid="block.id" v-if="!divider">
            <details @click="setActive($event)">
                <BlockHeader :block="block"></BlockHeader>
                <component
                    :is="Mapper.getBlockName(block.blockType)"
                    :block="block"
                    :level="level ? level : 0"
                    >
                </component>
            </details>
        </div>
        <AddBlockDialog :buttonIndex="blockIndex" :block="block" :level="level ? level : 0" v-else></AddBlockDialog>
    </section>
</template>

<script>
  import TextBlock from "./Types/TextBlock";
  import EmptyBlock from "./Types/EmptyBlock";
  import AddBlockDialog from "./AddBlockDialog";
  import BlockHeader from "./BlockHeader";

  export default {
    name: "ContainerBlock",
    components: {
      BlockHeader,
      TextBlock,
      EmptyBlock,
      AddBlockDialog
    },
    props: {
      block: { required: true },
      divider: {},
      level: {},
      blockIndex: {}
    },
    methods: {
      setActive(e){
        if (!e.target.closest("details").classList.contains("active")) {
          $('details.active').removeClass("active");
          e.target.closest("details").classList.add("active");
          this.$emit("getAttributes");
        }
      }
    },
  }
</script>

<style scoped>

</style>

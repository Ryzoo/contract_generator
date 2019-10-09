<template>
    <div>
        <component
            v-if="!divider"
            :is="Mapper.getBlockName(block.blockType)"
            v-bind="block"
        >
        </component>
        <AddBlockDialog :buttonIndex="blockIndex" :level="level" v-else></AddBlockDialog>
    </div>
</template>

<script>
  import TextBlock from "./TextBlock";
  import EmptyBlock from "./EmptyBlock";
  import AddBlockDialog from "./AddBlockDialog";

  export default {
    name: "ContainerBlock",
    components: {
      TextBlock,
      EmptyBlock,
      AddBlockDialog
    },
    props: {
      block: { required: true },
      divider: {},
      level: { required: true },
      blockIndex: {}
    },
    methods:{
    },
    mounted() {
    }
  }
</script>

<style scoped>

</style>

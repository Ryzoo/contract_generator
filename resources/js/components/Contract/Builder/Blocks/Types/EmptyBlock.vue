<template>
    <section class="block-details block-zone">
        <ContainerBlock
            v-for="(fBlock, index) in filterParentBlocks"
            :block="fBlock"
            :key="fBlock.id"
            :divider="fBlock.isDivider"
            :level="block.id"
            :blockIndex="index"
            @show-block-modal="showBlockModal"
        >
        </ContainerBlock>
    </section>
</template>

<script>
export default {
  name: 'EmptyBlock',
  props: ['block', 'level'],
  computed: {
    filterParentBlocks () {
      const filteredBlocks = this.block.content.blocks
      const obj = { isDivider: true }
      const arr = [
        obj
      ]

      filteredBlocks.map(x => {
        arr.push(x)
        arr.push(obj)
      })

      return arr
    }
  },
  methods: {
    showBlockModal () {
      this.$emit('show-block-modal')
    }
  }
}
</script>

<style scoped>

</style>

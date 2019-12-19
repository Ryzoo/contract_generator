<template>
  <v-card>
    <v-card-title>Block configuration</v-card-title>
    <v-divider/>
    <v-card-text>
      <SelectedBlockView/>
    </v-card-text>
  </v-card>
</template>

<script>
  import SelectedBlockView from "../RightSidebar/SelectedBlockView";

  export default {
    name: "BlockConfigurationModal",
    components: {
      SelectedBlockView,
    },
  }
</script>

<style scoped>

</style>

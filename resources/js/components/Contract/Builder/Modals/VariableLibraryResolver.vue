<template>
  <v-card>
    <v-card-title class="headline">
      Variables draft
    </v-card-title>

    <v-card-text>
      <v-row v-if="!isLoading"></v-row>
      <loader v-else></loader>
    </v-card-text>

    <v-card-actions>
      <div class="flex-grow-1"></div>
      <v-btn color="primary" text @click="closeDialog">
        {{ $t("base.button.cancel") }}
      </v-btn>
      <v-btn color="primary" :disabled="!variablesToImport.length" @click="importAttributes">
        Import to contract
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  name: 'VariableLibraryResolver',
  data () {
    return {
      isLoading: true,
      variablesToImport: []
    }
  },
  methods: {
    closeDialog () {
      this.$emit('close')
    },
    importAttributes () {

    }
  }
}
</script>

<style scoped>

</style>

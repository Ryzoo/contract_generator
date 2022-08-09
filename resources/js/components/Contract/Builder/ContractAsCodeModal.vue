<template>
  <v-dialog
    v-model="dialog"
    ref="contractAsCode"
    width="900px"
    @close="handleClose"
  >
    <v-card>
      <v-card-title> Contract as text </v-card-title>
      <v-card-text>
        <v-textarea
          v-model="contractAsText"
          label="Contract as text"
          rows="5"
          dense
          outlined
        />
      </v-card-text>
      <v-card-actions>
        <div class="flex-grow-1"></div>
        <v-btn color="primary" text @click="handleClose">
          {{ $t("base.button.cancel") }}
        </v-btn>
        <v-btn color="error" @click="handleSaveCode">
          {{ $t("base.button.update") }}
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  name: "ContractAsCodeModal",
  props: ["content"],
  data() {
    return {
      dialog: true,
      contractAsText: this.content,
    };
  },
  methods: {
    handleClose() {
      this.$emit("close");
    },
    handleSaveCode() {
      const contract = JSON.parse(this.contractAsText);
      this.$store.dispatch("newContract_update_code", contract);
      this.$store.dispatch("builder_set", contract.blocks);
      this.$store.dispatch("builder_setVariable", contract.attributesList);
      this.$emit("close");
    },
  },
};
</script>

<style lang="scss" scoped>
@import "./../../../../sass/colors";
</style>

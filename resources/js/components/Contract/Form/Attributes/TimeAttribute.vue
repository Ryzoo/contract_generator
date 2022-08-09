<template>
  <v-menu
    ref="dialog"
    v-model="timeDialog"
    :close-on-content-click="false"
    transition="scale-transition"
    offset-y
    max-width="290px"
    min-width="290px"
  >
    <template v-slot:activator="{ on }">
      <v-text-field
        v-model="currentValue"
        :label="attribute.attributeName"
        :placeholder="attribute.placeholder || ' '"
        persistent-placeholder
        :error="!attribute.isValid"
        :hint="attribute.labelAfter"
        :persistent-hint="!!attribute.labelAfter"
        :error-messages="attribute.errorMessage"
        outlined
        dense
        prepend-icon="far fa-clock"
        readonly
        v-on="on"
      ></v-text-field>
    </template>
    <v-time-picker
      format="24hr"
      v-model="currentValue"
      @input="timeDialog = false"
    ></v-time-picker>
  </v-menu>
</template>

<script>
export default {
  name: "TimeAttribute",
  props: ["attribute", "outside"],
  data() {
    return {
      timeDialog: false,
      currentValue: this.attribute.value || this.attribute.defaultValue,
    };
  },
  methods: {
    resetForm() {
      this.currentValue = this.attribute.defaultValue;
    },
  },
  watch: {
    currentValue(newValue) {
      if (this.outside) {
        this.$emit("change-value", {
          ...this.attribute,
          value: newValue,
        });
        return;
      }
      this.$store.dispatch("formElements_change_attribute", {
        id: this.attribute.id,
        value: newValue,
      });
    },
  },
};
</script>

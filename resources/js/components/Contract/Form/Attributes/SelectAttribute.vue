<template>
    <v-col sm="12">
        <v-select
            :items="this.attribute.settings.items"
            outlined
            filled
            :error="validationError.length > 0"
            :error-messages="validationError"
            :label="attribute.name"
            :value="currentValue"
            :multiple="!!attribute.settings.isMultiSelect"
            :placeholder="String(attribute.placeholder)"
            @change="changeValue"
        ></v-select>
    </v-col>
</template>

<script>
  export default {
    name: "SelectAttribute",
    props: ["attribute", "validationError"],
    data(){
      return {
        currentValue: this.attribute.value
      }
    },
    methods: {
      changeValue(newValue) {
        this.$emit("change-value", newValue.join(","))
      }
    }
  };
</script>

<style scoped></style>

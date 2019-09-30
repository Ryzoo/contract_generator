<template>
    <v-col sm="12" >
        <v-text-field
            :label="attribute.name"
            :value="attribute.value"
            :placeholder="String(attribute.placeholder)"
            :error="validationError.length > 0"
            :error-messages="validationError"
            outlined
            filled
            type="number"
            @change="changeValue"
        ></v-text-field>
    </v-col>
</template>

<script>
  export default {
    name: "NumberAttribute",
    props: ["attribute", "validationError"],
    methods: {
      changeValue( newValue ){
        this.$emit("change-value", parseInt(newValue));
      }
    }
  }
</script>

<style scoped>

</style>

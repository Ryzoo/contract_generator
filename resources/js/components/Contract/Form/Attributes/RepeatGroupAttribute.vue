<template>
    <v-col sm="12" >
        <h1>dasdads</h1>
    </v-col>
</template>

<script>
  export default {
    name: "RepeatGroupAttribute",
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

<template>
    <v-col sm="12">
        <v-autocomplete
            :items="this.attribute.settings.items"
            outlined
            filled
            :error="validationError.length > 0"
            :error-messages="validationError"
            :label="attribute.name"
            :value="currentValue"
            :hint="attribute.description"
            :persistent-hint="!!attribute.description"
            :multiple="!!attribute.settings.isMultiSelect"
            :placeholder="String(attribute.placeholder)"
            @change="changeValue"
        >
            <template v-slot:append-outer v-if="attribute.additionalInformation && attribute.additionalInformation.length > 0">
                <v-tooltip right>
                    <template v-slot:activator="{ on }">
                        <v-icon color="primary" dark v-on="on">fa-question-circle</v-icon>
                    </template>
                    <span>{{attribute.additionalInformation}}</span>
                </v-tooltip>
            </template>
        </v-autocomplete>
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
        this.$emit("change-value", !!this.attribute.settings.isMultiSelect ? newValue.join(",") : newValue)
      }
    }
  };
</script>

<style scoped></style>

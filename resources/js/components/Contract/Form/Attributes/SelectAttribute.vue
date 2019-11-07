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
        >
            <template v-slot:append-outer v-if="attribute.additionalInformation">
                <v-tooltip right>
                    <template v-slot:activator="{ on }">
                        <v-icon dark v-on="on">fa-question-circle</v-icon>
                    </template>
                    <span>{{attribute.additionalInformation}}</span>
                </v-tooltip>
            </template>
        </v-select>
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

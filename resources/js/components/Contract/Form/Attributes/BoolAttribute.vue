<template>
    <v-col cols="12">
        <v-switch
            :label="attribute.attributeName"
            :value="!!attribute.value"
            :placeholder="attribute.placeholder ? String(attribute.placeholder) : ''"
            :error="validationError.length > 0"
            :error-messages="validationError"
            :hint="attribute.description"
            :persistent-hint="!!attribute.description"
            outlined
            :dense="dense"
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
        </v-switch>
    </v-col>
</template>

<script>
export default {
  name: 'BoolAttribute',
  props: ['attribute', 'validationError', 'dense'],
  methods: {
    changeValue (newValue) {
      this.$emit('change-value', !!newValue)
    }
  },
  mounted () {
    this.changeValue(this.attribute.value)
  }
}
</script>

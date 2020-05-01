<template>
  <v-autocomplete
    v-if="!this.attribute.settings.allowSelfOptions"
    :items="this.attribute.settings.items"
    :error="!attribute.isValid"
    :error-messages="attribute.errorMessage"
    :label="attribute.attributeName"
    :multiple="!!attribute.settings.isMultiSelect"
    :placeholder="attribute.placeholder"
    v-model="currentValue"
    :hint="attribute.labelAfter"
    :persistent-hint="!!attribute.labelAfter"

    allowSelfOptions
    dense
    outlined
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
  <v-combobox
    v-else
    :items="this.attribute.settings.items"
    :error="!attribute.isValid"
    :error-messages="attribute.errorMessage"
    :label="attribute.attributeName"
    :multiple="!!attribute.settings.isMultiSelect"
    :placeholder="attribute.placeholder"
    v-model="currentValue"
    :hint="attribute.labelAfter"
    :persistent-hint="!!attribute.labelAfter"

    allowSelfOptions
    dense
    outlined
  >
    <template v-slot:append-outer v-if="attribute.additionalInformation && attribute.additionalInformation.length > 0">
      <v-tooltip right>
        <template v-slot:activator="{ on }">
          <v-icon color="primary" dark v-on="on">fa-question-circle</v-icon>
        </template>
        <span>{{attribute.additionalInformation}}</span>
      </v-tooltip>
    </template>
  </v-combobox>
</template>

<script>
export default {
  name: 'SelectAttribute',
  props: ['attribute', 'outside'],
  data () {
    return {
      currentValue: this.attribute.value || this.attribute.defaultValue
    }
  },
  watch: {
    currentValue (newValue) {
      if (this.outside) {
        this.$emit('change-value', {
          ...this.attribute,
          value: Array.isArray(newValue) ? newValue.join(',') : newValue
        })
        return
      }
      this.$store.dispatch('formElements_change_attribute', {
        id: this.attribute.id,
        value: Array.isArray(newValue) ? newValue.join(',') : newValue
      })
    }
  },
  methods: {
    resetForm () {
      this.currentValue = this.attribute.defaultValue
    }
  }
}
</script>

<template>
    <v-autocomplete
            :items="this.attribute.settings.items"
            outlined
            :error="validationError.length > 0"
            :error-messages="validationError"
            :label="attribute.settings.required ? attribute.attributeName+'*' : attribute.attributeName"
            v-model="currentValue"
            :hint="attribute.description"
            :persistent-hint="!!attribute.description"
            :multiple="!!attribute.settings.isMultiSelect"
            dense
            :placeholder="attribute.placeholder ? String(attribute.placeholder) : ''"
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
</template>

<script>
import AttributeValidator from '../Validators/AttributeValidator'

export default {
  name: 'SelectAttribute',
  props: ['attribute', 'errorFromValidation'],
  data () {
    return {
      currentValue: !!this.attribute.settings.isMultiUse ? null : (this.attribute.value ? this.attribute.value.split(',') : []),
      validationError: this.attribute.validationError || '',
      resetNow: false
    }
  },
  watch: {
    attribute () {
      this.isValid(this.currentValue)
    },
    errorFromValidation (newValue) {
      if (newValue.length) this.validationError = newValue
    },
    currentValue (newValue) {
      const isValid = this.isValid(Array.isArray(newValue) ? newValue.join(',') : newValue)
      this.$emit('change-value', {
        newValue: Array.isArray(newValue) ? newValue.join(',') : newValue,
        isValid
      })
    }
  },
  methods: {
    isValid (newValue) {
      const validatorResult = AttributeValidator.validate(this.attribute, newValue)
      if (this.resetNow) {
        this.resetNow = false
      } else {
        this.validationError = validatorResult.errorMessage
      }
      return validatorResult.status
    },
    resetForm () {
      this.resetNow = true
      this.currentValue = null
      this.validationError = ''
    }
  }
}
</script>

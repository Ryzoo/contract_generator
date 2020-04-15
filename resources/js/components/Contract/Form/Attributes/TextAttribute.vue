<template>
    <v-text-field
            :label="attribute.settings.required ? attribute.attributeName+'*' : attribute.attributeName"
            v-model="currentValue"
            :placeholder="attribute.placeholder ? String(attribute.placeholder) : ''"
            :error="validationError.length > 0"
            :error-messages="validationError"
            :hint="attribute.description"
            :persistent-hint="!!attribute.description"
            outlined
            dense
        >
            <template v-slot:append-outer v-if="attribute.additionalInformation && attribute.additionalInformation.length > 0">
                <v-tooltip right>
                    <template v-slot:activator="{ on }">
                        <v-icon color="primary" dark v-on="on">fa-question-circle</v-icon>
                    </template>
                    <span>{{attribute.additionalInformation}}</span>
                </v-tooltip>
            </template>
        </v-text-field>
</template>

<script>
import AttributeValidator from '../Validators/AttributeValidator'

export default {
  name: 'NumberAttribute',
  props: ['attribute', 'errorFromValidation'],
  data () {
    return {
      currentValue: !!this.attribute.settings.isMultiUse ? null : this.attribute.value,
      validationError: '',
      resetNow: false
    }
  },
  watch: {
    errorFromValidation (newValue) {
      if (newValue.length) this.validationError = newValue
    },
    currentValue (newValue) {
      const isValid = this.isValid(newValue)
      this.$emit('change-value', {
        newValue,
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

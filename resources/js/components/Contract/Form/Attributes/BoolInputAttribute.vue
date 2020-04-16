<template>
    <v-row class="pa-0 ma-0 d-flex justify-center align-center">
        <v-switch
          class="mr-2"
          :label="boolLabel"
          v-model="currentBoolValue"
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
        </v-switch>
        <v-text-field
          class="input-in-bool"
          v-model="currentInputValue"
          hide-details
          outlined
          :disabled="!currentBoolValue"
          :suffix="inputLabel"
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
    </v-row>
</template>

<script>
import AttributeValidator from '../Validators/AttributeValidator'

export default {
  name: 'BoolInputAttribute',
  props: ['attribute', 'errorFromValidation'],
  data () {
    return {
      currentBoolValue: false,
      currentInputValue: null,
      boolLabel: this.attribute.settings.boolLabel || (this.attribute.settings.required ? this.attribute.attributeName + '*' : this.attribute.attributeName),
      inputLabel: this.attribute.settings.inputLabel || '',
      currentValue: this.attribute.settings.isMultiUse ? null : !!this.attribute.value,
      validationError: '',
      resetNow: false
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
  },
  watch: {
    currentInputValue (newValue) {
      this.currentValue = {
        input: newValue,
        bool: this.currentBoolValue
      }
    },
    currentBoolValue (newValue) {
      this.currentValue = {
        input: this.currentInputValue,
        bool: newValue
      }
    },
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
  mounted () {
    this.$emit('change-value', {
      newValue: !!this.currentValue,
      isValid: true
    })
  }
}
</script>

<template>
    <v-dialog
      ref="dialog"
      v-model="timeDialog"
      :return-value.sync="currentValue"
      persistent
      width="290px"
    >
      <template v-slot:activator="{ on }">
        <v-text-field
          v-model="currentValue"
          :label="attribute.settings.required ? attribute.attributeName+'*' : attribute.attributeName"
          :placeholder="attribute.placeholder ? String(attribute.placeholder) : ''"
          :error="validationError.length > 0"
          :error-messages="validationError"
          :hint="attribute.description"
          :persistent-hint="!!attribute.description"
          outlined
          dense
          prepend-icon="far fa-clock"
          readonly
          v-on="on"
        >
          <template v-slot:append-outer
                    v-if="attribute.additionalInformation && attribute.additionalInformation.length > 0">
            <v-tooltip right>
              <template v-slot:activator="{ on }">
                <v-icon color="primary" dark v-on="on">fa-question-circle</v-icon>
              </template>
              <span>{{attribute.additionalInformation}}</span>
            </v-tooltip>
          </template>
        </v-text-field>
      </template>
      <v-time-picker
        v-model="currentValue"
        scrollable
      >
        <v-spacer></v-spacer>
        <v-btn outlined color="primary" @click="timeDialog = false">{{ $t('base.button.cancel') }}</v-btn>
        <v-btn color="primary" @click="()=>{$refs.dialog.save(currentValue)}">{{ $t('base.button.save') }}</v-btn>
      </v-time-picker>
    </v-dialog>
</template>

<script>
import AttributeValidator from '../Validators/AttributeValidator'

export default {
  name: 'TimeAttribute',
  props: ['attribute', 'errorFromValidation'],
  data () {
    return {
      timeDialog: false,
      currentValue: this.attribute.settings.isMultiUse ? null : this.attribute.value,
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
  }
}
</script>

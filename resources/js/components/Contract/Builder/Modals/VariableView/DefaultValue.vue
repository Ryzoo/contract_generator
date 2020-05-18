<template>
  <section>
    <v-text-field
      v-if="acceptedType([type.TEXT, type.BOOL_INPUT])"
      hide-details
      dense
      outlined
      v-model="currentValue"
      :label="$t('form.variableForm.defaultValue')"
      outline
    />
    <v-text-field
      v-if="acceptedType(type.NUMBER)"
      hide-details
      dense
      outlined
      type="number"
      v-model="currentValue"
      :label="$t('form.variableForm.defaultValue')"
      outline
    />
    <v-menu
      v-if="acceptedType(type.DATE)"
      ref="dialog"
      v-model="dateDialog"
      :close-on-content-click="false"
      transition="scale-transition"
      offset-y
      max-width="290px"
      min-width="290px"
    >
      <template v-slot:activator="{ on }">
        <v-text-field
          v-model="currentValue"
          :label="$t('form.variableForm.defaultValue')"
          hide-details
          dense
          outlined
          prepend-icon="far fa-calendar-alt"
          readonly
          v-on="on"
        ></v-text-field>
      </template>
      <v-date-picker v-model="currentValue" no-title @input="dateDialog = false"></v-date-picker>
    </v-menu>
    <v-menu
      v-if="acceptedType(type.TIME)"
      ref="dialog"
      v-model="timeDialog"
      :close-on-content-click="false"
      transition="scale-transition"
      offset-y
      max-width="290px"
      min-width="290px"
    >
      <template v-slot:activator="{ on }">
        <v-text-field
          v-model="currentValue"
          :label="$t('form.variableForm.defaultValue')"
          hide-details
          dense
          outlined
          prepend-icon="far fa-clock"
          readonly
          v-on="on"
        ></v-text-field>
      </template>
      <v-time-picker format="24hr" v-model="currentValue" @input="timeDialog = false"></v-time-picker>
    </v-menu>
    <v-autocomplete
      v-if="acceptedType([type.SELECT])"
      :label="$t('form.variableForm.defaultValue')"
      hide-details
      dense
      :items="items"
      outlined
      small-chips
      :multiple="isMultiSelect"
      clearable
      deletable-chips
      v-model="currentValue"
    />
    <v-switch
      v-if="acceptedType([type.BOOL])"
      outlined
      hide-details
      dense
      v-model="currentValue"
      :label="$t('form.variableForm.defaultValue') + ': ' + (!!currentValue).toString()"
    />
    <currency-select
      v-if="acceptedType([type.CURRENCY])"
      :label="$t('form.variableForm.defaultValue')"
      v-model="currentValue"
    />
  </section>
</template>

<script>
import { AttributeTypeEnum } from '../../../../../additionalModules/Enums'
import CurrencySelect from '../../../../common/CurrencySelect'

export default {
  name: 'DefaultValue',
  components: { CurrencySelect },
  props: [
    'attributeData', 'value'
  ],
  data () {
    return {
      isMultiSelect: !!this.attributeData.settings.isMultiSelect,
      items: this.attributeData.settings.items || [],
      timeDialog: false,
      dateDialog: false,
      type: AttributeTypeEnum,
      currentValue: this.value
    }
  },
  watch: {
    attributeData (newValue) {
      this.items = newValue.settings.items || []
      this.isMultiSelect = !!this.attributeData.settings.isMultiSelect
      if (this.isMultiSelect && !Array.isArray(this.currentValue && this.acceptedType(this.type.SELECT))) {
        this.currentValue = []
      }
      if (!this.isMultiSelect && Array.isArray(this.currentValue && this.acceptedType(this.type.SELECT))) {
        this.currentValue = null
      }
    },
    value (newValue) {
      this.currentValue = newValue
    },
    currentValue () {
      this.update()
    }
  },
  methods: {
    acceptedType (types) {
      if (Array.isArray(types)) {
        return types.some(x => parseInt(x) === parseInt(this.attributeData.attributeType))
      }
      return parseInt(types) === parseInt(this.attributeData.attributeType)
    },
    update () {
      this.$emit('input', this.currentValue)
    }
  }
}
</script>

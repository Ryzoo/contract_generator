<template>
  <v-row>
    <v-col cols="12" v-for="setting in filteredSettingsList" :key="setting">
      <v-checkbox
        class="mt-0"
        :key="setting"
        hide-details
        dense
        outlined
        :input-value="settings.required"
        v-if="setting === 'required'"
        :label="$t('form.variableForm.isRequired')"
        @change="saveInput(!!$event, setting)"
      />
      <v-checkbox
        class="mt-0"
        :key="setting"
        hide-details
        dense
        outlined
        :input-value="settings.isMultiSelect"
        v-if="setting === 'isMultiSelect'"
        :label="$t('form.variableForm.isMultiSelect')"
        @change="saveInput(!!$event, setting)"
      />
      <v-text-field
        :key="setting"
        hide-details
        dense
        outlined
        type="number"
        :value="setting === 'lengthMin' ? settings.lengthMin : settings.lengthMax"
        v-if="setting === 'lengthMin' || setting === 'lengthMax'"
        :label="setting === 'lengthMin' ? $t('form.variableForm.lengthMin') : $t('form.variableForm.lengthMax')"
        @change="saveInput(parseInt($event), setting)"
      />
      <v-text-field
        :key="setting"
        hide-details
        dense
        outlined
        type="number"
        :value="setting === 'valueMin' ? settings.valueMin : settings.valueMax"
        v-if="setting === 'valueMin' || setting === 'valueMax'"
        :label="setting === 'valueMin' ? $t('form.variableForm.valueMin') : $t('form.variableForm.valueMax')"
        @change="saveInput(parseInt($event), setting)"
      />

      <v-select
        :key="setting"
        :value="settings.operationReturnFormatType"
        @change="saveInput($event, setting)"
        v-if="setting === 'operationReturnFormatType'"
        :items="numberTypeFormatList"
        label="Number type format"
        persistent-hint
        single-line
        hide-details
        dense
        outlined
      ></v-select>

      <v-select
        :key="setting"
        :value="settings.operationType"
        @change="saveInput($event, setting)"
        v-if="setting === 'operationType'"
        :items="operationTypeList"
        label="Type of aggregation"
        persistent-hint
        single-line
        hide-details
        dense
        outlined
      ></v-select>

      <v-text-field
        :key="setting"
        hide-details
        dense
        outlined
        type="number"
        :value="settings.precision"
        v-if="setting === 'precision'"
        min="0"
        max="5"
        label="Default return precision"
        @change="saveInput(parseInt($event), setting)"
      />

      <v-select
        @change="saveInput($event, setting)"
        :items="attributesToAggregate"
        :value="settings.operationItems"
        v-if="setting === 'operationItems'"
        :label="$t('form.variableForm.selectVariables')"
        multiple
        chips
        deletable-chips
        hide-details
        dense
        outlined
      ></v-select>
    </v-col>
  </v-row>
</template>

<script>
import { AttributeTypeEnum } from '../../../../../additionalModules/Enums'

export default {
  props: ['settings', 'currentSettings', 'attributesList'],
  name: 'VariableSettings',
  data () {
    return {
      numberTypeFormatList: [
        { text: 'Integer number', value: 'int' },
        { text: 'Float number', value: 'float' }
      ],
      operationTypeList: [
        { text: 'Add', value: 'add' },
        { text: 'Subtract', value: 'subtract' },
        { text: 'Multiply', value: 'multiply' },
        { text: 'Divide', value: 'divide' }
      ],
      settingsList: Object.keys(this.currentSettings),
      availableSettings: [
        'valueMin', 'valueMax',
        'lengthMin', 'lengthMax',
        'isMultiSelect', 'required',
        'operationItems', 'operationReturnFormatType',
        'operationType', 'precision'
      ]
    }
  },
  watch: {
    currentSettings (value) {
      this.settingsList = Object.keys(value)
    }
  },
  computed: {
    attributesToAggregate () {
      return this.attributesList
        .filter(x => x.attributeType === AttributeTypeEnum.NUMBER || x.attributeType === AttributeTypeEnum.REPEAT_GROUP)
        .map(x => ({
          text: x.attributeName,
          value: `${x.id}`
        }))
    },
    filteredSettingsList () {
      return this.settingsList.filter(x => this.availableSettings.includes(x))
    }
  },
  methods: {
    saveInput (value, name) {
      this.$emit('save', {
        name,
        value
      })
    }
  }
}
</script>

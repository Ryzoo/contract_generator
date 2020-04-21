<template>
  <v-row>
    <v-col cols="12">
      <v-select
        v-model="settingsData.operationReturnFormatType"
        :items="numberTypeFormatList"
        label="Number type format"
        persistent-hint
        single-line
        hide-details
        dense
        outlined
        @change="update"
      />
    </v-col>
    <v-col cols="12">
      <v-select
        v-model="settingsData.operationType"
        :items="operationTypeList"
        label="Type of aggregation"
        persistent-hint
        single-line
        hide-details
        dense
        outlined
        @change="update"
      />
    </v-col>
    <v-col cols="12">
      <v-text-field
        hide-details
        dense
        outlined
        type="number"
        v-model="settingsData.precision"
        min="0"
        max="5"
        label="Default return precision"
        @change="update"
      />
    </v-col>
    <v-col cols="12">
      <v-select
        :items="attributesToAggregate"
        v-model="settingsData.operationItems"
        :label="$t('form.variableForm.selectVariables')"
        multiple
        chips
        deletable-chips
        hide-details
        dense
        outlined
        @change="update"
      ></v-select>
    </v-col>
    <v-col cols="12">
      <v-checkbox
        hide-details
        dense
        outlined
        v-model="settingsData.required"
        :label="$t('form.variableForm.isRequired')"
        @change="update"
      />
    </v-col>
  </v-row>
</template>

<script>
import { AttributeTypeEnum } from '../../../../../../additionalModules/Enums'

export default {
  name: 'AggregateAttribute',
  props: ['settings', 'noStore', 'attributes'],
  computed: {
    attributesToAggregate () {
      return this.attributes
        .filter(x => x.attributeType == AttributeTypeEnum.NUMBER || x.attributeType == AttributeTypeEnum.ATTRIBUTE_GROUP || x.attributeType == AttributeTypeEnum.BOOL_INPUT)
        .map((x) => ({
          text: x.attributeName,
          value: x.id
        }))
    }
  },
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
      availableSettings: [
        'valueMin', 'valueMax',
        'lengthMin', 'lengthMax',
        'isMultiSelect', 'required',
        'operationItems', 'operationReturnFormatType',
        'operationType', 'precision'
      ],
      settingsData: {
        ...this.settings
      }
    }
  },
  watch: {
    settings (newValue) {
      if (JSON.stringify(newValue) !== JSON.stringify(this.settingsData)) {
        this.settingsData = {
          ...newValue
        }
      }
    }
  },
  methods: {
    update () {
      this.$emit('save', this.settingsData)
    }
  }
}
</script>

<style scoped>

</style>

<template>
    <component
      v-if="attribute.settings"
      :is="Mapper.getAttributeComponentName(attribute.attributeType)"
      :settings="attribute.settings"
      @save="saveData"
    />
</template>

<script>
import BoolAttribute from './VariableSettings/BoolAttribute'
import DateAttribute from './VariableSettings/DateAttribute'
import NumberAttribute from './VariableSettings/NumberAttribute'
import RepeatGroupAttribute from './VariableSettings/RepeatGroupAttribute'
import SelectAttribute from './VariableSettings/SelectAttribute'
import TextAttribute from './VariableSettings/TextAttribute'
import TimeAttribute from './VariableSettings/TimeAttribute'
import AggregateAttribute from './VariableSettings/AggregateAttribute'

export default {
  props: ['attribute'],
  name: 'VariableSettings',
  components: {
    BoolAttribute, DateAttribute, NumberAttribute, RepeatGroupAttribute, SelectAttribute, TextAttribute, TimeAttribute, AggregateAttribute
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
      ]
    }
  },
  methods: {
    saveData (settings) {
      this.$emit('save', settings)
    }
  }
}
</script>

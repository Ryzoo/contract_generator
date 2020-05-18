<template>
    <component
      v-if="attribute.settings"
      :is="Mapper.getAttributeComponentName(attribute.attributeType)"
      :settings="attribute.settings"
      :no-store="noStore"
      :attributes="attributes"
      @edit="editVariable"
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
import BoolInputAttribute from './VariableSettings/BoolInputAttribute'
import CurrencyAttribute from './VariableSettings/CurrencyAttribute'

export default {
  props: ['attribute', 'noStore', 'attributes'],
  name: 'VariableSettings',
  components: {
    CurrencyAttribute, BoolAttribute, DateAttribute, NumberAttribute, RepeatGroupAttribute, SelectAttribute, TextAttribute, TimeAttribute, AggregateAttribute, BoolInputAttribute
  },
  methods: {
    editVariable (attribute) {
      this.$emit('edit', attribute)
    },
    saveData (settings) {
      this.$emit('save', settings)
    }
  }
}
</script>

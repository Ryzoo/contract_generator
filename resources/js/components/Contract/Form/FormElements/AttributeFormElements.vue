<template>
    <v-row>
        <component
            :is="Mapper.getAttributeComponentName(formElement.attribute.attributeType)"
            v-bind="{
                attribute: formElement.attribute,
                validationError: formElement.validationError || []
            }"
            @change-value="changeValue"
        >
        </component>
    </v-row>
</template>

<script>
import NumberAttribute from './../Attributes/NumberAttribute'
import TextAttribute from './../Attributes/TextAttribute'
import SelectAttribute from '../Attributes/SelectAttribute'
import RepeatGroupAttribute from '../Attributes/RepeatGroupAttribute'
import BoolAttribute from '../Attributes/BoolAttribute'
import DateAttribute from '../Attributes/DateAttribute'
import TimeAttribute from '../Attributes/TimeAttribute'

export default {
  name: 'AttributeFormElements',
  props: ['formElement'],
  components: {
    NumberAttribute,
    TextAttribute,
    SelectAttribute,
    RepeatGroupAttribute,
    BoolAttribute,
    DateAttribute,
    TimeAttribute
  },
  methods: {
    changeValue (newValue) {
      this.$store.dispatch('formElements_change', {
        id: this.formElement.id,
        value: newValue
      })
    }
  }
}
</script>
